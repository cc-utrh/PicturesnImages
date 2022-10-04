<?php
    session_start();
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        
        setcookie("user_login", "", time() - 3600);
        setcookie("user_password", "", time() - 3600);
        
        setcookie("contrasenya", "", time() - 3600);
        setcookie("usuario", "", time() - 3600);
        
        unset($_SESSION['user_login']);
        unset($_SESSION['user_password']);
        
        session_destroy();
        
        header("Location: http://$host$uri/index.php");
        exit;

?>