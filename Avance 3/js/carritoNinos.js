


$(document).ready(function(){
        $.get('carritoNinos.php',{
            'drop': "carritoNinosSinEquipo"
        }).done(function(datos){
            
            var aux = document.getElementById("ninoSinEquipo");
            console.log("hola");
            var data = JSON.parse(datos);
            console.log(data);
            var str= "";
            
            for (var i=0; i<data.length;i++){
                 str += "<div class='col-sm-2''><div class='card'><div class='card-body'><h5 class='card-title'>"+data[i].nombre + " " + data[i].apellidoPaterno +"</h5><p class='card-text'>"+data[i].apodo+"</p><a href='#' class='btn btn-primary'>Agregar</a></div></div></div>";
            }
            console.log(str);
            aux.innerHTML=str;
           
            
        });
    });
        
