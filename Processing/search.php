<?PHP
    include_once '../Database/validate.php';
    include_once '../Database/session.php';
    require '../Database/database.php';
    include '../Database/functions.php';
        
    $username = check_input($_POST['username']);
    $tag = check_input($_POST['tag']);
    $keyword = check_input($_POST['keyword']);
    
    $query = 'SELECT * FROM posts AS po '
            . 'INNER JOIN users AS us ON po.userID=us.userID '
            . 'WHERE UPPER(username) LIKE UPPER(:name) AND UPPER(postTags) LIKE UPPER(:tag) AND UPPER(postText) like UPPER(:keyword)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', '%' . $username . '%');
    $statement->bindValue(':tag', '%' . $tag . '%');
    $statement->bindValue(':keyword', '%' . $keyword . '%');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    die(json_encode($result));
?>