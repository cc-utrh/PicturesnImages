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
    

    // function cerrarConn($link){
    //     mysqli_close($link);
    // }

    // function getPaises($link){
    //     $result = mysqli_query($link, "SELECT NomPais from paises");
    //     $listaPaises = "";
    //     while($data = mysqli_fetch_array($result)){
    //         $listaPaises .= "<option value='". $data['NomPais'] ."'>" .$data['NomPais'] ."</option>";  // displaying data in option menu
    //     }
    //     return $listaPaises;
    // }


    function getUser($link, $aux){
        $result = mysqli_query($link, "SELECT NomUsuario from usuarios where NomUsuario = '".$aux."'");
        $bool1 = false;
        if($result != NULL || $result != ""){
            $bool1 = true;
        }
        return $bool1;
    }

    function getPass($link, $aux){
        $result = mysqli_query($link, "SELECT Clave from usuarios where Clave = '".$aux."'");
        $bool2 = false;
        if($result != NULL || $result != ""){
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

    function getFotosIndex($link){
        $result = mysqli_query($link, "SELECT idFoto, Fichero, FRegistro, Alternativo, TituloFoto, paises.NomPais FROM fotos, paises WHERE fotos.Pais = paises.idPais ORDER BY FRegistro DESC");
        $listaFotos = "
        <section class='fotos-div'>
        <div class='card-columns'>";

        for($i = 0; $i<5; $i++){
            $data = mysqli_fetch_array($result);
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
                                <li>Pertenece al álbum 'El mejor verano'</li> <!-- el nombre del album será un enlace al mismo-->
                                <li>Subida por usuario <i>adventurer223</i></li>  <!--El nombre de usuario será un enlace al perfil-->
                            </ul>
                        </div>
                    </article>
                </div>";
        }

        $listaFotos.="</div></section>";

        return $listaFotos;
    }

    function getPais($link, $aux){
        $result = mysqli_query($link, "SELECT NomPais from paises where idPais = '".$aux."'");
        if($result != NULL){
            return $result;
        }
        else{
            return "No existe el pais";
        }
    }

    function getFotosBusqueda($link, $titulo, $fecha1, $fecha2, $country){
        $sql = "SELECT idFoto, Fichero, FRegistro, Alternativo, Titulo, paises.NomPais FROM fotos, paises WHERE fotos.Pais = paises.idPais";
        if($titulo != ""){
            $sql.= " AND fotos.titulo LIKE '%".$titulo."%'";
        }if($fecha1 != ""){
            $sql .= " AND fecha >".$fecha1;
        }if($fecha2 != ""){
            $sql .= " AND fecha <".$fecha2;
        }if($country != ""){
            $sql .= " AND paises.NomPais = '".$country."'";
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
                            <h1>".$data['Titulo']."</h1>
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

    function getAlbumes($link, $aux){
        $result = mysqli_query($link, "SELECT Titulo FROM albumes, usuarios WHERE NomUsuario = '".$aux."' AND albumes.Usuario = idUsuario");
        $listaAlbumes = "";
        while($data = mysqli_fetch_array($result)){
            $listaAlbumes .= "<option value='". $data['Titulo'] ."'>" .$data['Titulo'] ."</option>";  // displaying data in option menu
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

    function getAlbumesDetalles($link, $idAlbum){
        $resultAlbum = mysqli_query($link, "SELECT * FROM albumes WHERE idAlbum = ".$idAlbum);
        $resultFotos = mysqli_query($link, "SELECT DISTINCT fotos.*, paises.NomPais FROM fotos, albumes, paises WHERE fotos.Album = ".$idAlbum." AND fotos.Pais = paises.idPais");
        $contador = 0;
        $fechaInicio ="";
        $fechaFinal = "";
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
                    <img class='card-img-top mb-2' src='".$data['Fichero']."' alt='".$data['Alternativo']."'>  
                    <div class='card-body'>
                    <h1>". $data['TituloFoto'] ."</h1>
                        <ul>
                            <li>" .$data['DescripcionFoto'] ."</li>
                        </ul>
                    </div>
                </article>
            </div>";
        }
        $listaFotosAlbum.= "<h4> El album contiene ".$contador." fotos, comprendidas entre ".$fechaInicio." y ".$fechaFinal."</h4>";
        $listaFotosAlbum.="</div></section>";

        return $listaFotosAlbum;
    }

    
    




    