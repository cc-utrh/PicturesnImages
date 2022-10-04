function validarLogin(f){
    
    var valido=true;

    //cojo valores de los inputs
    var usuario = f.elements[0].value;
    var clave = f.elements[1].value;
    
    var msgOk;// mensaje modal para login correcto
    
    
    msgOk='<article>';
    msgOk+='<h2>Inicio de sesión correcto</h2>';
    msgOk+='<p>Haz click en el botón para acceder a la página principal</p>';
    msgOk+='<footer class="foot-msg"><button onclick="cerrarMensajeModal();">Aceptar</button>';
    msgOk+='</article>';

    var msgNo;// mensaje modal para login correcto al que le uniremos los errores cometidos

    msgNo='<article>';
	msgNo+='<h2>Inicio de sesión incorrecto</h2>';

	//password vacia
    if(clave==""){
        valido=false;
        msgNo+='<p>Debes rellenar la contraseña</p>';
        console.log('pon psw');
    }
    //user vacio
    if(usuario==""){
        valido=false;
        msgNo+='<p>Debes rellenar el usuario</p>';
        console.log('pon user');
    }
    //pswd o user solo con espacios
    if(!usuario.trim()||!clave.trim()){
        valido=false;
        msgNo+='<p>No puedes utilizar solo espacios en ninguno de los campos</p>';
        console.log('no vale solo espacios');
    }

    //compruebo si se han cometido errores y muestro un mensaje u otro
    if(valido){
        console.log(msgOk);
        mensajeModal(msgOk);
    }else{
        msgNo+='<p>Haz click en el botón para cerrar el mensaje</p>';
        msgNo+='<footer class="foot-msg"><button onclick="cerrarMensajeModal2();">Aceptar</button>';
	    msgNo+='</article>';
        console.log(msgNo);
        mensajeModal(msgNo);
    }
    return false;

}

function mensajeModal(html){
    console.log(html);
	let div = document.createElement('div');
	div.setAttribute('id', 'capa-fondo');
	div.innerHTML = html;
	document.body.appendChild(div);
}


function cerrarMensajeModal(){
	let url= window.location.replace('index2.php');
	document.getElementById('#capa-fondo').remove();
	window.location.assign(url);
}

function cerrarMensajeModal2(){
	document.querySelector('#capa-fondo').remove();
}


function validarRegistro(f){
    

    

    //cojo cada input del formulario de registro
    var user=f.elements[0];
    var psw1=f.elements[1];
    var psw2=f.elements[2];
    var email = f.elements[3];
	var sexo = f.elements[4].value;
	var fecha = f.elements[5];

    onBlurUser(user);
    onBlurPass(psw1);
    onBlurPass2(psw2);
    onBlurEmail(email);
    if(sexo=="" && !(document.querySelector('#p-sexo'))){
        error="Tienes que seleccionar un sexo. ";
        var p_sexo = document.createElement('p');
        p_sexo.setAttribute('id', 'p-sexo');
        p_sexo.textContent = error;
        document.querySelector('#sexo-label').appendChild(p_sexo);
    }
    else if(sexo=="" && document.querySelector('#p-sexo')){
        error="Tienes que seleccionar un sexo. ";
        document.querySelector('#p-sexo').remove();
        var p_sexo = document.createElement('p');
        p_sexo.setAttribute('id', 'p-sexo');
        p_sexo.textContent = error;
        document.querySelector('#sexo-label').appendChild(p_sexo); 
    }else{
        if(document.querySelector('#p-sexo')){
            document.querySelector('#p-sexo').remove();
        }
    }
    
    onBlurDate(fecha);

    return false
}

function onBlurEmail(inp){
    mail = inp.value;
    console.log(mail);
    error = compruebaEmail(mail);
    if(error!="" && !(document.querySelector('#p-mail'))){    
        var p_mail = document.createElement('p');
        p_mail.setAttribute('id', 'p-mail');
        p_mail.textContent = error;
        document.querySelector('#mail-label').appendChild(p_mail);
    }
    else if(error!="" && document.querySelector('#p-mail')){
        document.querySelector('#p-mail').remove();
        var p_mail = document.createElement('p');
        p_mail.setAttribute('id', 'p-mail');
        p_mail.textContent = error;
        document.querySelector('#mail-label').appendChild(p_mail); 
    }else{
        if(document.querySelector('#p-mail')){
            document.querySelector('#p-mail').remove();
        }
    }
}




