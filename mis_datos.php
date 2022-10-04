<?php include('comprobar_sesion.php');?>
<?php include('navbar2.php'); ?>

<?php include('db.php'); ?>

<?php
    $html="<div id = 'modal' class = 'mmodal'>
    <div class='mensajemodal'>";
        
        if(count($_GET)>0){
            if($_GET["error"]=="uempty"){
                $html.="<h2> El usuario está vacío</h2>";
            }else if ($_GET["error"]=="unfree"){
                $html.="<h2> El usuario no está libre</h2>";
            }else if ($_GET["error"]=="unvalid"){
                $html.="<h2> El usuario no tiene un formato válido</h2>";
            }if ($_GET["error"]=="pempty"){
                $html.="<h2> La contraseña está vacía</h2>";
            }else if ($_GET["error"]=="p2empty"){
                $html.="<h2>Repetir contraseña está vacía</h2>";
            }else if ($_GET["error"]=="pnvalid"){
                $html.="<h2> La contraseña no tiene un formato válido</h2>";
            }if ($_GET["error"]=="passes"){
                $html.="<h2>Las contraseñas no coinciden</h2>";
            }if ($_GET["error"]=="pbad"){
                $html.="<h2>Las contraseña es incorrecta</h2>";
            }if ($_GET["error"]=="mailnvalid"){
                $html.="<h2> El email no es válido</h2>";
            }else if ($_GET["error"]=="mailempty"){
                $html.="<h2> El email está vacío</h2>";
            }if ($_GET["error"]=="sexempty"){
                $html.="<h2> Debes seleccionar un sexo</h2>";
            }if ($_GET["error"]=="fnavlid"){
                $html.="<h2> La fecha tiene un formato erróneo</h2>";
            }else if ($_GET["error"]=="fbad"){
                $html.="<h2> La fecha no es correcta</h2>";
            }else if ($_GET["error"]=="fempty"){
                $html.="<h2> La fecha de nacimiento no puede estar vacía</h2>";
            }if ($_GET["error"]=="pemptymod"){
                $html.="<h2> Debe introducir la contraseña para aceptar los cambios</h2>";
            }if ($_GET["error"]=="badpic"){
                $html.="<h2>Esta foto no se puede utilizar</h2>";
            }else if ($_GET["error"]=="bigpic"){
                $html.="<h2> La foto pesa demasiado</h2>";
            }else if ($_GET["error"]=="badend"){
                $html.="<h2> El formato de la foto no es compatible</h2>";
            }
        }
        $html.="<form action='#' method='POST'>
                <button class='boton'>Aceptar</button>
            </form>
        </div>
    </div>" 
        
?>
<?php include('formulario_misdatos.php');?>
<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php');?>