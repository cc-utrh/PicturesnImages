<?php
    // session_start();

    if(isset($_COOKIE["user_login"])){
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'index2.php';
        header("Location: http://$host$uri/$extra");
        exit;
    }
?>