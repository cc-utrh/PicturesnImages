<?php
    include('validador_fotos.php');
    if($_SESSION['user_login'] ?? ""){
        $result = mysqli_query($link, "SELECT usuarios.* , paises.NomPais, paises.idPais FROM usuarios, paises WHERE NomUsuario = '".$_SESSION['user_login']."' AND usuarios.Pais = paises.idPais");
        $data = mysqli_fetch_array($result);
        $fnac2 = date('d-m-Y', strtotime($data['FNacimiento']));
        if($data['Sexo'] == 0){
            $sex = 1;
            $alter = "Femenino";
        }else{
            $sex = 0;
            $alter = "Masculino";
        }
    }

    $html.="<section class='section-registro'>";
            if($_SESSION['user_login'] ?? ""){ 
                $html.="
                <h2>Modificar mis datos</h2>
                <form class='formulari' action ='detalle_misdatos.php' method='POST' enctype='multipart/form-data'>
                    <label id = 'user-label'>Nombre de Usuario:&nbsp;&nbsp;<input type='text' placeholder='Nombre de usuario'  class='user-input' name ='user' value='".$data['NomUsuario']."'></label><br>
                <label id = 'pass-label'>Nueva contraseña:&nbsp;&nbsp;<input type='password' placeholder='Contraseña' name='psw' value=''></label><br>
                <label id = 'pass2-label'>Repetir contraseña:&nbsp;&nbsp;<input type='password' placeholder='Repetir contraseña'  name='psw2' value=''></label><br>
                <label id = 'mail-label'>E-mail:&nbsp;&nbsp;<input type='text' placeholder='Correo electrónico' onblur = 'onBlurEmail(this)' name='mail' value='".$data['Email']."'></label><br>
                <div class='select'>
                        <label id='sexo-label'>Sexo:&nbsp;&nbsp;</label><select name='sexo' value='".$data['Sexo']."'>
                        <option value='".$data['Sexo']."' selected> ".classSexo($data['Sexo'])."</option>";
                        $html.="<option value='".$sex."'>".$alter."</option>

                        </select>
                        <div class='select__arrow'></div>
                    </div>
                <label id='fecha-label'>Fecha de nacimiento:&nbsp;&nbsp;<input type='text' placeholder='dd/MM/YYYY' class='input-2' onblur='onBlurDate(this)' name='fnac' value='".$fnac2."'></label><br>
                <label>Ciudad de residencia:&nbsp;&nbsp;<input type='text' placeholder='Ciudad de residencia' name='ciudad' value='".$data['Ciudad']."'></label><br>
                <div class='select'>
                    <label>Pais:&nbsp;&nbsp;</label>
                    <select id='country' name='country'>
                        <option value='". $data['idPais'] ."' selected>" .$data['NomPais'] ."</option>";
                        $html.= getPaises($link, $data['idPais']) ."</select>
               <div class='select__arrow'></div>
            </div>             
                <label>Foto:&nbsp;&nbsp;<img src='imgs/uploaded/profile_pics/".$_SESSION['user_login'].".png' alt='fotoVacia' width='50' height='50' class='foto-circulo'></label><input type='file' class='input-2' name='file'><br>
                <p>Borrar foto<input type='checkbox' name='borraFotoPic'></p>
                <label id = 'pass-label'>Introduzca la contraseña actual para confirmar:&nbsp;&nbsp;<input type='password' placeholder='Contraseña' name='psw-mod' value=''></label><br>
                <button class = 'botones2' name='submitmod'>Modificar</button>
            </form>";
            }else{

                $user = "";
                $pass = "";
                $pass2 = "";
                $mail = "";
                $sexo = "";
                $country = "";
                $html.="
                <h2>Regístrate como nuevo usuario</h2>
                <form class='formulari' action ='detalle_registro.php' method='POST' enctype='multipart/form-data'>
                    <label id = 'user-label'>Nombre de Usuario:&nbsp;&nbsp;<input type='text' placeholder='Nombre de usuario'  class='user-input' name ='user' value='$user'></label><br>
                    <label id = 'pass-label'>Contraseña:&nbsp;&nbsp;<input type='password' placeholder='Contraseña' name='psw' value='$pass'></label><br>
                    <label id = 'pass2-label'>Repetir contraseña:&nbsp;&nbsp;<input type='password' placeholder='Repetir contraseña'  name='psw2' value='$pass2'></label><br>
                    <label id = 'mail-label'>E-mail:&nbsp;&nbsp;<input type='text' placeholder='Correo electrónico' onblur = 'onBlurEmail(this)' name='mail' value='$mail'></label><br>
                        <div class='select'>
                        <label id='sexo-label'>Sexo:&nbsp;&nbsp;</label><select name='sexo' value='$sexo'>";

                        $html.="<option value='1'>Femenino</option>
                            <option value='0'>Masculino</option>
                        </select>
                        <div class='select__arrow'></div>
                    </div>
                    <!-- <label>Fecha de nacimiento:&nbsp;&nbsp;<input type='date' class='input-2'></label><br> -->
                    <label id='fecha-label'>Fecha de nacimiento:&nbsp;&nbsp;<input type='text' placeholder='dd/MM/YYYY' class='input-2' onblur='onBlurDate(this)' name='fnac' value='";
                        if(isset($_POST['fnac'])){
                            $html.=$_POST['fnac'];
                        };
                        $html.="'></label><br>
                    <label>Ciudad de residencia:&nbsp;&nbsp;<input type='text' placeholder='Ciudad de residencia' name='ciudad'></label><br>
                    <div class='select'>
                        <label>Pais:&nbsp;&nbsp;</label>
                        <select id='country' name='country' value='$country'>";
                        
                        $html.=getPaises2($link)."</select>
                   <div class='select__arrow'></div>
                </div>             
                    <label>Foto:&nbsp;&nbsp;<img src='imgs/av.png' alt='fotoVacia' width='50' height='50' class='foto-circulo'></label><input type='file' name='file' class='input-2' ><br>
                
                <button name='submitreg'>Registrarme</button>
            </form>";
        }
            // <!--a href='index2.php'><button>Registrarme</button></a-->
        $html.="</section>";

    echo $html;
?>