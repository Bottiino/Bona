<?php 
    include_once '../Database/session.php';
    
    session_unset(); 
    session_destroy();
    
    header('location: ../loginForm.php');
?>