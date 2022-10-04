<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(trim($_POST["titulo"])!=""){
        $titulo=$_POST["titulo"];
        if(isset($_POST["descripcion"])){
            $descripcion=$_POST["descripcion"];
           newAlbum($link, $titulo, $descripcion);
        }
    }else{
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'crear_album.php?result=nook#modal';
        header("Location: http://$host$uri/$extra");
        exit;
    }
}
$html="<div id = 'modal' class = 'mmodal'>
<div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['result']!="nook"){
                $html.="<h2>Inserción realizada</h2><form action='add_foto.php' method='POST'>
                <input type='hidden' name='crear_album' value='true'</input>
                <input type='hidden' name='album' value='".$_GET['result']."'</input>
                <button class='boton'>Prueba a añadir fotos</button>";
            }else{
                $html.="<h2>Inserción fallida</h2><form action='crear_album.php' method='POST'>
                <button class='boton'>Prueba otra vez</button>";
            }
        }
    $html.="</form></div></div>";

echo $html;
?>