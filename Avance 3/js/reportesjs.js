
var arr=[];
    var arr2=[];

$(document).ready(function(){
        $.get('crearReporte.php',{
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
    
    $.get('crearReporte.php',{
        'idGrupo': idGrupo,
        'drop':"equipo",  
    }).done(function(datos){
            var aux = document.getElementById("dropEquipo");
           aux.className = "input-field col s4 show";
            console.log(datos);
            aux = document.getElementById("selectEquipo");
            var data = JSON.parse(datos);
            console.log(datos);
            var str="<option value=''  disabled selected>Selecciona un Equipo</option>";
            for (var i=0; i<data.length;i++){
                 str += "<option value='"+data[i].idEquipo+"'>"+data[i].nombre+"</option>";
            }
            
            generaGraficoGrupo(idGrupo);
            console.log(str);
            aux.innerHTML=str;
            $('select').formSelect();
        });    
}

    

function generaGraficoGrupo(idGrupo){
    
    $.get('crearReporte.php',{
        'idGrupo':idGrupo,
        'drop':"graphgrupo",  
    }).done(function(datos){
            console.log(datos);
       
        var datas = JSON.parse(datos);
        
       for (var i=0; i<datas.length;i++){
            arr[i]=datas[i].nombre;
            arr2[i]=datas[i].promedio;
            
        }
        console.log(arr);
        console.log(arr2);
        
        creargraph();
        arr=[];
        arr2=[];
        });  

}

function generaGraficoEquipo(idEquipo){
    
    $.get('crearReporte.php',{
        'idEquipo':idEquipo,
        'drop':"graphequipo",  
    }).done(function(datos){
            console.log(datos);
       
        var datas = JSON.parse(datos);
        
       for (var i=0; i<datas.length;i++){
            arr[i]=datas[i].nombre;
            arr2[i]=datas[i].promedio;
            
        }
        console.log(arr);
        console.log(arr2);
        
        creargraph();
        arr=[];
        arr2=[];
        });  

}
function generaGraficoNino(idNino){
    
    $.get('crearReporte.php',{
        'idNino':idNino,
        'drop':"graphnino",  
    }).done(function(datos){
            console.log(datos);
       
        var datas = JSON.parse(datos);
        
       for (var i=0; i<datas.length;i++){
            arr[i]=datas[i].nombre;
            arr2[i]=datas[i].valor;
            
        }
        console.log(arr);
        console.log(arr2);
        
        creargraph();
        arr=[];
        arr2=[];
        });  

}
function creargraph(){
    var ctx = document.getElementById("myChart");
    //console.log(window.myChart);
   if  (window.myChart){
       window.myChart.clear;
       window.myChart.destroy;
       console.log("reinicio de grafico");
   }   
window.myChart = new Chart(ctx, {
    
    type: 'bar',
    data: {
        labels: arr,
        datasets: [{
            label: 'Calificación promedio',
            data: arr2,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
               'rgba(255, 206, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
}








function dropdownNino(idEquipo){
    console.log(idEquipo);
    $.get('crearReporte.php',{
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
            generaGraficoEquipo(idEquipo);
    
            $('select').formSelect();
        });  
}


/*

   
function generaGrafico(idGrupo){
    console.log(idEquipo);
    $.get('crearReporte.php',{
        'idGrupo':idGrupo,
        'drop':"graphgrupo",  
    }).done(function(datos){
            console.log(datos);
        var arr=[];
        var arr2=[];
        
        for (var i=0; i<data.length;i++){
            arr[i]=data[i].nombre;
            arr2[i]=data[i].promedio;
            
        }

          var ctx = document.getElementById("graficoAqui");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: arr,
                    datasets: [{
                        label: '# of Votes',
                        data: arr2,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });




        
        });  
}
         
*/

