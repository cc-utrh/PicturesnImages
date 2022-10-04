<?php
    include('comprobar_sesionF.php');
    include('navbar2.php');
    include('db.php');

    if(!isset($_SESSION['urlvieja']) && !isset($_SESSION['urlnueva'])){
        $_SESSION['urlnueva']=$_SERVER["REQUEST_URI"];
        $_SESSION['urlvieja']=$_SERVER["REQUEST_URI"];
    }else{
        $_SESSION['urlvieja']=$_SESSION["urlnueva"];
        $_SESSION['urlnueva']=$_SERVER["REQUEST_URI"];
    }
    //    session_start();
       
        // if(isset($_SESSION["user_login"])||isset($_COOKIE["user_login"])){
        
        
        // $host = $_SERVER['HTTP_HOST'];
        // $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        // $urlindex = $_SESSION['index'];
        // $urlres = $_SESSION['res'];
        // print_r($_SESSION['index']);
       
        // $urlaux =0;
        // $uriData=explode("/",substr($_SESSION['index'], 1));
        // for($i = 0; $i<sizeof($uriData); $i++){
        //     print_r($uriData[$i]);
        //     if($uriData[$i] == 'index.php'){
        //         $urlaux = 1;
        //         print_r($urlaux);
        //         break;
        //     }
        // }
        // if(!(isset($_SESSION['user_login']))){
        //     if($urlaux == 1){
        //         $extra = '?error=nolog#modal';
        //         header("Location: http://$host$urlindex$extra");
        //         exit;
        //     }else{
        //         $extra = '?error=nolog#modal';
        //         header("Location: http://$host$urlres$extra");
        //         exit;
        //     }
        // }
    
        $html=getDetalleFoto($link,$_GET['id']);

        
        // switch(fmod($_GET['id'], 2)){
        //     case 0:
        //         $fecha="16/05/2016";
        //         $pais="España";
        //         $album="El mejor verano";
        //         $usuario="adventurer223";
        //         $titulo="El río";
        //         $src="https://images.unsplash.com/photo-1506706435692-290e0c5b4505?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=0bb464bb1ceea5155bc079c4f50bc36a&auto=format&fit=crop&w=500&q=60";
        //     break;
        //     case 1:
        //         $fecha="23/11/2018";
        //         $pais="Francia";
        //         $album="Mis recetas";
        //         $usuario="cocinillas34";
        //         $titulo="Nueva ensalada";
        //         $src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e0245bb4e87077312cc3d102e68c1efd&auto=format&fit=crop&w=735&q=80";
        //     break;
        // }
        
        
       

        echo $html;
        
        // }else{
        //     $host = $_SERVER['HTTP_HOST'];
        //     $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        //     $extra = 'index.php';
        //     header("Location: http://$host$uri/$extra");
        //     exit;
        // }
    ?>

<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>