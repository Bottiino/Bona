<?PHP
    include_once '../Database/validate.php';
    include_once '../Database/session.php';
    require '../Database/database.php';
    include '../Database/functions.php';
        
    
    
    $postTopic = check_input($_POST['postTopic']);
    $postTitle = check_input($_POST['postTitle']);
    $postText = check_input($_POST['postText']);
    $feedback = $_POST['feedback'];

    $required_fields = array('postTopic', 'postTitle', 'postText');

    $form_errors = check_empty_fields($required_fields);
       
    if(empty($form_errors))
    {
        $query = 'INSERT INTO posts (postID, userID, postTopic, postTitle, postText, postTags, feedback, imageNum)'
                    . ' VALUES (postID, :userID, :postTopic, :postTitle, :postText, :postTags, :feedback, :imageNum)';
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $_SESSION['userID']);
        $statement->bindValue(':postTopic', $postTopic);
        $statement->bindValue(':postTitle', $postTitle);
        $statement->bindValue(':postText', $postText);
        $statement->bindValue(':postTags', '');
        $statement->bindValue(':feedback', $feedback);
        $statement->bindValue(':imageNum', rand(1,12));
        $statement->execute();
        $statement->closeCursor();        

        $postInfo = getPostInfoByText($postText);

        preg_match_all('/#(\w+)/', $postText, $matches);
        
        if(count($matches))
        {
            foreach($matches[1] as $key => $value)
            {   
                $query2 = 'UPDATE posts SET postTags = concat(postTags, :tag) '
                        . 'WHERE postID = :postID';
                $statement2 = $db->prepare($query2);
                $statement2->bindValue(':postID', $postInfo['postID']);
                $statement2->bindValue(':tag', $value . ",");
                $statement2->execute();
                $statement2->closeCursor();
            }
        }
        
        die('success');
    }
    
    die($form_errors);
?>