function genera_tabla() {
    var body = document.querySelector("section");
    var tabla   = document.createElement("table");
    var tblBody = document.createElement("tbody");
    var incremento = 3;

    var precio_byn_pq = 0.1;
    var precio_byn_gr = 0.16;
    var precio_col_pq = 0.25;
    var precio_col_gr = 0.31; 
  
      // Crea las celdas
    for (var i = 0; i < 17; i++) {
      
        var hilera = document.createElement("tr");
  
        if( i == 0 ){    
            for (var j = 0; j < 4; j++) {   	
                var celda = document.createElement("td");

            //crear títulos de tablas

                if(i == 0 && j == 2){
                    celda.colSpan = 2;
                    var byn_txt = document.createTextNode("Blanco y Negro");
                    celda.appendChild(byn_txt);
                }
                if(i == 0 && j == 3){
                    celda.colSpan = 2;
                    var col_txt = document.createTextNode("Color");
                    celda.appendChild(col_txt);
                }
                hilera.appendChild(celda);
            }
           
        }else{
            for (var j = 0; j < 6; j++) {   
                var celda2 = document.createElement("td"); 

            //Crear subtítulos de tablas
                if(i == 1 && j == 0){
                    var num_pag = document.createTextNode("Número de páginas");
                    celda2.appendChild(num_pag);
                }

                if(i == 1 && j == 1){
                    var num_foto = document.createTextNode("Número de fotos");
                    celda2.appendChild(num_foto);
                }
                if((i == 1 && j == 2) || (i == 1 && j == 4)){
                    var dpi1 = document.createTextNode("150-300 dpi");
                    celda2.appendChild(dpi1);
                }    
                if((i == 1 && j == 3) || (i == 1 && j == 5)){
                    var dpi2 = document.createTextNode("450-900 dpi");
                    celda2.appendChild(dpi2);
                }
    

                //Rellenamos páginas y fotos
                
                if(i >= 2 && j == 0){
                    var pags = document.createTextNode(i-1);
                    celda2.appendChild(pags);
                }

                if(i >= 2 && j == 1){
                    var fotos = document.createTextNode(incremento);
                    incremento += 3;
                    celda2.appendChild(fotos);
                }

                //Columna byn pequeño
                if(i >= 2 && j == 2){
                    console.log(precio_byn_pq);
                    var ByNpq = document.createTextNode(parseFloat(precio_byn_pq).toFixed(2));
                    celda2.appendChild(ByNpq);
                    precio_byn_pq += 0.1;
                    if(i >= 5){
                        precio_byn_pq -= 0.02;
                    }
                    if(i >= 12){
                        precio_byn_pq -= 0.01;
                    }
                }
                
                //Columna byn grande
                if(i >= 2 && j == 3){
                    console.log(precio_byn_gr);
                    var ByNgr = document.createTextNode(parseFloat(precio_byn_gr).toFixed(2));
                    celda2.appendChild(ByNgr);
                    precio_byn_gr += 0.16;
                    if(i >= 5){
                        precio_byn_gr -= 0.02;
                    }
                    if(i >= 12){
                        precio_byn_gr -= 0.01;
                    }
                }

                //Columna color pequeña
                if(i >= 2 && j == 4){
                    console.log(precio_col_pq);
                    var Colpq = document.createTextNode(parseFloat(precio_col_pq).toFixed(2));
                    celda2.appendChild(Colpq);
                    precio_col_pq += 0.25;
                    if(i >= 5){
                        precio_col_pq -= 0.02;
                    }
                    if(i >= 12){
                        precio_col_pq -= 0.01;
                    }
                }

                //Columna color grande
                if(i >= 2 && j == 5){
                    console.log(precio_col_gr);
                    var Colgr = document.createTextNode(parseFloat(precio_col_gr).toFixed(2));
                    celda2.appendChild(Colgr);
                    precio_col_gr += 0.31;
                    if(i >= 5){
                        precio_col_gr -= 0.02;
                    }
                    if(i >= 12){
                        precio_col_gr -= 0.01;
                    }
                }
                hilera.appendChild(celda2);
            }
        
       
        }
    tblBody.appendChild(hilera);
    }

   
  
    // posiciona el <tbody> debajo del elemento <table>
    tabla.appendChild(tblBody);
    // appends <table> into <body>
    body.appendChild(tabla);
    // modifica el atributo "border" de la tabla y lo fija a "2";
    tabla.setAttribute("border", "2");
  }
