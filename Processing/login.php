<?php
    include_once '../Database/validate.php';
    include_once '../Database/session.php';
    require '../Database/database.php';
    include '../Database/functions.php';

    $required_fields = array('username','password');
    $form_errors = check_empty_fields($required_fields);

    if(empty($form_errors))
    {
        //collect form data
        $username = check_input($_POST['username']);
        $password = check_input($_POST['password']);

        $userInfo = getUserInfoByUsername($username);

        //If row exists (returned)
        if($userInfo != null)
        {
            //get user ID from db
            $id = $userInfo['userID']; 

            //get username
            $username = $userInfo['username'];    

            //get hashed password          
            $hash = $userInfo['password'];

            //verify the password 
            if(password_verify($password, $hash))
            {
                $_SESSION['userID'] = $id;
                die("success");
            }
        }
        
        die("Invalid username or password");
    }
    $errors = implode("\n", $form_errors);
    die($errors);
?>