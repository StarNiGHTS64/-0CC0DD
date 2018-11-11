var bandera = 0; 

$(document).ready(function(){
        $.get('ModificarCompetencia.php',{
            'idMaestro':1,
            'drop': "grupo"
        }).done(function(datos){
            var aux = document.getElementById("selectGrupo");
            var data = JSON.parse(datos);
            var str="<option value=''  disabled selected>Selecciona un grupo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idGrupo+"'>"+data[i].nombre+"</option>";
            }
            aux.innerHTML=str;
            $('select').formSelect();
        });
    });
        
  $(document).ready(function(){
    $('.sidenav').sidenav();
  });


function dropdownEquipo(idGrupo){
    
    $.get('ModificarCompetencia.php',{
        'idGrupo': idGrupo,
        'drop':"equipo",  
    }).done(function(datos){
            var aux = document.getElementById("dropEquipo");
            aux.className = "input-field col s4 show";
            console.log(datos);
            aux = document.getElementById("selectEquipo");
            var data = JSON.parse(datos);
            var str="<option value=''  disabled selected>Selecciona un Equipo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idEquipo+"'>"+data[i].nombre+"</option>";
            }
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });    
}

function filtroOnChange(idEquipo){
    document.getElementById("dropFiltro").setAttribute('onchange','dropFiltro(this.value,'+idEquipo+')');
    var aux = document.getElementById("filtro");
    aux.className = "input-field col s4 show";
}

function dropFiltro(idFiltro, idEquipo){
    if (idFiltro==1){
        dropdownNino(idEquipo);
         
    } else {
        
        dropdownAtributo();  
        
    }
    
    
}



function dropdownAtributo(){
    
   $.get('ModificarCompetencia.php',{
        
        'drop':"competencia",  
    }).done(function(datos){
            var aux = document.getElementById("selectAtributo");
            aux.className = "input-field col s4 show";
            console.log(datos);
            aux = document.getElementById("select3");
            var data = JSON.parse(datos);
            bandera=1;
            var str="<option value=''  disabled selected>Selecciona una competencia </option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idCompetencia+"'>"+data[i].nombre+"</option>";
            }
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });   
}

function dropdownNino(idEquipo){
    console.log(idEquipo);
    $.get('ModificarCompetencia.php',{
        'idEquipo':idEquipo,
        'drop':"nino",  
    }).done(function(datos){
            var aux = document.getElementById("selectAtributo");
            aux.className = "input-field col s4 show";
            console.log(datos);
            aux = document.getElementById("select3");
            var data = JSON.parse(datos);
            var str="<option value=''  disabled selected>Selecciona un Niño</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idNino+"'>"+data[i].nombre+"</option>";
                
            }
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });  
}









function tablaDeCompetencia(idCompetencia, idEquipo){
   console.log(idCompetencia);
    $.get('ModificarCompetencia.php',{
        'idNino':idNino,
        'drop':"tablaComp",  
    }).done(function(datos){
            var aux = document.getElementById("tablaespacio");
             console.log("hola");
            console.log(datos);
            var data = JSON.parse(datos);
           var str="";
        console.log("hola");
            for (var i=0; i<data.length;i++){
                console.log("hola");
                 str += "<div class='input-field col s6'><p>" + data[i].nombre + "</p></div><div class='input-field col s6'><form action='#'><p class='range-field'><input type='range' min='0' max='100' value='" + data[i].valor + "'/></p></form></div>";             
                
            }
           
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });    
    
}




function tablaDeNino(idNino){
    console.log(idNino);
    $.get('ModificarCompetencia.php',{
        'idNino':idNino,
        'drop':"tablaNino",  
    }).done(function(datos){
            var aux = document.getElementById("tablaespacio");
             console.log("hola");
            console.log(datos);
            var data = JSON.parse(datos);
           var str="";
        console.log("hola");
            for (var i=0; i<data.length;i++){
                console.log("hola");
                 str += "<div class='input-field col s6'><p>" + data[i].nombre + "</p></div><div class='input-field col s6'><form action='#'><p class='range-field'><input type='range' min='0' max='100' value='" + data[i].valor + "'/></p></form></div>";             
                
            }
           
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });  
}


  

