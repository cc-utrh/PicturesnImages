<?php
    // function conectar(){
        //Conecta con el servidor de MySQL
        $link = @mysqli_connect(
            'localhost', // El servidor
            'root', // El usuario
            'root', // La contraseña
            'pibd'); // La base de datos
            
        if(!$link) {
            echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
            echo '</p>';
            exit;
        }
    // }

    function getDetalleFoto($link, $idFoto){
        $result = mysqli_query($link, "SELECT TituloFoto, titulo, fichero, idUsuario, DescripcionFoto, fecha, NomPais, NomUsuario, idAlbum FROM fotos, usuarios, paises, albumes WHERE paises.idPais = fotos.pais AND fotos.idFoto=".$idFoto." AND albumes.idAlbum = fotos.album AND albumes.usuario = usuarios.idUsuario");
        
        while($data = mysqli_fetch_array($result)){
            $Detalles="<section class='fondo-pag'>
                <div class='container-foto'>
                    <article class='card'>
                        <img class='card-img-top mb-2' src='imgs/uploaded/".$data['fichero']."' alt='foto3'>  
                        <div class='card-body'>
                            <h1 class='card-title display-4'>" .$data['TituloFoto'] ."</h1>
                            <ul>
                                <li>" .$data['DescripcionFoto'] ."</li>
                                <li>" .date('d-m-Y', strtotime($data['fecha'])) ."</li>
                                <li>" .$data['NomPais'] ."</li>
                                <li>Pertenece al álbum: <a href='verAlbum.php?id=".$data['idAlbum']."'>".$data['titulo'] ."</a></li>
                                <li>Subida por el usuario <i><a href='perfil_usuario.php?id=".$data['idUsuario']."'>".$data['NomUsuario']."</i></a></li> 
                            </ul>
                        </div>
                    </article>
                </div>
            </section>";
        }

        return $Detalles;
    }

    function getPaises($link, $aux){
        $result = mysqli_query($link, "SELECT idPais, NomPais from paises where idPais != ".$aux);
        $listaPaises = "";
        while($data = mysqli_fetch_array($result)){
            $listaPaises .= "<option value='". $data['idPais'] ."'>" .$data['NomPais'] ."</option>";  // displaying data in option menu
        }
        return $listaPaises;
    }

    function getPaises2($link){
        $result = mysqli_query($link, "SELECT idPais, NomPais from paises");
        $listaPaises = "";
        while($data = mysqli_fetch_array($result)){
            $listaPaises .= "<option value='". $data['idPais'] ."'>" .$data['NomPais'] ."</option>";  // displaying data in option menu
        }
        return $listaPaises;
    }

    function getPerfilUsuario($link, $aux){
        $result = mysqli_query($link, "SELECT NomUsuario, foto, FRegistro FROM usuarios WHERE NomUsuario='".$aux."'");
        $listaDatos = "";
        
        while($data = mysqli_fetch_array($result)){

        $listaDatos.=
        "<div class='center'>
        <article class='card card-pin'>
            <h2>Perfil de " .$data['NomUsuario'] ."</h2><section class='fotos-div'>
            <img class='foto-circulo' src='imgs/uploaded/profile_pics/". $data['foto']."' alt='foto3'>
            <div class='card-body'>
            Se unió el " .date('d-m-Y', strtotime($data['FRegistro'])) ."</li>
            </div>
        </article></div></section>";
        }

        return $listaDatos;
    }

    function getListadoAlbumesUsuario($link, $aux){
        $id=getIdporNombre($link);
        $total = 0;
        $result = mysqli_query($link, "SELECT idAlbum, titulo FROM albumes WHERE Usuario = '".$id."'");
        $listaAlbumes="";

        while($data = mysqli_fetch_array($result)){
            $result2 = mysqli_query($link, "SELECT count(*) as cuantas FROM fotos WHERE album=".$data['idAlbum']."");
            $data2=mysqli_fetch_array($result2);
            $listaAlbumes.="<li>".$data['titulo']." - ".$data2['cuantas']." foto(s)</li>";
            $total += $data2['cuantas'];
        }
        $listaAlbumes .="<li> Total de fotos que se van a eliminar: ".$total."</li>";
        return $listaAlbumes;
    }



    function getAlbumesUsuario($link, $aux){
        $result = mysqli_query($link, "SELECT idAlbum, titulo, fichero, descripcion FROM albumes, fotos, usuarios WHERE usuarios.NomUsuario = '".$aux."' AND fotos.album=albumes.idAlbum AND albumes.usuario=usuarios.idUsuario");
   
        
        $listaAlbumes = "<h2>Álbumes:</h2>
        <section class='fotos-div'>
        <div class='card-columns'>";

        while($data = mysqli_fetch_array($result)){
            $listaAlbumes.="
            <div class='container container-fluid'>
                <article class='card card-pin'>
                <a href='verAlbum.php?id=".$data['idAlbum']."'><img class='card-img-top mb-2' src='imgs/uploaded/".$data['fichero']."' alt='foto3'></a>  
                    <div class='card-body'>
                    <h1>". $data['titulo'] ."</h1>
                        <ul>
                            <li>" .$data['descripcion'] ."</li>
                        </ul>
                    </div>
                </article>
            </div>";
        }

        $listaAlbumes.="</div></section>";

        return $listaAlbumes;
    }

    function getFotosUsuario($link, $aux){
        $result = mysqli_query($link, "SELECT idAlbum, TituloFoto, titulo, fichero, fecha, NomPais FROM fotos, albumes, usuarios, paises WHERE usuarios.NomUsuario = '".$aux."' AND fotos.album=albumes.idAlbum AND paises.idPais = fotos.pais AND albumes.usuario=usuarios.idUsuario");
   
        
        $listaFotos = "<h2>Fotos:</h2>
        <section class='fotos-div'>
        <div class='card-columns'>";

        while($data = mysqli_fetch_array($result)){
            $listaFotos.=
            "<div class='container container-fluid'>
                <article class='card card-pin'>
                    <img class='card-img-top mb-2' src='imgs/uploaded/".$data['fichero']."' alt='foto3'>  
                    <div class='card-body'>
                    <h1>". $data['TituloFoto'] ."</h1>
                        <ul>
                            <li>Fecha: " .date('d-m-Y', strtotime($data['fecha'])) ."</li>
                            <li>País: " .$data['NomPais'] ."</li>
                            <li>Pertenece al álbum:  <a href='verAlbum.php?id=".$data['idAlbum']."'>" .$data['titulo'] ."</li></a>
                        </ul>
                    </div>
                </article>
            </div>";
        }

        $listaFotos.="</div></section>";

        return $listaFotos;
    }

    function getRutaFotos($link, $aux){
        $result = mysqli_query($link, "SELECT Fichero, albumes.Usuario, usuarios.idUsuario FROM fotos, usuarios, albumes WHERE usuarios.NomUsuario = '".$aux."' AND albumes.usuario=usuarios.idUsuario");

        return $result;
    }

    function getUserFull($link, $aux){
        if(mysqli_query($link, "SELECT * from usuarios where NomUsuario = '".$aux."'")){
            $result = mysqli_query($link, "SELECT * from usuarios where NomUsuario = '".$aux."'");
        }else{
            $result = false;
        }
        return $result;
    }

    function getUser($link, $aux){
        $result = mysqli_query($link, "SELECT NomUsuario from usuarios where NomUsuario = '".$aux."'");
        $bool1 = false;
        $data = mysqli_fetch_array($result);
        if(isset($data['NomUsuario']) && $data['NomUsuario'] != NULL && $data['NomUsuario'] != ""){
            $bool1 = true;
        }
        return $bool1;
    }

    function getPass($link, $aux){
        $result2 = mysqli_query($link, "SELECT Clave from usuarios where Clave = '".$aux."'");
        $bool2 = false;
        $data = mysqli_fetch_array($result2);
       
        if(isset($data['Clave']) && $data['Clave'] != NULL && $data['Clave'] != ""){
            $bool2 = true;
            
        }
 
        return $bool2;
    }

    function getEstilo($link, $aux){
        $result = mysqli_query($link, "SELECT Fichero from usuarios, estilos where usuarios.NomUsuario = '".$aux."' AND usuarios.Estilo = estilos.idEstilo");
        $devolver = mysqli_fetch_row($result);
        return $devolver[0];
    }

    function mkHash($pass){
        $passHash = hash('sha256', $pass);
        return $passHash;
    }

    function getSexo($link, $aux){
        $result = mysqli_query($link, "SELECT Sexo from usuarios where usuarios.NomUsuario = '".$aux."'");
        $devolver = mysqli_fetch_row($result);
        return $devolver[0];
    }

    function getFotosIndex($link){
        $result = mysqli_query($link, "SELECT idUsuario, idFoto, Fichero, fotos.FRegistro, Alternativo, TituloFoto, NomPais, idAlbum, Titulo, NomUsuario FROM fotos, paises, albumes, usuarios WHERE fotos.Pais = paises.idPais AND albumes.Usuario = usuarios.idUsuario AND fotos.album = albumes.idAlbum ORDER BY fotos.FRegistro DESC");
        $listaFotos = "
        <section class='fotos-div'>
        <div class='card-columns'>";

        for($i = 0; $i<5; $i++){
            $data = mysqli_fetch_array($result);
            // $idPais = $data['Pais'];
            $listaFotos.="
            <div class='container container-fluid'>
                    <article class='card card-pin'>
                        <a href='detalle_foto.php?id=".$data['idFoto']."'><img class='card-img-top mb-2' src='imgs/uploaded/".$data['Fichero']."' alt='".$data['Alternativo']."'></a>  
                        <div class='card-body'>
                            <h1>".$data['TituloFoto']."</h1>
                            <ul>
                                <li><time datatime='".date('d-m-Y', strtotime($data['FRegistro'])) ."'>".date('d-m-Y', strtotime($data['FRegistro'])) ."</time></li>
                                <li>".$data['NomPais']."</li>
                                <li>Pertenece al álbum  <a href='verAlbum.php?id=".$data['idAlbum']."'>" .$data['Titulo'] ."</a></li>
                                <li>Subida por usuario <i><a href='perfil_usuario.php?id=".$data['NomUsuario']."'>".$data['NomUsuario']."</i></a></li>  <!--El nombre de usuario será un enlace al perfil-->
                            </ul>
                        </div>
                    </article>
                </div>";
        }

        $listaFotos.="</div></section>";

        return $listaFotos;
    }

    function getConsejosIndex(){
        $html="<section><blockquote class='ludwig'>";

        $json = file_get_contents('consejos.json');
        $json_decoded = json_decode($json, TRUE);

        shuffle($json_decoded);
        $html.=$json_decoded[0]['Consejo']."</blockquote><p>";
        $consejo=$json_decoded[0];


        $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($consejo), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($jsonIterator as $key => $val) {
            if($key!='Consejo') {
                if(is_array($val)) {
                    $html.="<strong>$key: </strong>&nbsp;&nbsp;";
                    // $html.="<br>";
                } else {
                    $html.="<strong>$key: </strong>$val&nbsp;&nbsp;";
                    // $html.="<br>";
                }
            }
        }

        $html.="</p></section>";

        return $html;
        
    }

    function getFotoporId($link, $id){
        $result = mysqli_query($link, "SELECT Fichero as src, Alternativo as alt, TituloFoto as titulo, DescripcionFoto as descr, Fecha as fecha, Pais as pais FROM fotos WHERE idFoto=".$id."");
        $data = mysqli_fetch_array($result);
        return $data;
    }

    function parse_line($line) {
        $fields = explode('|', $line);
        $data = array();

        foreach($fields as $field) {
            
            list($key, $value) = explode(':', $field, 2);

            $key = trim($key);
            $value = trim($value);
            $data[$key] = $value;
        }
        return $data;
    }

    function getFotoEscogida($link){
        $html="<section class='fotos-div'>
        <div>";
        
        $handle=fopen('fotos_destacadas.txt', "r");
        $lines = array();
        $data="";

        if($handle){
            while(($line = fgets($handle))!==false){
                $data = parse_line($line);
                $lines[$data['idFoto']] = $data;
            }
            shuffle($lines);

            $res=getFotoporId($link,$lines[1]['idFoto']);

            $html.="
            <div class='container container-fluid'>
                    <article class='card card-pin'>
                    <a href='detalle_foto.php?id=".$lines[1]['idFoto']."'><img class='card-img-top mb-2' src='imgs/uploaded/".$res['src']."' alt='".$res['alt']."'></a> 
                        <div class='card-body'>
                            <h5>".$lines[1]['critico']." dice:</h5>
                            <p>".$lines[1]['comentario']."</p>";

            if($res['src']!=""){
                $html.="<h1>". $res['titulo'] ."</h1>
                            <ul>
                            <li>Descripción: ".$res['descr']."</li>

                            <li>Fecha: " .date('d-m-Y', strtotime($res['fecha'])) ."</li>
                            <li>Pais: " .getPais($link, $res['pais'])."</li>
                        </ul>
                        </div>
                    </article>
                </div>";
            }

            fclose($handle);
        }else{
            $html.="error abriendo";
        }
        // $html.=$archivo;
        $html.="</div></section>";
        return $html;
    }
    

    function getPais($link, $aux){
        $result = mysqli_query($link, "SELECT NomPais from paises where idPais = '".$aux."'");
        if($result != NULL){
            $data = mysqli_fetch_array($result);
            return $data['NomPais'];
        }
        else{
            return "No existe el pais";
        }
    }

    function classSexo($aux){
        if($aux == 0)
            $s = "Masculino";
        else
            $s = "Femenino";
        return $s;
    }



    function getFotosBusqueda($link, $titulo, $fecha1, $fecha2, $country){
        $sql = "SELECT idFoto, Fichero, FRegistro, Alternativo, TituloFoto, paises.NomPais FROM fotos, paises WHERE fotos.Pais = paises.idPais";
        if($titulo != ""){
            $sql.= " AND fotos.titulo LIKE '%".$titulo."%'";
        }if($fecha1 != ""){
            $sql .= " AND fecha >".$fecha1;
        }if($fecha2 != ""){
            $sql .= " AND fecha <".$fecha2;
        }if($country != "" && $country != 0){
            $sql .= " AND paises.idPais = '".$country."'";
        }
        $result = mysqli_query($link, $sql);
        $listaFotos = "
        <section class='fotos-div'>
        <div class='card-columns'>";

        while($data = mysqli_fetch_array($result)){
            // $idPais = $data['Pais'];
            $listaFotos.="
            <div class='container container-fluid'>
                    <article class='card card-pin'>
                        <a href='detalle_foto.php?id=".$data['idFoto']."'><img class='card-img-top mb-2' src='".$data['Fichero']."' alt='".$data['Alternativo']."'></a>  
                        <div class='card-body'>
                            <h1>".$data['TituloFoto']."</h1>
                            <ul>
                                <li><time datatime='".$data['FRegistro']."'>".$data['FRegistro']."</time></li>
                                <li>España</li>
                            </ul>
                        </div>
                    </article>
                </div>";
        }
        $listaFotos.="</div></section>";

        return $listaFotos;
    }

    function getOptAlbumById($link, $id){
        $result = mysqli_query($link, "SELECT Titulo FROM albumes WHERE idAlbum=".$id."");
        $listaAlbumes = "";
        while($data = mysqli_fetch_array($result)){
            $listaAlbumes .= "<option value='".$id."'>" .$data['Titulo'] ."</option>";  // displaying data in option menu
        }
        return $listaAlbumes;
    }

    function getAlbumes($link, $aux){
        $result = mysqli_query($link, "SELECT Titulo FROM albumes, usuarios WHERE NomUsuario = '".$aux."' AND albumes.Usuario = idUsuario");
        $listaAlbumes = "";
        while($data = mysqli_fetch_array($result)){
            $listaAlbumes .= "<option value='". $data['Titulo'] ."'>" .$data['Titulo'] ."</option>";  // displaying data in option menu
        }
        return $listaAlbumes;
    }
    
    function getAlbumes2($link, $aux){
        $result = mysqli_query($link, "SELECT Titulo, idAlbum FROM albumes, usuarios WHERE NomUsuario = '".$aux."' AND albumes.Usuario = idUsuario");
        $listaAlbumes = "";
        while($data = mysqli_fetch_array($result)){
            $listaAlbumes .= "<option value='". $data['idAlbum'] ."'>" .$data['Titulo'] ."</option>";  // displaying data in option menu
        }
        return $listaAlbumes;
    }

    function getEstilos($link){
        $result = mysqli_query($link, "SELECT Nombre FROM estilos");
        $listaEstilos = "";
        while($data = mysqli_fetch_array($result)){
            $listaEstilos.= "<li>" .$data['Nombre'] ."</li>";
        }
        return $listaEstilos;
    }

    function selectEstilos($link){
        $result = mysqli_query($link, "SELECT Nombre, idEstilo FROM estilos");
        $listaEstilos = "";
        
        while($data = mysqli_fetch_array($result)){
            $listaEstilos.= "<option value='". $data['idEstilo'] ."'>" .$data['Nombre'] ."</option>";
        }

        return $listaEstilos;
    }


    function updateEstiloPred($link, $estiloPred){
        $expiraEn=time()+(86400*90);

        if(!mysqli_query($link, "UPDATE usuarios SET estilo='".$estiloPred."' WHERE NomUsuario ='".$_SESSION['user_login']."'")){
            $result="nook";
        }else{
            $result="ok";
        }
        setcookie("user_estilo",getEstilo($link, $_POST['user_login']), $expiraEn);
        $_SESSION["user_estilo"]=getEstilo($link, $_SESSION['user_login']);

        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'configurar_respuesta.php?result='.$result.'#modal';
        header("Location: http://$host$uri/$extra");
        
        exit;
    }

    function getIdporNombre($link){
        $result = mysqli_query($link, "SELECT idUsuario FROM usuarios WHERE NomUsuario ='".$_SESSION['user_login']."'");

        while($data = mysqli_fetch_array($result)){
            $id=$data['idUsuario'];
        }
        return $id;
    }

    function getFotoPerfil($link, $name){
        $result = mysqli_query($link, "SELECT Foto FROM usuarios WHERE NomUsuario = '".$_SESSION['user_login']."'");
        $data = mysqli_fetch_array($result);
        return $data['Foto'];
    }

    function getCantFoto($link, $name){
        $result = mysqli_query($link, "SELECT count(*) AS numFotos FROM fotos WHERE Fichero LIKE '".$name."%'");
        $data = mysqli_fetch_array($result);
        return $data['numFotos'];
    }

    function newAlbum($link, $titulo, $descripcion){
        $id=getIdporNombre($link);

        if(!mysqli_query($link, "INSERT INTO albumes (idAlbum, Titulo, Descripcion, Usuario) VALUES (null, '".$titulo."', '".$descripcion."', ".$id.") ")){
            $result="nooK";
        }else{
            $result=mysqli_insert_id($link);
        }


        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'crear_album_respuesta.php?result='.$result.'#modal';
        header("Location: http://$host$uri/$extra");
        
        exit;
    }

    function newFoto($link, $titulo, $descripcion, $fecha, $pais, $album, $src, $alt){
        $freg= date('y-m-d');
        $fecha2 = date('y-m-d', strtotime($fecha));
        $sql="INSERT INTO fotos VALUES (null, '".$titulo."', '".$descripcion."', '".$fecha2."', ".$pais.",'".$album."', '".$src."', '".$alt."', '".$freg."')";
        
        if(!mysqli_query($link,$sql)){
            $result="nooK";
        }else{
            $result="ok";
        }

        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'respuesta_add_foto.php?result='.$result.'#modal';
        header("Location: http://$host$uri/$extra");
        
        exit;

    }

    function newSolicitud($link, $nombre, $titulo, $descripcion, $email, $direccion, $cp, $localidad, $provincia, $pais, $tel, $color, $copias, $res, $album, $frec, $icolor, $coste){
        $date = date('y-m-d');
        $frec2 = date('y-m-d', strtotime($frec));
        if($icolor==true){
            $icolor=1;
        }else{
            $icolor=0;
        }
        if(!mysqli_query($link, "INSERT INTO solicitudes VALUES (null,".$album.", '".$nombre."', '".$titulo."', '".$descripcion."', '".$email."', '".$direccion."',".$cp.", '".$localidad."', '".$provincia."',".$pais." , '".$color."', ".$copias.", ".$res.", '".$date."',".$icolor.", '".$frec2."',".$coste.")")){
            $result="nooK";
        }else{
            $result="ok";
        }

        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'confirmar_respuesta_album.php?result='.$result.'#modal';
        header("Location: http://$host$uri/$extra");
        
        exit;
    }

    function borrarUser($link){
        $id=getIdporNombre($link);
        $sql="DELETE FROM usuarios WHERE idUsuario = " . $id;
        //print_r(mysqli_query($link,$sql));
        if(mysqli_query($link,$sql) == false){
            $result="nooK";
        }else{
            $result="ok";
            $data = getRutaFotos($link, $_SESSION['user_login']);
            while($data2=mysqli_fetch_assoc($data)){
                unlink("imgs/uploaded/$data2[fichero]");
            }
            $resultado=getFotoPerfil($link, $_SESSION['user_login']);
            unlink("imgs/uploaded/profile_pics/$resultado");
        }
        
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        $extra = 'respuesta_baja.php?result='.$result.'#modal';
        header("Location: http://$host$uri/$extra");
        
        exit;

    }

    function getAlbumesDetalles($link, $idAlbum){
        $resultAlbum = mysqli_query($link, "SELECT albumes.*, NomUsuario FROM albumes, usuarios WHERE idAlbum = ".$idAlbum." AND albumes.Usuario = usuarios.idUsuario");
        $resultFotos = mysqli_query($link, "SELECT DISTINCT fotos.*, paises.NomPais FROM fotos, albumes, paises WHERE fotos.Album = ".$idAlbum." AND fotos.Pais = paises.idPais");
        $resultPaises = mysqli_query($link, "SELECT DISTINCT paises.NomPais FROM fotos, albumes, paises WHERE fotos.Album = ".$idAlbum." AND fotos.Pais = paises.idPais");
        $contador = 0;
        $fechaInicio ="";
        $fechaFinal = "";
        $usuarioAlbum = 
        $predata = mysqli_fetch_array($resultAlbum);
        $listaFotosAlbum = "
        <section class='fotos-div'>
        <h1>".$predata['Titulo']."</h1>
        <p>".$predata['Descripcion']."</p>
        <div class='card-columns'>";

        while($data = mysqli_fetch_array($resultFotos)){
            $contador++;
            if($fechaInicio =="" || $data['Fecha'] < $fechaInicio)
                $fechaInicio =  $data['Fecha'];
            if($fechaFinal =="" || $data['Fecha'] > $fechaFinal)
                $fechaFinal=  $data['Fecha'];
            $listaFotosAlbum.="
            <div class='container container-fluid'>
                <article class='card card-pin'>
                    <a href='detalle_foto.php?id=".$data['idFoto']."'><img class='card-img-top mb-2' src='imgs/uploaded/".$data['Fichero']."' alt='".$data['Alternativo']."'></a>  
                    <div class='card-body'>
                    <h1>". $data['TituloFoto'] ."</h1>
                        <ul>
                            <li>" .$data['DescripcionFoto'] ."</li>
                        </ul>
                    </div>
                </article>
            </div>";
        }
        $listaFotosAlbum.= "<h4> El album contiene ".$contador." fotos, comprendidas entre ".date('d-m-Y', strtotime($fechaInicio)) ." y ".date('d-m-Y', strtotime($fechaFinal)) ."</h4>
        <h4> Los países inmortalizados en este álbum son: </h4>";
        while($dataPais = mysqli_fetch_array($resultPaises)){
            $listaFotosAlbum .= "<li>" .$dataPais['NomPais'] ."</li>";
        }
        $listaFotosAlbum.= "<h4> El album pertenece a  <i><a href='perfil_usuario.php?id=".$predata['NomUsuario']."'>".$predata['NomUsuario']."</i></a></h4>";

        $listaFotosAlbum.="</div></section>";

        return $listaFotosAlbum;
    }

    function cerrarConn($link){
        mysqli_close($link);
    }