<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>
<?php
    $html="<h2>Sentimos que quieras darte de baja...</h2>
    <section><p>Ten en cuenta que perderás los siguientes álbumes y fotos:</p><ul>".
    getListadoAlbumesUsuario($link, $_SESSION['user_login'])."</ul></section>
    <section class='form-container'>
    <h4>Introduce tu contraseña para borrar tu cuenta:</h4>
    <form method='post' action='respuesta_baja.php'>
    <input type='password' name='psw'></input><br><button id='boton2' class='botones2'>Confirmar</button>
    </form>
    </section>";
    
    echo $html;
?>
<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>