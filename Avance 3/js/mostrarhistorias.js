
$(document).ready(function(){
        $.get('mostrarMisionesNinos.php',{
            'idComp':2, 
            'drop': "misiones"
        }).done(function(datos){
            var aux = document.getElementById("dispMisiones");
            var data = JSON.parse(datos);
            console.log(data);
            var str= "";
           
            for (var i=0; i<data.length;i++){
                 str += "<h2 class ='texto'>Misión "+i+"</h2> <h3 class='texto'>"+data[i].nombre+"</h3><p>"+data[i].descripcion+"</p><input id='last_name' type='text' class='validate' placeholder='Escribe aquí tu texto de entrega'><br/><br/><a id='boton_attach' class='btn-floating btn-large waves-effect waves-red cyan lighten-2'><i class='material-icons'>attach_file</i></a><label for='boton_attach texto'>Subir archivo</label><br/><br/>  <div class ='right-align'><button class='btn waves-effect waves-light' type='submit' name='action'>Submit <i class='material-icons right'>send</i></button></div>";
            }
            aux.innerHTML=str; 
            $('select').formSelect();
            
        });
    });
        