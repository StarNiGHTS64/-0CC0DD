function displayatri(){
    
    $.get('atrininos.php',{
        'idNino': 3,
        'drop':"ninoatributos"  
    }).done(function(datos){
            var aux = document.getElementById("displayNinos");
            var data = JSON.parse(datos);
            console.log(datos);
            var str= "";
            var arr=["yalliz", "cuatetex", "xayacatl", "nacoxtli", "lyotl", "yeztli", "xihtli"];
        
            str += "<li><div class='user-view'><a href='#name'><span class='black-text name'><h4 class='texto'>"+data[1].apodo+"</h4></span></a></div></li><li><img class='iconoAvatar' src='../img/MargaritoPng.png' alt='Avatar'></li><div class='texto atributos'>";
        
          for(var i=0; i<data.length; i++){
                 str += "<atributo>"+data[i].nombre+"</atributo><div class='w3-light-grey w3-round-large w3-tiny'> <div id='"+arr[i]+"' class='w3-container w3-center w3-tiny w3-round-large' style='width:"+data[i].valor+"%'>"+data[i].valor+"%</div></div>";
          }     
            str += "</div>"

            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });    
}

  $(document).ready(function(){
    $('.sidenav').sidenav();
  });