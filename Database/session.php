<?php
    session_start();
 
    $expireAfter = 900;
 
    if(isset($_SESSION['last_action']))
    {
        $secondsInactive = time() - $_SESSION['last_action'];


        if($secondsInactive >= $expireAfter)
        {
            session_unset();
            session_destroy();
        }    
    }
    $_SESSION['last_action'] = time();
?>