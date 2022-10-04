<?php
    function getPaises($link){
        $result = mysqli_query($link, "SELECT NomPais from paises");
        while($data = mysqli_fetch_array($result)){
            echo "<option value='". $data['NomPais'] ."'>" .$data['NomPais'] ."</option>";  // displaying data in option menu
        }
    }
