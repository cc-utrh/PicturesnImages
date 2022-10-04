<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>

<?php
$html="<div id = 'modal' class = 'mmodal'>
<div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['result']=="ok"){
                $html.="<h2>Solicitud realizada. Recibirás un email con los detalles.</h2><form action='index2.php' method='POST'>
                <button class='boton'>Volver al menú</button>";
            }else{
                $html.="<h2>Inserción fallida</h2><form action='index2.php' method='POST'>
                <button class='boton'>Prueba en otro momento</button>";
            }
        }
    $html.="</form></div></div>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["nombre"])){
            $nombre=$_POST["nombre"];
        }else{
            $nombre=null;
        }

        if(isset($_POST["titulo"])){
            $titulo=$_POST["titulo"];
        }else{
            $titulo=null;
        }

        if(isset($_POST["descripcion"])){
            $descripcion=$_POST["descripcion"];
        }else{
            $descripcion=null;
        }
        if(isset($_POST["email"])){
            $email=$_POST["email"];
        }else{
            $email=null;
        }

        if(isset($_POST["direccion"])){
            $direccion=$_POST["direccion"];
        }else{
            $direccion=null;
        }

        if(isset($_POST["cp"])){
            $cp=$_POST["cp"];
        }else{
            $cp=null;
        }

        if(isset($_POST["localidad"])){
            $localidad=$_POST["localidad"];
        }else{
            $localidad=null;
        }

        if(isset($_POST["provincia"])){
            $provincia=$_POST["provincia"];
        }else{
            $provincia=null;
        }

        if(isset($_POST["pais"])){
            $pais=$_POST["pais"];
        }else{
            $pais=null;
        }

        if(isset($_POST["telefono"])){
            $tel=$_POST["telefono"];
        }else{
            $tel=null;
        }

        if(isset($_POST["color"])){
            $color=$_POST["color"];
        }else{
            $color=null;
        }

        if(isset($_POST["copias"])){
            $copias=$_POST["copias"];
        }else{
            $copias=null;
        }

        if(isset($_POST["res"])){
            $res=$_POST["res"];
        }else{
            $res=null;
        }

        if(isset($_POST["album"])){
            $album=$_POST["album"];
        }else{
            $album=null;
        }

        if(isset($_POST["frec"])){
            $frec=$_POST["frec"];
        }else{
            $frec=null;
        }

        if(isset($_POST["icolor"])){
            $icolor=$_POST["icolor"];
        }else{
            $icolor=null;
        }

        if(isset($_POST["coste"])){
            $coste=$_POST["coste"];
        }else{
            $coste=null;
        }
        

        newSolicitud($link, $nombre, $titulo, $descripcion, $email, $direccion, $cp, $localidad, $provincia, $pais, $tel, $color, $copias, $res, $album, $frec, $icolor, $coste);

    }

echo $html;
?>

