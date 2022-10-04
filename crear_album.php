<?php
    include('comprobar_sesion.php');
    include('navbar2.php');
    include('db.php');

    $html="<div id = 'modal' class = 'mmodal'>
        <div class='mensajemodal'>";
    
        if(count($_GET)>0){
            if($_GET['result']!="nook"){
                $html.="<h2>Inserción realizada</h2><form action='add_foto.php' method='POST'>
                <input type='hidden' name='crear_album' value='true'</input>
                <input type='hidden' name='album' value='".$_GET['result']."'</input>
                <button class='boton'>Prueba a añadir fotos</button>";
            }else{
                $html.="<h2>Inserción fallida</h2><form action='crear_album.php' method='POST'>
                <button class='boton'>Prueba otra vez</button>";
            }
        }
    $html.="</form></div></div>";
    
    $html.="<section class='form-container'>
    <form method='post' action='crear_album_respuesta.php' class='formulari'>	
        <h3><strong>Crear Álbum</strong></h3>
        <p> (*) Obligatorio </p>

        <label>Titulo (*)<input type'text' name='titulo'></label>		

        <label>Descripción<input type='text' name='descripcion'></label>

        <button type='submit'>Continuar</button>

    </form>
    </section>";

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     if(trim($_POST["titulo"])!=""){
    //         $titulo=$_POST["titulo"];
    //         if(isset($_POST["descripcion"])){
    //             $descripcion=$_POST["descripcion"];
    //            newAlbum($link, $titulo, $descripcion);
    //         }
    //     }else{
            
    //     }
    // }

    echo $html;
?>
<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>