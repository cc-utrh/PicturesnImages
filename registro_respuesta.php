<?php include('navbar.php'); ?>
<?php include('db.php'); ?>

<?php
    $html="<div id = 'modal' class = 'mmodal'>
    <div class='mensajemodal'>";
        
        if(count($_GET)>0){
            if($_GET["error"]=="uempty"){
                $html.="<h2> El usuario está vacío</h2>";
            }else if ($_GET["error"]=="pempty"){
                $html.="<h2> La contraseña está vacía</h2>";
            }else if ($_GET["error"]=="p2empty"){
                $html.="<h2>Repetir contraseña está vacía</h2>";
            }if ($_GET["error"]=="passes"){
                $html.="<h2>Las contraseñas no coinciden</h2>";
            }
        }
        
?>
<?php include('formulario_misdatos_respuesta.php');?>
<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php');?>