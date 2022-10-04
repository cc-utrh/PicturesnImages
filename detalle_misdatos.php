<?php include('comprobar_sesion.php'); ?> 
<?php include('navbar2.php'); ?> 

<?php
    // include('comprobar_sesion.php');
    
    include('validador_form_datos.php');
    include('validador_fotos.php');
    // $host = $_SERVER['HTTP_HOST'];
    // $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

    // if(isset($_POST['submitreg'])){
    //     if(empty($_POST['user'])){			    
    //         $extra = 'registro.php?error=uempty#modal';
    //         header("Location: http://$host$uri/$extra");
    //         exit;
    //     }
    //     if(empty($_POST['psw'])){
    //         $extra = 'registro.php?error=pempty#modal';
    //         header("Location: http://$host$uri/$extra");
    //         exit;
    //     }
    //     if(empty($_POST['psw2'])){
    //         $extra = 'registro.php?error=p2empty#modal';
    //         header("Location: http://$host$uri/$extra");
    //         exit;
    //     }
    //     if(!(empty($_POST['user'])) && !(empty($_POST['psw'])) && !(empty($_POST['psw2']))){
    //         if($_POST['psw'] != $_POST ['psw2']){
    //                 $extra = 'registro.php?error=passes#modal';
    //                 header("Location: http://$host$uri/$extra");
    //                 exit;
    //         //         $extra = 'index.php';
    //         //         header("Location: http://$host$uri/$extra");
    //         //         exit;
    //         // }else{
    //         //         $extra = 'registro.php?error=passes#modal';
    //         //         header("Location: http://$host$uri/$extra");
    //         //         exit;
    //         }   
    //     }
    // }else if(isset($_POST['submitmod'])){

    // }
    $nombre_foto = validarFoto($link, 2);
    validar($link, $nombre_foto);
    $ruta_foto = getNameFoto($link, 2);
    if(getSexo($link, $_SESSION['user_login']) == 0){
        $sexo = "Masculino";
    }else{
        $sexo = "Femenino";
    }
   
    $html="<section>
        <h3>Confirmación de modificación</h3>
            <div class='container'>
                <p>Usuario:$_POST[user]</p>
                <p>Email:  $_POST[mail]</p>
                <p>Sexo:  $sexo</p>
                <p>Fecha de nacimiento:  $_POST[fnac]</p>
                <p>Ciudad:  $_POST[ciudad]</p>
                <p>País: ".getPais($link, $_POST['country'])."</p>
                <p>Foto: <img src='".$ruta_foto."' class='align-middle foto-circulo'></p>
                <form action='index2.php'>
                    <button >Aceptar</button>
                </form>
            </div>
    </section>";

    echo $html;
?>




<?php include('footer.php'); ?>