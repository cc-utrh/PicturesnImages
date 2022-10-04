<?php include('comprobar_nav.php'); ?>
<?php include('db.php'); ?>
<?php
    $html="<section class='form-container'>
    <h2>Criterios de búsqueda</h2>
    <form method='POST' action='resultado.php' class='formulari'>    <!-- el formulario que irá siempre en la página de búsqueda-->
        <label>Título<input type='text' name='titulo' id='titulo'><br></label>
        <label>Fecha entre:&nbsp;<input type='date' name='fecha1' class='input-2'></label>&nbsp;y&nbsp;<label><input type='date' name='fecha2' class='input-2'><br></label>
        <div class='select'>
            <label>Pais:&nbsp;&nbsp;</label>
            <select id='country' name='country'>" . getPaises2($link) ."</select>
       <div class='select__arrow'></div>
       <button>Buscar</button>
    </form>
    </section>";

    echo $html;
    ?>
<?php cerrarConn($link);  // close connection ?>
<?php include('footer.php'); ?>