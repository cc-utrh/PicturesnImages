<?php   
    function tablaPrecio(){
        $incremento = 3;
    $precio_byn_pq = 0.1;
    $precio_byn_gr = 0.16;
    $precio_col_pq = 0.25;
    $precio_col_gr = 0.31;
    $fila = 17;
    $columna = 6;
    $html="<table border='2'>";
    
    // Crea las celdas
    for($i=0;$i<$fila;$i++){
  
        if($i == 0 ){
            echo "<tr>";    
            for ($j = 0; $j<4; $j++) {   	
                if($i == 0 && $j == 2){
                    $html.="<td colspan='2'>Blanco y negro</td>";
                }
                else if($i == 0 && $j == 3){
                    $html.="<td colspan='2'>Color</td>";
                }
                else{
                    $html.="<td></td>";
                }
            }
            $html.="</tr>";
           
        }else{
            $html.="<tr>";
            for ($j = 0; $j <$columna; $j++) {   

            //Crear subtítulos de tablas
                if($i == 1 && $j == 0){
                    $html.="<td>Número de páginas</td>";
                }
                if($i == 1 && $j == 1){
                    $html.="<td>Número de fotos</td>";
                }
                if(($i == 1 && $j == 2) || ($i == 1 && $j == 4)){
                    $html.="<td>150-300 dpi</td>";
                }    
                if(($i == 1 && $j == 3) || ($i == 1 && $j == 5)){
                    $html.="<td>450-900 dpi</td>";
                }
    

                //Rellenamos páginas y fotos
                
                if($i >= 2 && $j == 0){
                    $html.="<td>". ($i-1) ."</td>";
                }

                if($i >= 2 && $j == 1){
                    $html.="<td>". (($i-1)*$incremento) ."</td>";
                }

                //Columna byn pequeño
                if($i >= 2 && $j == 2){
                    $html.="<td>". ($precio_byn_pq) ."</td>";
                    $precio_byn_pq += 0.1;
                    if($i >= 5){
                        $precio_byn_pq -= 0.02;
                    }
                    if($i >= 12){
                        $precio_byn_pq -= 0.01;
                    }
                }
                
                //Columna byn grande
                if($i >= 2 && $j == 3){
                    $html.="<td>". ($precio_byn_gr) ."</td>";
                    $precio_byn_gr += 0.16;
                    if($i >= 5){
                        $precio_byn_gr -= 0.02;
                    }
                    if($i >= 12){
                        $precio_byn_gr -= 0.01;
                    }
                }

                //Columna color pequeña
                if($i >= 2 && $j == 4){
                    $html.="<td>". ($precio_col_pq) ."</td>";
                    $precio_col_pq += 0.25;
                    if($i >= 5){
                        $precio_col_pq -= 0.02;
                    }
                    if($i >= 12){
                        $precio_col_pq -= 0.01;
                    }
                }

                //Columna color grande
                if($i >= 2 && $j == 5){
                    $html.="<td>". ($precio_col_gr) ."</td>";
                    $precio_col_gr += 0.31;
                    if($i >= 5){
                        $precio_col_gr -= 0.02;
                    }
                    if($i >= 12){
                        $precio_col_gr -= 0.01;
                    }
                }                
            }
            $html.="</tr>";
        }
    }
    $html.="</table>";

    return $html;
    }
    
?>