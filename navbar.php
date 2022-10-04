<?php
    // session_start();

    $_SESSION['error']="bien";

    function comprobarLogin(){
        if(isset($_POST['login'])) return $_POST['login'];
    }

    function comprobarPsw(){
        if(isset($_POST['pwd'])) return $_POST['pwd'];
    }
    
    function comprobarEstilo(){
        $default="full.css";
        if(isset($_SESSION["user_estilo"])){
            $default=$_SESSION["user_estilo"];
        }
        return $default;
    }
    

    $html="<!DOCTYPE html>

    <html lang='es'>
    
        <head>
            <meta charset='utf-8'>        
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
            <meta name='author' content='Candela Utrero Romero-Hombrebueno y Carlos Izquierdo López'>
            <link rel='stylesheet' href='css/".comprobarEstilo()."'>
            <link rel='alternate stylesheet' type='text/css' href='css/oscuroalt.css' title='Modo oscuro'>
            <link rel='alternate stylesheet' type='text/css' href='css/contraste.css' title='Modo bajo contraste'>
            <link rel='alternate stylesheet' type='text/css' href='css/letra.css' title='Modo letra grande'>
            <link rel='alternate stylesheet' type='text/css' href='css/letraycontraste.css' title='Modo letra grande y bajo contraste'>
            <link rel='stylesheet' type='text/css' href='css/printer.css' media='print'>
            
            <title>PI - Pictures & Images</title>
        </head>
    
        <body>
            <header>
                <nav class='navbar fixed-top'>
                    <a class='navbar-brand nav-link' href='index.php'><img src='imgs/home3.png' alt='home' class='icon-home'></a>
                    <div class='navdiv'>
                        <ul class='navbar-nav ml-auto' >
                            <form class='bd-search hidden-sm-down' action='resultado.php'>
                                <input class='barra-busqueda' placeholder='Búsqueda rápida' type='search' name='buscar' id='buscar'>
                            </form>
                        </ul>
                        <ul class='navbar-nav ml-auto'>
                            <li class='nav-item'><a class='nav-link' href='buscar.php'><p class='barr'>Buscar</p></a></li>
                            <li class='nav-item'><a class='nav-link' href='registro.php'><p class='barr'>Registro</p></a></li>
                            <li class='nav-item_2'><label class ='lblchk' for='chMenu'><p class='barr'>Login</p></label><input type='checkbox' id='chMenu'>
                                <section class='mis-datos'>
                                    <h4><strong>Inicio sesión</strong></h4>
                                    <form method='POST' action='identificador.php'>
                                        <label>Usuario<input type='text' name='login' id='user' value='".comprobarLogin()."'></label><br>
                                        <label>Contraseña<input type='password' name='pwd' id='pwd' value='".comprobarPsw()."'></label><br>
                                        <label>Recuérdame<input type='checkbox' name='recuerdame'></label>
                                        <input type='submit' id='btn-login' class='submit-in' value='Identificarse' name='submitlog'>
                                    </form>
                                </section>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </header>";
    echo $html;
?>
