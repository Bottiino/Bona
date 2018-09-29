<?php
    function getUserInfoByUsername($username)
    {      
        global $db;
        
        $getUserInfoByName = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($getUserInfoByName);
        $statement->bindValue(':username', $username);        
        $statement->execute();
        $userInfo = $statement->fetch();
        $statement->closeCursor();

        return $userInfo;        
    }
    
    function getUserInfoByID($userID)
    {        
        global $db;
        
        $getUserInfo = "SELECT * FROM users WHERE userID = :userID";
        $statement = $db->prepare($getUserInfo);
        $statement->bindValue(':userID', $userID);        
        $statement->execute();
        $userInfo = $statement->fetch();
        $statement->closeCursor();

        return $userInfo;
    }
    
    function getPosts()
    {
        global $db;
        
        $getAllPosts = "SELECT * FROM posts ORDER BY postID";
        $statement = $db->prepare($getAllPosts);
        $statement->execute();
        $allPosts = $statement->fetchAll();
        $statement->closeCursor();
        
        return $allPosts;
    }
    
    function getTagsByPostID($postID)
    {
        global $db;
        
        $getAllTags = "SELECT * FROM tags WHERE postID = :postID";
        $statement = $db->prepare($getAllTags);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $allPosts = $statement->fetchAll();
        $statement->closeCursor();
        
        return $allPosts;
    }
    
    function getPostInfoByID($postID)
    {
        global $db;
        
        $getPostInfo = "SELECT * FROM posts WHERE postID = :postID";
        $statement = $db->prepare($getPostInfo);
        $statement->bindValue(':postID', $postID);        
        $statement->execute();
        $postInfo = $statement->fetch();
        $statement->closeCursor();

        return $postInfo;
    }
    
    function getPostInfoByText($postText)
    {
        global $db;
        
        $getPostInfo = "SELECT * FROM posts WHERE postText = :postText";
        $statement = $db->prepare($getPostInfo);
        $statement->bindValue(':postText', $postText);        
        $statement->execute();
        $postInfo = $statement->fetch();
        $statement->closeCursor();

        return $postInfo;
    }
    
    function getCommentsForPost($postID)
    {
        global $db;
        
        $getComments = "SELECT * FROM comments WHERE postID = :postID";
        $statement = $db->prepare($getComments);
        $statement->bindValue(':postID', $postID);        
        $statement->execute();
        $comments = $statement->fetchAll();
        $statement->closeCursor();

        return $comments;
    }
    
    function getCommentCount($postID)
    {
        global $db;
        
        $getCount = "SELECT count(`postID`) AS `count` FROM comments WHERE postID = :postID";
        $statement = $db->prepare($getCount);
        $statement->bindValue(':postID', $postID);        
        $statement->execute();
        $count = $statement->fetch();
        $statement->closeCursor();
        
        return $count['count'];
    }
    
    function makeLink($plainText)
    {
        $url = '@(|http(|s)://)([w]{3}\..+?\..+?)(\s|$)@';
        $url = preg_replace($url, '<a href="http://$3" target="_blank" title="$3">$0</a>', $plainText);
        return $url;
    }
    
    function makeTags($plainText)
    {
        $url = '@\W(\#[a-zA-Z0-9]+\b)@';
        $url = preg_replace($url, '<a href="http://$3" target="_blank" title="$3">$0</a>', $plainText);
        return $url;
    }
    
    function checkWords($text, $bad)
    {
        foreach($bad as $word)
        {
            if (strpos(strtolower($text), $word) !== FALSE) 
            { 
                return 'Your text contains some prohibated words!';
            }
        }
        $error = '';
        return $error;
    }
    
    function checkLoggedIn()
    {   
        if (empty($_SESSION['userID'])) 
        {
            //header("Location: loginForm.php?error=You most be logged in to access this feature");

            return "error=You most be logged in to access this feature";
        }
    }
    
    function checkLoggedInPhp()
    {   
        if (empty($_SESSION['userID'])) 
        {
            header("Location: loginForm.php?error=You most be logged in to access this feature");
        }
    }
    
    function errorBox($error)
    {
        if(!empty($error))
        {
            echo'<section id="error" class="comment-section center-text">';
        }
        else
        {
            echo'<section id="error" class="comment-section center-text" style="display: none;">';
        }        
        echo'   <div class="container" >
                    <div class="row">

                        <div class="col-lg-2 col-md-0"></div>

                        <div class="col-lg-8 col-md-12">
                        
                            <div id="error" class="comment alert alert-danger">
                                 ' . $error . '
                            </div> 
                            <p></p>
                             
                        </div>
                    </div>
                </div>        
            </section>';
    }
    
    function checkUsername($name){
        global $db;
                
        $getInfo = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($getInfo);       
        $statement->bindValue(':username', $name);        
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        if(!empty($user))
        {
            return FALSE;
        }
        return TRUE;
    }
    
    function checkEmail($email){
        global $db;
                
        $getInfo = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($getInfo);       
        $statement->bindValue(':email', $email);        
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        if(!empty($user))
        {
            return FALSE;
        }
        return TRUE;
    }
        
    function checkSubbed($email){
        global $db;
                
        $getInfo = "SELECT * FROM subs WHERE email = :email";
        $statement = $db->prepare($getInfo);       
        $statement->bindValue(':email', $email);        
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        if(!empty($user))
        {
            return FALSE;
        }
        return TRUE;
    }
?>