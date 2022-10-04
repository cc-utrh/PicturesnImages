<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>

<?php

    // session_start();

    if(!isset($_SESSION['urlvieja']) && !isset($_SESSION['urlnueva'])){
        $_SESSION['urlnueva']=$_SERVER["REQUEST_URI"];
        $_SESSION['urlvieja']=$_SERVER["REQUEST_URI"];
    }else{
        $_SESSION['urlvieja']=$_SESSION["urlnueva"];
        $_SESSION['urlnueva']=$_SERVER["REQUEST_URI"];
    }
    $_SESSION['res']=$_SERVER["REQUEST_URI"];
    $html="<div id = 'modal' class = 'mmodal'>
    <div class='mensajemodal'>";
        
            if(isset($_GET['error'])){
                if ($_GET['error']=="nolog"){
                    $html.="<h2> Debes identificarte antes</h2>";
                }
            }
        $html.="<form method = 'POST' action='#'>
        <button class='boton'>Aceptar</button>
    </form>
    </div>
    </div>";
    $html.="<h2>Resultados de la búsqueda</h2>

    <div class='centrar'>
    
        
        <h4 style='text-align : center;'><b>Filtro</b></h4>";
        
        if(trim($_POST['titulo']) != "")
            $html.="<p style='text-align : center;'><b>Título: </b>" . $_POST['titulo'] . "</p>";	

        if(trim($_POST['fecha1']) != "")
            $html.="<p style='text-align : center;'><b>Fecha entre: <br></b>" . $_POST['fecha1'] . "</p>";

        if(trim($_POST['fecha2']) != "")
            $html.="<p style='text-align : center;'><b>y: <br></b>". $_POST['fecha2'] . "</p>";

        if(trim($_POST['country'])!="" && $_POST['country'] != 0)
            $html.="<p style='text-align : center;'><b>País: </b>" . getPais($link, $_POST['country']) ."</p>";
        
    
    $html.="</div>".getFotosBusqueda($link, $_POST['titulo'], $_POST['fecha1'], $_POST['fecha2'], $_POST['country']);

    echo $html;
?>

<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>