<?php
    $dsn = 'mysql:host=localhost;dbname=blog';
    $username = 'root';
    $password = 'Password1!';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        die($error_message);
    }
?>