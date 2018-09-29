<?php
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
        
    $getVote = 'SELECT voteID, value FROM votes WHERE postID = :postID and userID = :userID';
    $statement = $db->prepare($getVote);
    $statement->bindValue(':postID', $postID);
    $statement->bindValue(':userID', $_SESSION['userID']);
    $statement->execute();
    $voteInfo = $statement->fetch();
    $statement->closeCursor();
    
    if(empty($voteInfo))
    {
        $addDislike = 'UPDATE posts SET downvote = downvote + 1 WHERE postID = :postID';
        $statement = $db->prepare($addDislike);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $statement->closeCursor();

        $addVote= 'INSERT INTO votes (voteID, postID, userID, value)'
                . ' VALUES (voteID, :postID, :userID, -1)';
        $statement2 = $db->prepare($addVote);
        $statement2->bindValue(':postID', $postID);
        $statement2->bindValue(':userID', $_SESSION['userID']);
        $statement2->execute();
        $statement2->closeCursor();
    }
    else
    {
        if($voteInfo['value'] == 1)
        {
            $addDislike = 'UPDATE posts SET downvote = downvote + 1 WHERE postID = :postID';
            $statement = $db->prepare($addDislike);
            $statement->bindValue(':postID', $postID);
            $statement->execute();
            $statement->closeCursor();
            
            $undoLike = 'UPDATE posts SET upvote = upvote - 1 WHERE postID = :postID';
            $statement2 = $db->prepare($undoLike);
            $statement2->bindValue(':postID', $postID);
            $statement2->execute();
            $statement2->closeCursor();

            $changeValue = 'UPDATE votes SET value = -1 WHERE postID = :postID AND userID = :userID';
            $statement3 = $db->prepare($changeValue);
            $statement3->bindValue(':postID', $postID);
            $statement3->bindValue(':userID', $_SESSION['userID']);
            $statement3->execute();
            $statement3->closeCursor();
        }
        else
        {
            $undoDislike = 'UPDATE posts SET downvote = downvote - 1 WHERE postID = :postID';
            $statement = $db->prepare($undoDislike);
            $statement->bindValue(':postID', $postID);
            $statement->execute();
            $statement->closeCursor();

            $noVote = 'DELETE FROM votes WHERE postID = :postID AND userID = :userID';
            $statement2 = $db->prepare($noVote);
            $statement2->bindValue(':postID', $postID);
            $statement2->bindValue(':userID', $_SESSION['userID']);
            $statement2->execute();
            $statement2->closeCursor();
        }        
    }

    die('success');    
?>