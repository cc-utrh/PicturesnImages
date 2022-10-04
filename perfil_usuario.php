<?php include('comprobar_sesion.php');?>
<?php include('navbar2.php'); ?>
<?php include('db.php'); ?> 

<?php
    $html.=getPerfilUsuario($link,$_GET['id']);
    
    $html.=getAlbumesUsuario($link,$_GET['id']);

    echo $html;
?>

<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>