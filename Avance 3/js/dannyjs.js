 $(document).ready(function DropDownGrupos(){
        $.get('ModificarCompetencia.php',{
            'idMaestro':1,
        }).done(function(datos){
            var aux = document.getElementById("selectGrupo");
            var data = JSON.parse(datos);
            var str="<option value='' disabled selected>Selecciona un grupo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idGrupo+"'>"+data[i].nombre+"</option>";
            }
            console.log(aux);
            aux.innerHTML=str;
            $('select').formSelect();
        });
    });
        
  $(document).ready(function(){
    $('.sidenav').sidenav();
  });

 

 $(document).ready(function DropDownEquipos(){
        $.get('ModificarCompetencia.php',{
            'idGrupo':1,
        }).done(function(data){
            var aux = document.getElementById("selectEquipo");
            var data = JSON.parse(data);
            var str="<option value='' disabled selected>Selecciona Equipo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idEquipo+"'>"+data[i].nombre+"</option>";
            }
            console.log(aux);
            aux.innerHTML=str;
            $('select').formSelect();
        });
    });
        
  $(document).ready(function DropDownAtributo(){
    $('.sidenav').sidenav();
  });  

 $(document).ready(function DropDownEquipos(){
        $.get('ModificarCompetencia.php',{
            'idGrupo':1,
        }).done(function(data){
            
            if (aux=1){
               var aux = document.getElementById("selectAtributo");
            var data = JSON.parse(data);
            var str="<option value='' disabled selected>Selecciona atributo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idEquipo+"'>"+data[i].nombre+"</option>";
            }
            console.log(aux);
            aux.innerHTML=str;
            $('select').formSelect();  
                
                
            } else {
                 var aux = document.getElementById("selectAtributo");
            var data = JSON.parse(data);
            var str="<option value='' disabled selected>Selecciona atributo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idEquipo+"'>"+data[i].nombre+"</option>";
            }
            console.log(aux);
            aux.innerHTML=str;
            $('select').formSelect();
                
                   
            }

            
        });
    });
        
  $(document).ready(function(){
    $('.sidenav').sidenav();
  });  