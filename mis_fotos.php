<?php include('comprobar_sesion.php');?>
<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>

<?php
    
    $html.=getFotosUsuario($link, $_SESSION['user_login']);

    echo $html;
?>

<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>