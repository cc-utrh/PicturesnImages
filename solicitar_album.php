
<?php
include('comprobar_sesion.php');
include('navbar2.php');
include('db.php');
    $html="<h2>Solicitud de impresión de álbum</h2>
    <p class='centrar'>En Pictures & Images ofrecemos la posibilidad de enviarte impresos tus álbumes favoritos. Te ofrecemos distintas opciones Lorem ipsum dolor sit amet.</p>
    <div class='solicitud'>
        <section class='solicitud-col-1'>
            <h2>Tarifas</h2>
            <table>
                <tr>
                    <th>Concepto</th>
                    <th>Tarifa</th>
                </tr>
                <tr>
                    <td>&lt; 5 páginas</td>
                    <td>0.10 € por pág.</td>
                </tr>
                <tr>
                    <td>entre 5 y 11 páginas</td>
                    <td>0.08 € por pág.</td>
                </tr>
                <tr>
                    <td>&gt; 11 páginas</td>
                    <td>0.07 € por pág.</td>
                </tr>
                <tr>
                    <td>Blanco y negro</td>
                    <td>0 €</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>0.05 € por foto</td>
                </tr>
                <tr>
                    <td>Resolución > 300 dpi</td>
                    <td>0.02 € por foto</td>
                </tr>
            </table>
        </section> 
 
        <section class='solicitud-col'>
            <h2>Formulario de solicitud</h2>
            <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu álbum</p>
            <p>El símbolo (*) indica que el campo es obligatorio</p>
        
            <form action='respuesta_album.php' method='POST' class='formulari-solicitud'>
                <label>Nombre (*)&nbsp;&nbsp;</label><input type='text' name='nombre' required='' placeholder='su nombre y apellidos' maxlength='200'><br><br>
                <label>Título del álbum (*)&nbsp;&nbsp;</label><input type='text' name='titulo' required='' placeholder='para la portada' maxlength='200'><br><br>
                <label>Descripción del álbum&nbsp;&nbsp;</label><textarea name='descripcion' maxlength='400' placeholder='una dedicatoria, una descripción del contenido...'></textarea><br><br>
                <label>Correo electrónico (*)&nbsp;&nbsp;<input type='email' name='email' maxlength='200' required=''></label><br><br>
                <label>Dirección (*)&nbsp;&nbsp;</label><input type='textarea' name='direccion' placeholder='direccion'>&nbsp;";
                
                // <input type='number' name='numero' required='' placeholder='Número' min=1>&nbsp;<input type='number' required name='piso' placeholder='Piso' min=0>&nbsp;<input type='text' name='puerta' required placeholder='Puerta'>&nbsp;
                // <select required name='provincia'>
                //     <option value='' disabled selected>Provincia</option>
                //     <option value='Alicante'>Alicante</option>
                //     <option value='Murcia'>Murcia</option>
                // </select>
                $html.="<input type='number' name='cp' required placeholder='CP' min='1'>&nbsp;
                <input type='text' name='localidad' required placeholder='Localidad'>&nbsp;
                <input type='text' name='provincia' required placeholder='Provincia'>&nbsp;
                <div class='select' >
                    <select required name='pais'>".getPaises2($link)."
                    </select>
                    <div class='select__arrow2'></div>
                </div>
                <label>Teléfono&nbsp;&nbsp;</label><input type='tel' name='telefono' pattern = '[0-9]{9}'><br><br>
                <label>Color de la portada&nbsp;&nbsp;</label><input type='color' name='color' value='#000000' class='input-color'><br><br>
                <label>Número de copias&nbsp;&nbsp;<input type='number' name='copias' min='1' value='1' class='input-2'></label><br><br>
                
                
                <label> Resolucion de las fotos(de 150 a 900 dpi)</label>&nbsp;
                <input type='range' name='res' list='tickmarks' value='150' min='150' max='900' step='150' onchange='document.getElementById('textOutput').value=value'>&nbsp;<output id='textOutput' for='resolucion'>150</output><br><br>
                <datalist id='tickmarks'>
                    <option value='150'>
                    <option value='300'>
                    <option value='450'>
                    <option value='600'>
                    <option value='750'>
                    <option value='900'>
                </datalist>

                <label>Álbum de fotos a imprimir (*)&nbsp;
                    <div class='select'>
                        <select required name='album'>".getAlbumes2($link, $_SESSION['user_login'])."
                        </select>
                        <div class='select__arrow2'></div>
                    </div>
                </label><br><br>
                
                <label>Fecha de recepción&nbsp;<input type='text' name='frec' class='input-2'></label><br><br>
                <label>Impresión de las fotos a color?&nbsp;<input type='checkbox' name='icolor'></label><br><br>
                
                
                <button type='reset'>Borrar datos</button>
                <button type='submit'>Enviar datos</button>
            </form>
        </section>
        
    </div>
    <section class='section-enlace'>
        <a href='matrix.php' class='enlace'>Haz click aquí para obtener información más detallada</a>
    </section>";

    echo $html;
?>
        
        

<?php include('footer.php'); ?>