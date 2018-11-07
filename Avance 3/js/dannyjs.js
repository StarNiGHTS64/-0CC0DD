
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
            var str="<option value=''  disabled selected>Selecciona una competencia /option>";
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


        
    $(document).ready(function(){
    $('.tooltipped').tooltip();
  });

  $(document).ready(function(){
<<<<<<< HEAD
    $('.parallax').parallax();
  });
        
    $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });
      $(document).ready(function(){
    $('.carousel').carousel();
  });

    $('.sidenav').sidenav();
  });
