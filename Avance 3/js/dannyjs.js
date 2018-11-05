 $(document).ready(function(){
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