

$(document).ready(function(){
        $.get('dispHistorias.php',{
            'tierra':"amarilla",
            'drop': "historia"
        }).done(function(datos){
            var aux = document.getElementById("disphist");
            console.log("hola");
            var data = JSON.parse(datos);
            console.log(data);
            var str= "";
            
            for (var i=0; i<data.length;i++){
                 str += "<h4 class='texto'>"+data[i].titulo+"</h4><p>"+ data[i].descripcion+"</p></br>";
            }
            aux.innerHTML=str;
            $('select').formSelect();
            
        });
    });
        

  

$(document).ready(function(){
        $.get('dispHistorias.php',{
            'tierra':"amarilla",
            'drop': "personaje"
        }).done(function(datos){
            var aux = document.getElementById("dispPersonajes");
            console.log("hola");
            var data = JSON.parse(datos);
            console.log(data);
            str= "";
            for (var i=0; i<data.length;i++){
                 str += " <div class='col s6 m6 l6'><div class='card w3-round-large'><div class='card-image waves-effect waves-block waves-light yotogray w3-round-large'><img class='activator' src='"+data[i].urlPersonaje+"'></div><div class='card-content '><span class='card-title activator grey-text text-darken-4'><i class='material-icons right'>more_vert</i><p class='texto'>"+data[i].nombre+"</p></span></div><div class='card-reveal'><span class='card-title grey-text text-darken-4'>Biografía<i class='material-icons right'>close</i></span><p>"+data[i].descripcion+"</p><atributo>Fuerza</atributo><div class='w3-light-grey w3-round-large'><div id='yalliz' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].fisico+"%'>"+data[i].fisico+"%</div></div><atributo>Mente</atributo><div class='w3-light-grey w3-round-large'><div id='cuatetex' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].cognitivo+"%'>"+data[i].cognitivo+"%</div></div><atributo>Simpatía</atributo><div class='w3-light-grey w3-round-large'><div id='xayacatl' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].emociones+"%'>"+data[i].emociones+"%</div></div><atributo>Magia</atributo><div class='w3-light-grey w3-round-large'><div id='nacoxtli' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].arte+"%'>"+data[i].arte+"%</div></div><atributo>Cultivos</atributo><div class='w3-light-grey w3-round-large'><div id='lyotl' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].ecologico+"%'>"+data[i].ecologico+"%</div></div><atributo>Tecnología</atributo><div class='w3-light-grey w3-round-large'><div id='yeztli' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].productivo+"%'>"+data[i].productivo+"%</div></div><atributo>Carisma</atributo><div class='w3-light-grey w3-round-large'><div id='xihtli' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].personal+"%'>"+data[i].personal+"%</div></div></div> </div>  </div>";
            }
            aux.innerHTML=str;
            $('select').formSelect();
            
        });
    });
        

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });