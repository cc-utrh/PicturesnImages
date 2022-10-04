<?php

$html="<!DOCTYPE html><html lang='es'>
    <head>
        <meta charset='utf-8'>        
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <meta name='author' content='Candela Utrero Romero-Hombrebueno y Carlos Izquierdo López'>
        <link rel='stylesheet' href='css/".$_SESSION["user_estilo"]."'>
        <link rel='alternate stylesheet' type='text/css' href='css/oscuroalt.css' title='Modo oscuro'>
        <link rel='alternate stylesheet' type='text/css' href='css/contraste.css' title='Modo bajo contraste'>
        <link rel='alternate stylesheet' type='text/css' href='css/letra.css' title='Modo letra grande'>
        <link rel='alternate stylesheet' type='text/css' href='css/letraycontraste.css' title='Modo letra grande y bajo contraste'>
        <link rel='stylesheet' type='text/css' href='css/printer.css' media='print'>

        <title>PI - Pictures & Images</title>
    </head>

    <body>
        <header>
            <!--Barra de navegación alternativa, con el usuario registrado-->
            <nav class='navbar fixed-top'>
                <a class='navbar-brand nav-link ' href='index2.php'><img src='imgs/home3.png' alt='home' class='icon-home'></a>
                <div class='navdiv'>
                    <ul class='navbar-nav ml-auto' >
                        <form class='bd-search hidden-sm-down' action='resultado.php'>
                            <input class='barra-busqueda' placeholder='Búsqueda rápida' type='search' name='buscar' id='buscar' >
                        </form>
                    </ul>
                    <ul class='navbar-nav ml-auto ul-2'>
                        <li class='nav-item'><a class='nav-link' href='buscar.php'><p class='barr'>Buscar</p></a></li>
                        <li class='nav-item_2'><a class='user-nav nav-link'><p>Bienvenid@, ". $_SESSION["user_login"]."</p></a><img src='imgs/uploaded/profile_pics/".$_SESSION['user_login'].".png' alt='fotoav' class='align-middle foto-circulo'><label class ='lblchk' for='chMenu'>&equiv;</label><input type='checkbox' id='chMenu'> 
                            <section class='mis-datos'>
                                <label>Hola&nbsp;".$_SESSION["user_login"]."!</label><br>
                                <label>Tu última visita fue el &nbsp".$_SESSION["user_fecha"].",</label>
                                <label>a las&nbsp;".$_SESSION["user_hora"]."</label><br><br><br>
                                <form action='mis_datos.php' method='POST'>
                                <button class='botones2' type='submit'>Ver mis datos</button>
                                </form>
                                <form action='configurar.php' method='POST'>
                                <button class='botones2' type='submit'>Configurar estilo</button>
                                </form>
                                <form action='darse_baja.php' method='POST'><button class='botones2' type='submit'>Darme de baja</button></form>
                            </section>
                        </li>
                        <li class='nav-item'><a class='nav-link' href='logout.php'><p class='barr'>Logout</p></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        ";
        echo $html;
    ?>