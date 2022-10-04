<?php
include('comprobar_sesion.php');
include('navbar2.php');
include('db.php');
    function calcularPrecio()
    {
        $paginas = 5;
        $min = 0;
        $precio =0;

        if($_POST['color'] == "on"){
            $min += 0.05*3;
        }
        if($_POST["res"] > "300"){
            $min += 0.02*3;
        }
        for($i=0; $i< $paginas; $i++){
            $precio += 0.1 + $min;
            if($i>4){
                $precio -=0.02;
            }
            if($i>11){
                $precio -= 0.01;
            }
        }
        return $precio;
    }

    function aColor(){
        $Bcolor = "No";
        if($_POST['icolor'] == "on"){
            $Bcolor = "Sí";
        }
        return $Bcolor;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["nombre"])){
            $nombre=$_POST["nombre"];
        }else{
            $nombre=null;
        }

        if(isset($_POST["titulo"])){
            $titulo=$_POST["titulo"];
        }else{
            $titulo=null;
        }

        if(isset($_POST["descripcion"])){
            $descripcion=$_POST["descripcion"];
        }else{
            $descripcion=null;
        }
        if(isset($_POST["email"])){
            $email=$_POST["email"];
        }else{
            $email=null;
        }

        if(isset($_POST["direccion"])){
            $direccion=$_POST["direccion"];
        }else{
            $direccion=null;
        }

        if(isset($_POST["cp"])){
            $cp=$_POST["cp"];
        }else{
            $cp=null;
        }

        if(isset($_POST["localidad"])){
            $localidad=$_POST["localidad"];
        }else{
            $localidad=null;
        }

        if(isset($_POST["provincia"])){
            $provincia=$_POST["provincia"];
        }else{
            $provincia=null;
        }

        if(isset($_POST["pais"])){
            $pais=$_POST["pais"];
        }else{
            $pais=null;
        }

        if(isset($_POST["telefono"])){
            $tel=$_POST["telefono"];
        }else{
            $tel=null;
        }

        if(isset($_POST["color"])){
            $color=$_POST["color"];
        }else{
            $color=null;
        }

        if(isset($_POST["copias"])){
            $copias=$_POST["copias"];
        }else{
            $copias=null;
        }

        if(isset($_POST["res"])){
            $res=$_POST["res"];
        }else{
            $res=null;
        }

        if(isset($_POST["album"])){
            $album=$_POST["album"];
        }else{
            $album=null;
        }

        if(isset($_POST["frec"])){
            $frec=$_POST["frec"];
        }else{
            $frec=null;
        }

        if(isset($_POST["icolor"])){
            $icolor=$_POST["icolor"];
        }else{
            $icolor=null;
        }
        if(isset($confirmada)&&$confirmada==true){
            
            $confirmada=false;
        }else{
            $confirmada=true;
        }

    }

    $html="<h2>Confirmación de impresión de álbum</h2>
    <p class='centrar'>En Pictures & Images ofrecemos la posibilidad de enviarte impresos tus álbumes favoritos. Te ofrecemos distintas opciones Lorem ipsum dolor sit amet.</p>
       
    <section>
        <form action='solicitar_album.php' method='POST'>
        <h2>Datos de la solicitud</h2>
        <div class='respuesta'>

        <label><b>Nombre:</b>&nbsp;&nbsp;</label>$_POST[nombre]<br><br>
        <label><b>Título del álbum:</b>&nbsp;&nbsp;</label>$_POST[titulo]<br><br>
        <label><b>Descripción del álbum:</b>&nbsp;&nbsp;</label>$_POST[descripcion]<br><br>
        <label><b>Correo electrónico:</b>&nbsp;&nbsp;$_POST[email]</label><br><br>

        <label><b>Dirección:</b>&nbsp;&nbsp;</label><br><br>
        <label><b>Calle:</b></label>&nbsp;&nbsp;$_POST[direccion]&nbsp;<br>".
        // <label><b>Número: </b></label>$_POST[numero]&nbsp;<br>
        // <label><b>Piso:</b></label>&nbsp;&nbsp;$_POST[piso]&nbsp;<br>
        // <label><b>Puerta: </b>&nbsp;&nbsp;</label>$_POST[puerta]&nbsp;<br>
        "<label><b>Código Postal:</b>&nbsp;&nbsp;</label>$_POST[cp]&nbsp;<br>
        <label><b>Localidad: </b>&nbsp;&nbsp;</label>$_POST[localidad]&nbsp;<br>
        <label><b>Provincia: </b></label>$_POST[provincia]<br>
        <label><b>País</b>:&nbsp;&nbsp;</label>$_POST[pais]<br><br>

        <label><b>Teléfono:</b>&nbsp;&nbsp;</label>$_POST[telefono]<br><br>
        <label><b>Color de la portada:</b>&nbsp;&nbsp;</label><input type='color' disabled value=.$_POST[color].class='input-color'><br><br>
        <label><b>Número de copias:</b>&nbsp;&nbsp;$_POST[copias]<br><br> 
        
        <label><b>Resolucion de las fotos escogida:</b></label>&nbsp;
        <input type='range' value=. $_POST[res] . min='150' max='900' disabled>&nbsp;<output id='textOutput' for='resolucion'>$_POST[res]</output><br><br>
        
        <label><b>Álbum de fotos a imprimir escogido:</b>&nbsp;
            $_POST[album]
        </label><br><br>
        
        <label><b>Fecha de recepción:</b>&nbsp;$_POST[frec]<br><br>
        <label><b>Impresión de las fotos a color: ". aColor()."</b>&nbsp;</label><br><br>

        <label><b>Precio final: ". calcularPrecio()."€</b></label>
        <br>
        <button type='submit'>Volver y editar datos</button>
    
    </div>
    </form>
    <form action='confirmar_respuesta_album.php' method='POST'>
        <div class='respuesta'>
        <input type='hidden' name='nombre' value='".$nombre."'</input>
        <input type='hidden' name='titulo' value='".$titulo."'</input>
        <input type='hidden' name='descripcion' value='".$descripcion."'</input>
        <input type='hidden' name='email' value='".$email."'</input>
        <input type='hidden' name='direccion' value='".$direccion."'</input>
        <input type='hidden' name='cp' value='".$cp."'</input>
        <input type='hidden' name='localidad' value='".$localidad."'</input>
        <input type='hidden' name='provincia' value='".$provincia."'</input>
        <input type='hidden' name='pais' value='".$pais."'</input>
        <input type='hidden' name='tel' value='".$tel."'</input>
        <input type='hidden' name='color' value='".$color."'</input>
        <input type='hidden' name='copias' value='".$copias."'</input>
        <input type='hidden' name='res' value='".$res."'</input>
        <input type='hidden' name='album' value='".$album."'</input>
        <input type='hidden' name='frec' value='".$frec."'</input>
        <input type='hidden' name='icolor' value='".$icolor."'</input>
        <input type='hidden' name='coste' value='".calcularPrecio()."'</input>
        <button type='submit'>Confirmar solicitud</button>
        </div>
    </form>
    </section>";

    // <button type='submit'>Confirmar Solicitud</button>
    //     <form action='solicitar_album.php' method='POST'>
    //         
    //     </form>

    echo $html;
    
?>


<?php include('footer.php'); ?>