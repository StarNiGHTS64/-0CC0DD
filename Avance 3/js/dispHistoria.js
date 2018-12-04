

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
    $('.sidenav').sidenav();
  });