<?php
    session_start();

    if(!isset($_COOKIE["user_login"])){
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'index.php';
        
        if(!isset($_SESSION["user_login"])){
            header("Location: http://$host$uri/$extra");
            exit;
        }
       
    }else{
        if(!isset($_SESSION["user_login"])){
            $_SESSION["user_login"]=$_COOKIE["user_login"];
            $_SESSION["user_password"]=$_COOKIE["user_password"];
            $_SESSION["user_fecha"]=$_COOKIE["user_fecha"];
            $_SESSION["user_hora"]=$_COOKIE["user_hora"];
            $_SESSION["user_estilo"]=$_COOKIE["user_estilo"];
        }
    }
?>