<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>
<?php
    $html="<section class='form-container'>
    <h2>Estilos disponibles:</h2>".getEstilos($link)."<h4>Establecer como estilo predeterminado: </h4><form method='post' action='configurar.php'>
    <select id='estilopred' name='estilopred'>".selectEstilos($link)."</select><br><button id='boton2' class='botones2'>Guardar cambios</button></form></section>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["estilopred"])){
            $estiloPred =$_POST["estilopred"];
            updateEstiloPred($link, $estiloPred);
        }
    }

    echo $html;
?>
<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>