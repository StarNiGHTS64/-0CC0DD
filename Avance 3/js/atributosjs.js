var bandera = 0;
var equipo = 0;
var comp= 0 ;
var arr=[];
var arr2=[];
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
            equipo=idGrupo;
            console.log(equipo);
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
        'idEquipo':equipo, 
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




function generarTabla(idCompetencia){
       $.get('ModificarCompetencia.php',{
      'idEquipo':equipo,
        'idCompetencia':idCompetencia,
        'drop':"tablaComp",  
    }).done(function(datos){
            var aux = document.getElementById("tablaespacio");
            console.log(datos);
           comp= idCompetencia;
            var data = JSON.parse(datos);
           var str="";
            for (var i=0; i<data.length;i++){
                 str += "<div class='row'><div class='input-field col s6'><p>" + data[i].nombre + "</p></div><div class='input-field col s6'><form action='#'><p class='range-field'><input type='range' id='"+ i +"' min='0' max='100' value='" + data[i].valor + "'/></p></form></div> </div> "; 
                
                arr[i]=data[i].idNino;
                arr2[i]=data[i].valor;
            }
           str += "<div class='input-field col s6'><button class ='btn' onclick='edit()' id='"+ i + "' > Guardar </button></div>";
           console.log(arr);
           console.log(arr2);
           
          
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
           var aux= arr.length;
           if(aux==0){
               alert("No hay niños con ese filtro");
           }
           
           
        });  
  
}




    function consult(nombreNino, auxValor){
     $.get('ModificarCompetencia.php',{
         'idCompetencia': comp,
         'idNino': nombreNino,
         'valor': auxValor,
         'idEquipo':equipo,
         
        'drop':"editAtri",  
    }).done(function(datos){
         
          console.log(datos);
         
        });  
    
    
}
     
function edit(){
     var nombreNino ="";
         var auxValor=0;
         var aux=arr2.length;
    
        /*for (var i=0; i<aux; i++){
          
            arr2[i]=document.getElementById(i).value;
      
        console.log(arr2);
        }*/
        
         for (var i=0; i<aux; i++){
             nombreNino=arr[i];
             auxValor=arr2[i];
             
             consult(nombreNino, auxValor);
         }
    console.log(arr2);
    if(aux>0){
    alert("Nuevas Calificaciones guardadas");
        } else{
            alert("no hay cambios a guardar");
        }
   
    arr=[];
           arr2=[];
}
       
              

function tablaDeCompetencia(idCompetencia, idEquipo){
   $.get('ModificarCompetencia.php',{
      'idEquipo':idEquipo,
        'idCompetencia':idCompetencia,
        'drop':"tablaComp",  
    }).done(function(datos){
            var aux = document.getElementById("tablaespacio");
            console.log(datos);
            var data = JSON.parse(datos);
           var str="";
            for (var i=0; i<data.length;i++){
                console.log("hola");
                 str += "<div class='input-field col s6'><p>" + data[i].nombre + "</p></div><div class='input-field col s6'><form action='#'><p class='range-field'><input type='range' min='0' max='100' value='" + data[i].valor + "'/></p></form></div>";             
                
            }
           
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });  
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}



function tablaDeNino(idNino){
       console.log(idNino);
    $.get('ModificarCompetencia.php',{
        'idNino':idNino,
        'drop':"tablaNino",  
    }).done(function(datos){
            var aux = document.getElementById("tablaespacio");
             
            console.log(datos);
            var data = JSON.parse(datos);
           var str="";
        
            for (var i=0; i<data.length;i++){
                console.log("hola");
                 str += "<div class='input-field col s6'><p>" + data[i].nombre + "</p></div><div class='input-field col s6'><form action='#'><p class='range-field'><input type='range' min='0' max='100' value='"+data[i].valor + "'/></p></form></div>";             
                
            }
           
           
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        }); 
}


  
