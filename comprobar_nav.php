<?php
    session_start();
    if(isset($_COOKIE["user_login"]) || isset($_SESSION["user_login"])){
        include('navbar2.php');
    }else{
        include('navbar.php');
    }


?>