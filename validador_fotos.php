<?php



    function validarFoto($link, $opcion){
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        //$extension = explode('/',$_FILES['file']['type'])[1];
        $existe = false;
        $name ="";
        $ruta = "imgs/uploaded/profile_pics/";
        $user="";
      
        if($opcion == 1){
            $extra = 'registro.php?error=';
            $user = $_POST['user'];            
        }else if($opcion == 2){
            $extra = 'mis_datos.php?error=';
            if(isset($_SESSION['user_login'])){
                $user = $_SESSION['user_login'];
            }
        }
        if(isset($_FILES['file']) && $_FILES['file']['error']!=4){
            $extension = explode('/',$_FILES['file']['type'])[1];
            if($_FILES['file']['error']!= 0){
                $extra .= 'badpic#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }else if($_FILES['file']['size']/1024/1024 > 1){
                $extra .= 'bigpic#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }else if($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif"){
                $extra .= 'badend#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }else{
                //$name = $user .'.'. $extension;
                $name = $user .'.png';
                if(file_exists($ruta . $name))
                    unlink($ruta.$name);       //comprobar que funciona
                move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . $name);    
            }
        }else if(isset($_POST['borraFotoPic'])){
            $name = $_SESSION['user_login'].".png";
            unlink($ruta.$name);
            copy("imgs/uploaded/av.png", $ruta.$name);

        }
        return $name;
    }

    function getNameFoto($link, $opcion){
        if($opcion == 1){
            //$extension = explode('/',$_FILES['file']['type'])[1];
            $user = $_POST['user'];
            $name = $user .'.png';
            $ruta = "imgs/uploaded/profile_pics/";
            $foto = $ruta . $name;
        }
        else if($opcion == 2){
            //$extension = explode('/',$_FILES['file']['type'])[1];
            $user = $_SESSION['user_login'];
            $name = $user .'.png';
            $ruta = "imgs/uploaded/profile_pics/";
            $foto = $ruta . $name;
        }
        return $foto;
    }
?>