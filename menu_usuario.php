<?php include('navbar2.php'); ?>
<?php
    $html="<h2>PI - Pictures & Images</h2>

    <section>
        <h4>Mis datos</h4>
        <label>Nombre de Usuario:".$_SESSION["user_login"]."</label><br>
        <label>E-mail:&nbsp;&nbsp;usuario@usuario.es</label><br>
        <label>Sexo:&nbsp;&nbsp; NSNC</label><br>
        <label>Fecha de nacimiento:&nbsp;&nbsp;01/01/1990</label><br>
        <label>Ciudad de residencia:&nbsp;&nbsp;Alicante</label><br>
        <label>Pais:&nbsp;&nbsp;España</label><br>
        <button>Modificar mis datos</button><br><br>
    </section>

    <button>Darme de baja</button><br><br>


    <button>Mis álbumes</button><br>
    <button>Crear álbum</button><br>
    <form action='solicitar_album.php' method='POST'>
        <button type='submit'>Solicitar álbum</button>
    </form>

    <form action='index.php' method='POST'>
        <button type='submit'>Salir</button>
    </form>";
    
    echo $html;
?>
<?php include('footer.php'); ?>

