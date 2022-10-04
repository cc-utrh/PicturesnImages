<?php
    session_start();

    // if(!isset($_SESSION['urlvieja'])){
    //     $_SESSION['urlnueva']=$_SERVER["REQUEST_URI"];
    //     $_SESSION['urlvieja']=$_SERVER["REQUEST_URI"];
    // }else{
    //     $_SESSION['urlvieja']=$_SERVER["urlnueva"];
    //     $_SESSION['urlnueva']=$_SERVER["REQUEST_URI"];
    // }

    if(!isset($_COOKIE["user_login"])){
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        // $extra = 'index.php';
        // Location: http://$host$uri/$extra"
        if(!isset($_SESSION["user_login"])){
            
        // $urlindex = $_SESSION['index'];
        // $urlres = $_SESSION['res'];
        // $urlfin="/";

        // $urlaux =0;
        // $uriData=explode("/",substr($_SESSION['urlvieja'], 1));
        // for($i = 0; $i<sizeof($uriData); $i++){
        //     // print_r($uriData[$i]);
        //     if($uriData[$i] == 'index.php'){
        //         $urlaux = 1;
        //         // print_r($urlaux);
        //         break;
        //     }else if($uriData[$i] == 'resultado.php'){
        //         $urlaux = 2;
        //         break;
        //     }else{
        //         $urlfin .= $uriData[$i] . "/";
        //     }
        // }
        
        // if($urlaux == 1){
            $extra = 'index.php?error=nolog#modal';
            header("Location: http://$host$uri/$extra");
            exit;
        // }if($urlaux == 2){
        //     $extra = '?error=nolog#modal';
        //     header("Location: http://$host$urlfin$extra");
        //     exit;

        }
       
    }else{
        if(!isset($_SESSION["user_login"])){
            $_SESSION["user_login"]=$_COOKIE["user_login"];
            $_SESSION["user_password"]=$_COOKIE["user_password"];
            $_SESSION["user_fecha"]=$_COOKIE["user_fecha"];
            $_SESSION["user_hora"]=$_COOKIE["user_hora"];
        }
    }
?>