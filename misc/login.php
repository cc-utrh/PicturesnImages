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
        <title>Iniciar Sesión - PI</title>
    </head>

    <body>

        <header>
            <nav class="navbar fixed-top">           <!-- barra de navegación de la parte pública-->
                <a class="navbar-brand nav-link" href="index.php"><img src="imgs/home3.png" alt="home" class="icon-home"></a>
                <div class="navdiv">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="buscar.php"><p class="barr">Buscar</p></a></li>
                        <li class="nav-item"><a class="nav-link" href="registro.php"><p class="barr">Registro</p></a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <section class="section-login form-container sign-in-container">
            <h2>Identifícate</h2>
            <form method="POST" action="identificador.php" class="formulari-login">
                <label>Usuario<input type="text" name="login" ></label><br>
                <label>Contraseña<input type="password" name="pwd" id="psw"></label><br>
                <button name = "submitlog">Identificarse</button>
            </form>
            <!--a href="index2.php"><button>Identificarse</button><a></a-->
            <p>Aún no tienes cuenta? <a href="registro.php">Haz click aquí para crearla</a></p>
        </section>
        
        <footer >
            <p>&copy; DAW Prácticas 21-22</p>
            <p>Carlos Izquierdo López y Candela Utrero Romero-Hombrebueno</p>
            <a href="accesibilidad.php">Declaración de accesibilidad</a>

        </footer>

    </body>
</html>