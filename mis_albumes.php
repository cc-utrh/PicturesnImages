<?php include('comprobar_sesion.php');?>
<?php include('navbar2.php'); ?>
<?php include('db.php'); ?>

<?php
    
    $html.="<section class='botones'>
                <form action='mis_fotos.php' method='post'><button id='boton2' class='botones2'>Mis Fotos</button></form>
            </section>";
    $html.=getAlbumesUsuario($link,$_SESSION['user_login']);

    echo $html;
?>

<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>