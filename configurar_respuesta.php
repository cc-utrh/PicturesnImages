<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>

<?php
$html="<div id = 'modal' class = 'mmodal'>
<div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['result']=="ok"){
                $html.="<h2>Los cambios se han actualizado</h2>";
            }else{
                $html.="<h2>Los cambios no se han guardado</h2>";
            }
        }
    $html.="<form action='index2.php' method='POST'>
    <button class='boton'>Aceptar</button>
</form>
</div>
</div>";

echo $html;
?>