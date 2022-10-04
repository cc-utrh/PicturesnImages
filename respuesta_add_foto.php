<?php
include('comprobar_sesion.php');
include('navbar2.php');
include('db.php');

    function uploadFoto($link){
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $partes = explode('/',$_FILES['file']['type']);
        $name="";
        $src = $partes[0];
        $extension = $partes[1];
        $auxCant = getCantFoto($link, $_SESSION['user_login']);
        $ruta = "imgs/uploaded/";
        $extra = 'add_foto.php?error=';
        if(isset($_FILES['file'])){
            if($_FILES['file']['error']!= 0){
                $extra .= 'badpic#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }else if($_FILES['file']['size']/1024/1024 > 1){
                $extra .= 'bigpic#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }else if($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif"){
                $extra .= 'badend#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }
            $name = $src.'('.$auxCant.').png';
            move_uploaded_file($_FILES["file"]["tmp_name"], $ruta .$name);
        }
        return $name;
    }

$html="<div id = 'modal' class = 'mmodal'>
<div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['result']!="nook"&&$_GET['result']!="alt"){
                $html.="<h2>Inserción realizada</h2><form action='index2.php' method='POST'>
                <button class='boton'>Volver a inicio</button>";
            }else{
                $html.="<h2>Inserción fallida</h2><form action='add_foto.php' method='POST'>
                <button class='boton'>Prueba otra vez</button>";
            }
        }
    $html.="</form></div></div>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["titulo"])&&isset($_POST["alt"])){
            $insertable=true;
            $titulo=$_POST["titulo"];
            $alt=$_POST["alt"];
            if(isset($_POST["descripcion"])){
                $descripcion=$_POST["descripcion"];
               
            }else{
                $descripcion=null;
            }

            if(isset($_POST["fecha"])){
                $fecha=$_POST["fecha"];
            }else{
                $fecha=null;
            }

            if(isset($_POST["pais"])){
                $pais=$_POST["pais"];
            }else{
                $pais=null;
            }

            if(isset($_POST["album"])){
                $album=$_POST["album"];
            }else{
                $album=null;
            }

            if(isset($_POST["src"])){
                $src=$_POST["src"];
            }else{
                $src=null;
            }

            if(strlen($alt)<10){
                $insertable=false;
            }

            $expLog="/^(foto.|imagen.)/i";
            if(preg_match($expLog, $alt) == 1){
                $insertable=false;
            }
            $nameFoto = uploadFoto($link);
            if($insertable){
                $html.=newFoto($link, $titulo, $descripcion, $fecha, $pais, $album, $nameFoto, $alt);
            }else{
                $host = $_SERVER['HTTP_HOST'];
                $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                $extra = 'respuesta_add_foto.php?result=alt#modal';
                header("Location: http://$host$uri/$extra");
                
                exit;
            }
        }
    }




    echo $html;
?>
