<?php
include('comprobar_sesion.php');
include('navbar2.php');
include('tabla_detalle.php');
$html="<!DOCTYPE html>

<html lang='en'>

    <body>
        <section>
            <a href='solicitar_album.php'>Haz click aquí para volver a la página anterior</a>"
            .tablaPrecio().
        "</section>";
    echo $html;
?>

<?php include('footer.php'); ?>