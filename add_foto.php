<?php
include('comprobar_sesion.php');
include('navbar2.php');
include('db.php'); 

    $html="<div id = 'modal' class = 'mmodal'>
    <div class='mensajemodal'>";
        if(count($_GET)>0){
            if ($_GET["error"]=="badpic"){
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
    </div>";
                       
    $html.="
    <section class='section-registro'>
        <form action='respuesta_add_foto.php' method='POST' class='formulari' enctype='multipart/form-data'>
        <label>Título de la foto (*)&nbsp;&nbsp;</label><input type='text' name='titulo' placeholder='Título' maxlength='200'><br><br>
        <label>Descripción de la foto&nbsp;&nbsp;</label><input name='descripcion' maxlength='400'><br><br>
        <label>Fecha de la foto&nbsp;<input type='date' name='fecha' class='input-2'></label><br><br>
        <div class='select'>
            <label>Pais:&nbsp;&nbsp;</label>
            <select id='country' name='pais'>" . getPaises2($link) ."</select>
        <div class='select__arrow'></div><br><br>
        <label>Foto a subir&nbsp;&nbsp;</label><input type='file' required='' name='file'><br><br>
        <label>Texto alternativo de la foto&nbsp;&nbsp;</label><input type='text' name='alt' required='' placeholder=''><br><br>
        <label>Álbum a añadir&nbsp;
            <div class='select'>
                <select required name='album'>";
                if(isset($_POST['crear_album'])){
                    $id=$_POST['album'];
                    $html.=getOptAlbumById($link,$id);
                }else{
                    $html.=getAlbumes2($link, $_SESSION['user_login']);
                }
                $html.="
                </select>
                <div class='select__arrow2'></div>
            </div>
        </label><br><br>
        <button type='reset'>Borrar datos</button>
        <button type='submit'>Enviar datos</button>
            </form>
        </section>";
    
    echo $html;
?>

<?php include('footer.php');?>
        