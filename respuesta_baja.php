<?php
include('comprobar_sesion.php');
include('navbar2.php');
include('db.php');

$html="<div id = 'modal' class = 'mmodal'>
<div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['result']!="nook"&&$_GET['result']!="pass"){
                $html.="<h2>Tu cuenta ha sido eliminada</h2><form action='index.php' method='POST'>
                <button class='boton'>Volver a inicio</button>";
            }else{
                $html.="<h2>Tu cuenta no se ha podido borrar</h2><form action='index.php' method='POST'>
                <button class='boton'>Prueba otra vez</button>";
            }
        }
    $html.="</form></div></div>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["psw"])){
            $psw=$_POST["psw"];
            $pass=mkHash($psw);
            if(getPass($link, $pass)==1){
                $insertable=true;
            }
        }else{
            $insertable=false;
        }

        if($insertable==true){
            $html.=borrarUser($link);
        }else{
            $host = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            $extra = 'respuesta_baja.php?result=pass#modal';
            header("Location: http://$host$uri/$extra");
            
            exit;
        }
    }

    echo $html;
?>
