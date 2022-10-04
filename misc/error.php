<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Candela Utrero Romero-Hombrebueno y Carlos Izquierdo López">
        <link rel="stylesheet" href="css/full.css">
        <link rel="alternate stylesheet" type="text/css" href="css/oscuroalt.css" title="Modo oscuro">
        <link rel="alternate stylesheet" type="text/css" href="css/contraste.css" title="Modo bajo contraste">
        <link rel="alternate stylesheet" type="text/css" href="css/letra.css" title="Modo letra grande">
        <link rel="alternate stylesheet" type="text/css" href="css/letraycontraste.css" title="Modo letra grande y bajo contraste">
        <link rel="stylesheet" type="text/css" href="css/printer.css" media="print">
        <title>Error - PI</title>
    </head>

    <body>     <!-- pagina de error, se puede convertir en mensaje modal-->
        <h2>Lo sentimos! Necesitas identificarte para ver esta página</h2>
        <form method="POST" action="login.php">
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>Aún no tienes cuenta? <a href="registro.php">Haz click aquí para crearla</a></p>
        <form method="POST" action="index.php">
            <button type="submit">Cerrar</button> <!-- será un mensaje modal, por tanto, al cerrarlo seguirá en la misma página-->
        </form>
    </body>

</html>