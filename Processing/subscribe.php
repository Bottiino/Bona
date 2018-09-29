<?PHP
    include_once '../Database/validate.php';
    include_once '../Database/session.php';
    require '../Database/database.php';
    include '../Database/functions.php';
    
    $form_errors = array();
    
    $email = check_input($_POST['email']);
    
    if(checkSubbed($email) != TRUE)
    {
        array_push($form_errors, "Email is taken.");
    }
    
    if(empty($error))
    {
        $query = 'INSERT INTO subs (email)'
                    . ' VALUES (:email)';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $statement->closeCursor();
        
        die('success');
    }
    
    die($error);
?>