function compruebaEmail(email){
    var error="";
    var emailTrozos=email.split('@');

    if(!(email.trim())){
        error = "Debe rellenar el campo. ";
        return error;
    }

    if(email.length>254){
        error+="La longitud es demasiado grande. ";
    }else{

        if(emailTrozos.length==1){
            error+="El email debe llevar @. "
        }else if(emailTrozos.length==2){
            var local=emailTrozos[0];
            var dominio=emailTrozos[1];
    
            if(local==""||dominio==""){
                error+="El email debe tener una estructura ___@___.___ "
            }else{
                if(local.length>64){
                    error+="Email demasiado largo. ";
                }else{
                    sublocales=local.split('.');
                    if(sublocales.length>1){
                        if(sublocales.includes("")){
                            error+="El email no puede contener dos puntos seguidos, ni empezar ni terminar por punto. ";
                        }
                    error+=validarLocal(local);
                    }
                }
                if (dominio.length>255){
                    error+="El dominio es demasiado largo";
                }else{
                    subdominios=dominio.split('.');
                    if(subdominios.length>1){
                        if(subdominios.includes("")){
                            error+="El subdominio no puede contener dos puntos seguidos, ni empezar ni terminar por punto. ";
                        }

                        for(var i=0; i<subdominios.length;i++){
                            if(subdominios[i].split("-").length>0){
                                var aux=subdominios[i].split("-");
                                if(aux[0]==""||aux[aux.length-1]==""){
                                    error+="No se admite guion al principio o al final. "
                                }
                            }
                            if(subdominios[i].length>63){
                                error+="Subdominio/s demasiado largo/s. ";
                            }else{
                                
                                error+=validarSubdominio(subdominios[i]);
                            }
                        }
                    }else{
                        error+="Mínimo 1 punto";
                    }
                }
            }
        }else{
            error+="Solo puede contener un @ ";
        }
  
    }
    return error;
}

function emailAux(cad, eslocal){
    var error="";
    var comprobar="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    if(eslocal){
        comprobar+="!#$%&'*+-/=?^_`{|}~.";
        for(var i=0; i<cad.length&&error==""; i++){

            if(!comprobar.includes(cad.charAt(i))){
                error+="Solo se admiten letras, números, '.' y !#$%&'*+-/=?^_`{|}~ . ";
            }
        }

    }else{
        
        comprobar+="-";
        
        for(var i=0; i<cad.length&&error==""; i++){
            
            if(!comprobar.includes(cad.charAt(i))){
                error+="Solo se permiten letras del alfabeto inglés, números y guion. ";
            }
        }
    
    }
    return error;
}

function validarLocal(local){
    var error="";

    error=emailAux(local, true);

    return error;
}

function validarSubdominio(subdominio){
    var error="";

    error=emailAux(subdominio, false);

    return error;
}

function onBlurDate(inp){
    fecha = inp.value;
    console.log(fecha);
    error = compruebaFecha(fecha);
    if(error!="" && !(document.querySelector('#p-fecha'))){    
        var p_fecha = document.createElement('p');
        p_fecha.setAttribute('id', 'p-fecha');
        p_fecha.textContent = error;
        document.querySelector('#fecha-label').appendChild(p_fecha);
    }
    else if(error!="" && document.querySelector('#p-fecha')){
        document.querySelector('#p-fecha').remove();
        var p_fecha = document.createElement('p');
        p_fecha.setAttribute('id', 'p-fecha');
        p_fecha.textContent = error;
        document.querySelector('#fecha-label').appendChild(p_fecha); 
    }else{
        if(document.querySelector('#p-fecha')){
            document.querySelector('#p-fecha').remove();
        }
    }
}

function compruebaFecha(fecha){
    var error="";
    var fechaTrozos=fecha.split("/");
    var dia=fechaTrozos[0];
    var mes=fechaTrozos[1];
    var anyo=fechaTrozos[2];

    if(!(fecha.trim())){
        error = "Debe rellenar el campo. ";
        return error;
    }
    var date = new Date(anyo, (+mes-1), dia);
    if(!((Boolean(+date) && date.getDate() == dia))){
        error+="Fecha invalida";
        console.log(date);
    }

    return error;    
}

function onBlurUser(inp){
    user = inp.value;
    console.log(user);
    error = validarUsuario(user);
    if(error!="" && !(document.querySelector('#p-user'))){    
        var p_user = document.createElement('p');
        p_user.setAttribute('id', 'p-user');
        p_user.textContent = error;
        document.querySelector('#user-label').appendChild(p_user);
    }
    else if(error!="" && document.querySelector('#p-user')){
        document.querySelector('#p-user').remove();
        var p_user = document.createElement('p');
        p_user.setAttribute('id', 'p-user');
        p_user.textContent = error;
        document.querySelector('#user-label').appendChild(p_user); 
    }else{
        if(document.querySelector('#p-user')){
            document.querySelector('#p-user').remove();
        }
    }
}


