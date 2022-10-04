<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>

<?php
    
    $html=getAlbumesDetalles($link, $_GET['id']);

    if($_SESSION['user_login'] ?? ""){
        $html.="<section class='botones'>
                    <form action='add_foto.php' method='post'><button id='boton2' class='botones2'>Añadir foto a album</button></form>
                </section>";
    }

    echo $html;
?>

<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>