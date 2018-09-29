<?php
    include_once '../Database/validate.php';
    include_once '../Database/session.php';
    require '../Database/database.php';
    include '../Database/functions.php';
    
    $form_errors = array();
    
    $username = check_input($_POST['username']);
    $email = check_input($_POST['email']);
    $password = check_input($_POST['password']);
    $sub = $_POST['cbEmailSubscribe'];
    
    if(!isset($_POST['g-recaptcha']) || $_POST['g-recaptcha'] === '')
    {
        array_push($form_errors, "Invalid captcha.");
    }
    if(checkUsername($username) != TRUE)
    {
        array_push($form_errors, "Username is taken.");
    }
    if(checkEmail($email) != TRUE)
    {
        array_push($form_errors, "Email is taken.");
    }
    
    $imgFile = $_FILES['avatar']['name'];
    $tmp_dir = $_FILES['avatar']['tmp_name'];
    $imgSize = $_FILES['avatar']['size'];
    
    $required_fields = array('username', 'email', 'password', 'avatar');    
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    
    $fields_to_check_length = array('username' => 6, 'password' => 8);    	
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length)); 
    
    $form_errors = array_merge($form_errors, valid_password($password));
    
    $upload_dir = '../Avatars/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
       
    // allow valid image file formats
    if(strtoupper($imgExt) === strtoupper('PNG'))
    {	
        // Check file size '5MB'
        if($imgSize < 5000000)				
        {
            $dimensions = getimagesize($tmp_dir);
            if ($dimensions[0] <= 1280 && $dimensions[1] <= 720)
            {
                if(empty($form_errors))
                {
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $query = 'INSERT INTO users (userID, username, email, password)'
                                . ' VALUES (userID, :username, :email, :password)';
                    $statement = $db->prepare($query);
                    $statement->bindValue(':username', $username);
                    $statement->bindValue(':email', $email);
                    $statement->bindValue(':password', $password);   
                    $statement->execute();

                    $userInfo = getUserInfoByUsername($username);  
                    $_SESSION['userID'] = $userInfo['userID'];
                    
                    // rename uploading image
                    $avatar = $userInfo['userID'] .".".$imgExt;
                    move_uploaded_file($tmp_dir, $upload_dir.$avatar);
                    
                    if($sub)
                    {
                        if(checkSubbed($email) != FALSE)
                        {
                            $query = 'INSERT INTO subs (email)'
                                        . ' VALUES (:email)';
                            $statement = $db->prepare($query);
                            $statement->bindValue(':email', $email);
                            $statement->execute();
                            $statement->closeCursor();
                        }                 
                    }
                }
            }
            else
            {
                array_push($form_errors, "Image can be a max resolution of 1280 x 720, Uploaded image is " . $dimensions[0] . " x " . $dimensions[1]);
            }
        }
        else
        {
            array_push($form_errors, "Avatar must be under 5MB");
        }
    }
    else
    {
        array_push($form_errors, "Avatar must be a PNG");		
    }
    
    $errors = implode("<br>", $form_errors);
    
    if ($errors !== '') {
        die($errors);
    }
    
    die("success");
?>