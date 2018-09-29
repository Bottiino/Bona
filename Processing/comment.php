<?PHP
    include_once '../Database/validate.php';
    include_once '../Database/session.php';
    require '../Database/database.php';
    include '../Database/functions.php';
    
    $error = checkLoggedIn();
    if(!empty($error))
    {
        die($error);
    }
    
    $postID = check_input($_POST['postID']);
    $commentText = check_input($_POST['commentText']);
    
    $bad = ['arse','ass','asshole','bastard','bitch','boong','cock','cocksucker','coon','coonnass','crap','cunt','damn','darn','dick','douche','faggot','fuck','gook','motherfucker','piss','pussy','shit','slut','tits'];
    $error = checkWords($commentText, $bad); 
    
    if(!empty($error))
    {
        die($error);
    }

    $query = 'INSERT INTO comments (commentID, postID, userID, commentText)'
                . ' VALUES (commentID, :postID, :userID, :commentText)';
    $statement = $db->prepare($query);
    $statement->bindValue(':postID', $postID);
    $statement->bindValue(':userID', $_SESSION['userID']);
    $statement->bindValue(':commentText', $commentText);
    $statement->execute();
    $statement->closeCursor();

    die('success');
?>