function validarUsuario(user){
    var alfabeto="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    var error="";
    var numeros="0123456789";

    if(!(user.trim())){
        error = "Debe rellenar el campo. ";
        return error;
    }

    //compruebo longitud
    if(user.length<3 || user.length>15){
        valido=false;
        error+="La longitud debe estar entre 3 y 15 caracteres. ";
        // console.log('user: longitud incorrecta');
    }
    //compruebo primer char
    if(numeros.includes(user.charAt(0))){
        valido=false;
        error+="No puede comenzar por una cifra. ";
        // console.log('user: numeros primero no');
    }

    //compruebo que solo haya letras y n um
    for(var i=1; i<user.length; i++){
        if(!alfabeto.includes(user.charAt(i))&&!numeros.includes(user.charAt(i))){
            valido=false;
            error+= "Solo caracteres del alfabeto inglés o números.";
            break;
        }
    }
    return error;
}


function onBlurPass(inp){
    pass = inp.value;
    console.log(pass);
    error = validaContrasenya(pass);
    if(error!="" && !(document.querySelector('#p-pass'))){    
        var p_pass = document.createElement('p');
        p_pass.setAttribute('id', 'p-pass');
        p_pass.textContent = error;
        document.querySelector('#pass-label').appendChild(p_pass);
    }
    else if(error!="" && document.querySelector('#p-pass')){
        document.querySelector('#p-pass').remove();
        var p_pass = document.createElement('p');
        p_pass.setAttribute('id', 'p-pass');
        p_pass.textContent = error;
        document.querySelector('#pass-label').appendChild(p_pass); 
    }else{
        if(document.querySelector('#p-pass')){
            document.querySelector('#p-pass').remove();
        }
    }
}

function onBlurPass2(inp){
    pass1 = document.querySelector('#pass-label').firstElementChild.value;
    pass2 = inp.value;
    console.log(pass2);
    error="No coinciden las contraseñas. "
    if(pass1!=pass2 && !(document.querySelector('#p-pass2'))){    
        var p_pass2 = document.createElement('p');
        p_pass2.setAttribute('id', 'p-pass2');
        p_pass2.textContent = error;
        document.querySelector('#pass2-label').appendChild(p_pass2);
    }
    else if(pass1!=pass2 && document.querySelector('#p-pass2')){
        document.querySelector('#p-pass2').remove();
        var p_pass2 = document.createElement('p');
        p_pass2.setAttribute('id', 'p-pass2');
        p_pass2.textContent = error;
        document.querySelector('#pass2-label').appendChild(p_pass2); 
    }else{
        if(document.querySelector('#p-pass2')){
            document.querySelector('#p-pass2').remove();
        }
    }
}

function validaContrasenya(psw){
    var error="";

    var numeros="0123456789";
    var contNum=0;

    var minusculas="abcdefghijklmnopqrstuvwxyz";
    var contMin=0;

    var mayusculas="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var contMay=0;

    var extras="-_";
    var contExtra=0;

    var longitudOk;

    if(!(psw.trim())){
        error = "Debe rellenar el campo. ";
        return error;
    }

    //recorro la contrasenya contando el numero de mayusculas, minusculas y numeros
    for(var i=0;i<psw.length; i++){
        if(numeros.includes(psw.charAt(i))){
            contNum++;
        }

        if(mayusculas.includes(psw.charAt(i))){
            contMay++;
        }

        if(minusculas.includes(psw.charAt(i))){
            contMin++;
        }

        if(extras.includes(psw.charAt(i))){
            contExtra++;
        }
    }

    //si los caracteres que he contado (may + min + num + extras) coinciden con el total de caracteres
    //es que solo hay de los tipos permitidos

    longitudOk=contNum+contMay+contMin+contExtra;

    if(longitudOk<6 || longitudOk>15){
        error+="La longitud debe estar entre 6 y 15 caracteres. "
    }

    if(longitudOk<psw.length){
        // console.log('solo puede contener numeros letras - y _')
        error+="Solo puede contener números, letras, '-' y '_'. ";
    }

    //minimos exigidos de cada tipo
    if(contMay==0||contMin==0||contNum==0){
        // console.log('debe contener mínimo un número, una minúscula y una mayúscula');
        error+="Debe contener mínimo una cifra, una mayúscula y una minúscula. ";
    }
    return error;
}





