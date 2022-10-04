<?php
    
    // print_r($_COOKIE["user_login"]);
    // print_r($_SESSION["user_login"]);

    include('comprobar_sesion.php');
    include('db.php');
    include('navbar2.php');
 
    
    $html="<h1>Pictures & Images</h1>
        
    <section class='boton'>
        <form action='solicitar_album.php' method='post'><button>Solicitar álbum con tus fotos</button></form>
    </section>
    <section class='botones'>
        <form action='add_foto.php' method='post'><button id='boton2' class='botones2'>Añadir Foto</button></form>
        <form action='crear_album.php' method='post'><button id='boton2' class='botones2'>Crear álbum</button></form>
        <form action='mis_albumes.php' method='post'><button id='boton2' class='botones2'>Mis álbumes</button></form>
    </section>
    
    
    <h3>Últimas fotos</h3>".getFotosIndex($link)."
    <h3>La foto destacada de hoy: </h3>". getFotoEscogida($link)."
    <h3>Consejo Fotográfico del día:</h3>". getConsejosIndex();

    echo $html;

?>
<?php include('footer.php'); ?>