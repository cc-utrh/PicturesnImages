<?php include('navbar.php'); ?>
<?php include('comprobar_sesion_reg.php');?>
<?php include('db.php'); ?>

<?php

// session_start();

$html="<div id = 'modal' class = 'mmodal'>
<div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['error']=="uempty"){
                $html.="<h2> El usuario está vacío</h2>";
            }else if ($_GET['error']=="pempty"){
                $html.="<h2> La contraseña está vacía</h2>";
            }if ($_GET['error']=="log"){
                $html.="<h2> El usuario es incorrecto</h2>";
            }
            if ($_GET['error']=="pass"){
                $html.="<h2> La contraseña es incorrecta</h2>";
            }
            if ($_GET['error']=="nolog"){
                $html.="<h2> Debes identificarte antes</h2>";
            }
        }
    $html.="<form action='index.php' method='POST'>
    <button class='boton'>Aceptar</button>
</form>
</div>
</div>
<h1>Pictures & Images</h1>

<h3>Últimas fotos</h3>". getFotosIndex($link)."

<h3>La foto destacada de hoy: </h3>". getFotoEscogida($link)."

<h3>Consejo Fotográfico: </h3>". getConsejosIndex();



echo $html;
?>



<?php include('footer.php'); ?>
    