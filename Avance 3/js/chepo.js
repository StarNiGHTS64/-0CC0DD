$(document).ready(function(event){
    
    //Initialize Form
    $('.materialSelect').formSelect();
    
    //Add event listener for select
    $('.materialSelect').on('contentChanged',function(){
        $(this).formSelect();
    });
            
    //Update Select Option Event
    $.post("Queries/Q_Competencias.php",{"Response":"tarea-select-call"},function(data){
        //alert(data); //Debug Alert

        $('#select-competencia').append(data); //Append returned values from php query

        $('#select-competencia').trigger('contentChanged'); //Call on event trigger
    });
    
    $('#dispTareas').on('update',function(){
        //Empty
    });
    
    //Write table into div
    $.post("Queries/Q_Tareas.php",{"Response":"lol"},function(data){
        //alert(data);
        $("#dispTareas").html(data);
        $('#dispTareas').trigger('update');
    });
    
    //CRUD button: Action for delete
    $('body').on("click",".something2",function(){
        var $buttonVal = $(this),
            idTar = $(this).attr("name");
        $.post("Queries/Q_Tareas.php",{"Response":[idTar,"deleteTar"]}).done(function(data){
            //Empty
            alert(data);
            $('tr').find('td').fadeOut(1000,function(){
                $('tr').remove;
            })
        });
    });
        
    
    //Prevent normal form upload
    $(window).keydown(function(event){
        if(event.keyCode == 13){
            event.preventDefault();
            return false;
        } 
    });
      
    //Submit Tarea
    $("#upl-tarea").submit(function(){
        
        var $form = $(this),
            nameTar = $form.find("input[name='nombreTarea']").val(),
            descTar = $form.find("textarea[name='descripcionTarea']").val(),
            idDesc = $form.find("option:selected").val();
            //alert(idDesc);
        $.post( "Queries/Q_Tareas.php", {"Response": [nameTar,descTar,idDesc,"uploadTar"]}).done(function( data ) {
                //alert( "Data Loaded: " + data );
            //Empty
        });
    });
    
    
    //Submit Competencia
    $("#upl-competencia").submit(function(){
        
        var $form = $(this),
            nameComp = $form.find("input[name='nombreCompetencia']").val(),
            descComp = $form.find("textarea[name='descripcionCompetencia']").val();
          $.post( "Queries/Q_Competencias.php", {"Response": [nameComp,descComp,"uploadComp"]}).done(function( data ) {
                alert( "Data Loaded: " + data );
        });
    });
});