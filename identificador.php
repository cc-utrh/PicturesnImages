<?php include('db.php'); ?>
<?php
    session_start();
    // $users = array(
    //     array("Carlos", "Mayo1994", "oscuroalt"),
    //     array("Candela" , "Noviembre1994", "contraste"),
    //     array("Jorge" , "Diciembre2001", "letra"),
    //     array("Sergio" , "Noviembre2001", "full"),
    //     array("Sara", "Septiembre2001", "full"));

    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    
    $booluser = false;
    $boolpwd = false;

    if(isset($_POST['submitlog'])){
        if(empty($_POST['login'])){
            $extra = 'index.php?error=uempty#modal';
            header("Location: http://$host$uri/$extra");
            exit;
        }
        if(empty($_POST['pwd'])){
            $extra = 'index.php?error=pempty#modal';
            header("Location: http://$host$uri/$extra");
            exit;
        }
        if(!(empty($_POST['login'])) && !(empty($_POST['pwd']))){
            $booluser = getUser($link, $_POST['login']);
            
            $passHash = mkHash($_POST['pwd']);
            $boolpwd = getPass($link, $passHash);
            
            if($booluser == true){
                if($boolpwd == true){
                    $expiraEn=time()+(86400*90);
                    $_SESSION["user_login"]=$_POST["login"];
                    $_SESSION["user_password"]=mkHash($_POST['pwd']);
                    $_SESSION["user_fecha"]=date('d-m-y');
                    $_SESSION["user_hora"]=date('h:i');
                    $_SESSION["user_estilo"]=getEstilo($link, $_POST['login']);

                    if(isset($_POST['recuerdame'])){
                        
                        setcookie("user_login",$_POST["login"], $expiraEn);
                        setcookie("user_password", mkHash($_POST['pwd']),$expiraEn);
                        setcookie("user_fecha", date('d-m-y'),$expiraEn);
                        setcookie("user_hora", date('h:i'),$expiraEn);
                        setcookie("user_estilo",getEstilo($link, $_POST['login']), $expiraEn);
                    }
                    $extra = 'index2.php';
                    header("Location: http://$host$uri/$extra");
                    exit;
                }else{
                    $extra = 'index.php?error=pass#modal';
                    header("Location: http://$host$uri/$extra");
                    exit;
                }
            }else{
                $extra = 'index.php?error=log#modal';
                header("Location: http://$host$uri/$extra");
            }
            exit;
        }
    }
    // print_r($_SESSION);
    // print_r($_COOKIE);
?>