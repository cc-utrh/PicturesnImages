
<?php
    include('db.php');


    function validar($link, $nameP){
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $expLog = "/^[A-Za-z]{1}\w{2,14}$/";
        $expPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d_-]{6,15}$/";
        $name_pic = 'imgs/av.png';
        if($nameP != "")
            $name_pic = $nameP;
        $boolaux = false;
        $a = 0;
        if(isset($_POST['submitreg'])){
            if(isset($_POST['user'])){
                if(preg_match($expLog, $_POST['user']) == 1){
                    if(!getUser($link, $_POST['user']))
                        $a++;
                    else{
                        $extra = 'registro.php?error=unfree#modal';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }
                }else{
                    $extra = 'registro.php?error=unvalid#modal';
                    header("Location: http://$host$uri/$extra");
                    exit;
                }
            }else{
                $extra = 'registro.php?error=uempty#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }

            if(isset($_POST['psw'])){
                if(preg_match($expPass, $_POST['psw']) == 1){
                    $a++;
                }else{
                    $extra = 'registro.php?error=pnvalid#modal';
                    header("Location: http://$host$uri/$extra");
                    exit;
                }
            }else{
                $extra = 'registro.php?error=pempty#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }
            
            if(isset($_POST['psw2']) && isset($_POST['psw'])){
                if($_POST['psw2'] == $_POST['psw'])
                    $a++;
                else{
                    $extra = 'registro.php?error=passes#modal';
                    header("Location: http://$host$uri/$extra");
                    exit;
                }
                    
            }
            else{
                $extra = 'registro.php?error=p2empty#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }
            // Remove all illegal characters from email
            if(isset($_POST['mail'])){
                $email = $_POST['mail'];
                $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                    
                // Validate email address
                if($email == $sanitizedEmail && filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $a++;
                } else{
                    $extra = 'registro.php?error=mailnvalid#modal';
                    header("Location: http://$host$uri/$extra");
                    exit;
                }
            }else{
                $extra = 'registro.php?error=mailempty#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }

            if(!isset($_POST['sexo'])){
                $extra = 'registro.php?error=sexempty#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }else
                $a++;

            if(isset($_POST['fnac'])){
                $time_arr  = explode('/', $_POST['fnac']);
                if (count($time_arr) != 3) {
                    $time_arr  = explode('-', $_POST['fnac']);
                    if (count($time_arr) != 3) {
                        $extra = 'registro.php?error=fnvalid#modal';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }else{
                        if (checkdate($time_arr[1], $time_arr[0], $time_arr[2]) && ($_POST['fnac'])<getdate()) {
                            $a++;
                        }else{
                            $extra = 'registro.php?error=fbad#modal';
                            header("Location: http://$host$uri/$extra");
                            exit;
                        }
                    }
                }else{
                    if (checkdate($time_arr[1], $time_arr[0], $time_arr[2]) && ($_POST['fnac'])<getdate()) {
                        $a++;
                    }else{
                        $extra = 'registro.php?error=fbad#modal';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }
                }
            }else{
                $extra = 'registro.php?error=fempty#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }
            
            $hashed = mkHash($_POST['psw']);
            $fregistro = date('Y-m-d', time());
            $fnac2 = date('y-m-d', strtotime($_POST['fnac']));
            $sql="INSERT INTO usuarios(NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) VALUES('".$_POST['user']."', '".$hashed."', '".$_POST['mail']."', ".$_POST['sexo'].", '".$fnac2."', '".$_POST['ciudad']."', ".$_POST['country'].", '".$name_pic."', '".$fregistro."', 1)";

            if(!mysqli_query($link,$sql)){
                $result="nooK";
            }else{
                $result="ok";
            }
            
        }
        if(isset($_POST['submitmod'])){
            if(isset($_POST['psw-mod'])){
                $sql = "UPDATE usuarios SET ";
                $aux = false;
                $passHash = mkHash($_POST['psw-mod']);
                $passHash2 = mkHash($_POST['psw']);
                $boolpwd = getPass($link, $passHash);
                $result = getUserFull($link, $_SESSION['user_login']);
                $data = mysqli_fetch_array($result);
                if($boolpwd){
                    if(preg_match($expLog, $_POST['user']) == 1){
                        if(!getUser($link, $_POST['user'])){
                            $aux = true;
                            $sql .= "NomUsuario = '".$_POST['user']."'";

                        }else{
                            if(getUser($link, $_POST['user'])!= $data['NomUsuario']){
                                $extra = 'mis_datos.php?error=unfree#modal';
                                header("Location: http://$host$uri/$extra");
                                exit;
                                }
                        }        
                    }else{
                        $extra = 'mis_datos.php?error=unvalid#modal';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }
                    #&& $passHash!=$data['Clave']
                    if(trim($_POST['psw']) != ""){
                        if(preg_match($expPass, $_POST['psw']) == 1){
                            if($aux == true){
                                $sql .= ", Clave = '".$passHash2."'";
                            }else{
                                $sql .= "Clave = '".$passHash2."'";
                                $aux = true;
                            }
                        }else{
                            $extra = 'mis_datos.php?error=pnvalid#modal';
                            header("Location: http://$host$uri/$extra");
                            exit;
                        }
                    }
                        
                    if(isset($_POST['psw2']) && isset($_POST['psw'])){
                        if($_POST['psw2'] == $_POST['psw'])
                            $boolPass2 = true;
                        else{
                            $extra = 'mis_datos.php?error=passes#modal';
                            header("Location: http://$host$uri/$extra");
                            exit;
                        }       
                    }else{
                        $extra = 'mis_datos.php?error=p2empty#modal';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }
                            
                        
                    $email = $_POST['mail'];
                    $sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                    
                    // Validate email address
                    if($email == $sanitizedEmail && filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if($email != $data['Email']){
                            if($aux == true){
                                $sql .= ", Email = '".$email."'";
                            }else{
                                $sql .= "Email = '".$email."'";
                                $aux = true;
                            }
                        }
                    }else{
                        $extra = 'mis_datos.php?error=mailnvalid#modal';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    }
                    
                    $time_arr  = explode('/', $_POST['fnac']);
                    if (count($time_arr) != 3) {
                        $time_arr  = explode('-', $_POST['fnac']);
                        if (count($time_arr) != 3) {
                            $extra = 'mis_datos.php?error=fnvalid#modal';
                            header("Location: http://$host$uri/$extra");
                            exit;
                        }else{
                            if (checkdate($time_arr[1], $time_arr[0], $time_arr[2])) {
                                $fecha_input = strtotime($time_arr[1].'-'.$time_arr[0].'-'.$time_arr[2]);
                                $fecha_actual = strtotime(date("d-m-Y",time()));
                                $fnac2 = date('y-m-d', strtotime($_POST['fnac']));
                                if($fecha_input<$fecha_actual){
                                    if($aux == true){
                                        $sql .= ", FNacimiento = '".$fnac2."'";
                                    }else{
                                        $sql .= "FNacimiento = '".$fnac2."'";
                                        $aux = true;
                                    }
                                }
                            }else{
                                $extra = 'mis_datos.php?error=fbad#modal';
                                header("Location: http://$host$uri/$extra");
                                exit;
                            }
                        }
                    }else{
                        if (checkdate($time_arr[1], $time_arr[0], $time_arr[2])) {
                            $fecha_input = strtotime($time_arr[1].'-'.$time_arr[0].'-'.$time_arr[2]);
                            $fecha_actual = strtotime(date("d-m-Y",time()));
                            $fnac2 = date('y-m-d', strtotime($_POST['fnac']));
                            if($fecha_input<$fecha_actual){
                                if($aux == true){
                                    $sql .= ", FNacimiento = '".$fnac2."'";
                                }else{
                                    $sql .= "FNacimiento = '".$fnac2."'";
                                    $aux = true;
                                }
                            }
                        }else{
                            $extra = 'mis_datos.php?error=fbad#modal';
                            header("Location: http://$host$uri/$extra");
                            exit;
                        }
                    }
                    
                    if($data['Sexo']!=$_POST['sexo']){
                        if($aux == true){
                            $sql.=", Sexo = ".$_POST['sexo'];
                        }
                    else{
                        $sql.=" Sexo = ".$_POST['sexo'];
                        $aux = true;
                        }
                    }

                    if($data['Ciudad']!=$_POST['ciudad']){
                        if($aux == true){
                            $sql.=", Ciudad='".$_POST['ciudad']."'";
                        }
                        else{
                            $sql.=" Ciudad='".$_POST['ciudad']."'";
                            $aux=true;
                        }
                    }
                    $pais = getPais($link, $data['Pais']);
                    if($pais!=$_POST['country']){
                        if($aux == true){
                            $sql.=", Pais=".$_POST['country'];
                        }
                        else{
                            $sql.=" Pais=".$_POST['pais'];
                        }

                    }
                        
                }else{
                    $extra = 'mis_datos.php?error=pbad#modal';
                    header("Location: http://$host$uri/$extra");
                    exit;
                
                    
                }if($aux == false){
                    $sql.=" Foto = '".$nameP."'";
                }else
                    $sql .= ", Foto = '".$nameP."' WHERE NomUsuario = '".$_SESSION['user_login']."'";
                if(!mysqli_query($link,$sql)){
                    $result="nooK";
                }else{
                    $result="ok";
                }
                    
            }else{
                $extra = 'mis_datos.php?error=pemptymod#modal';
                header("Location: http://$host$uri/$extra");
                exit;
            }
        }
    }
    
    
?>