$(document).ready(function(event){
    
    writbl();
    upl_tarea();
    
    $('#dispTareas').on('update',function(){});

    $('.materialSelect').formSelect();

    $('.materialSelect').on('contentChanged',function(){
        $(this).formSelect();
    });
        
    $(window).keydown(function(event){
        if(event.keyCode == 13){
            event.preventDefault();
            return false;
        } 
    });
    
    function writbl(){
            $.post("Queries/Q_Tareas.php",{"Response":"lol"},function(data){
            $("#dispTareas").html(data);
            $('#dispTareas').trigger('update');
        });
    }
      
    //Upload Tarea
    function upl_tarea(){
        $("#upl-tarea").submit(function(){
            var $form = $(this),
                nameTar = $form.find("input[name='nombreTarea']").val(),
                descTar = $form.find("textarea[name='descripcionTarea']").val(),
                idDesc = $form.find("option:selected").val();
            $.post( "Queries/Q_Tareas.php", {"Response": [nameTar,descTar,idDesc,"uploadTar"]}).done(function( data ) {    
            });
        });
    }
    
    //Submit Competencia
    $("#upl-competencia").submit(function(){
        
        var $form = $(this),
            nameComp = $form.find("input[name='nombreCompetencia']").val(),
            descComp = $form.find("textarea[name='descripcionCompetencia']").val();
        $.post( "Queries/Q_Competencias.php", {"Response": [nameComp,descComp,"uploadComp"]}).done(function( data ) {
                //alert( "Data Loaded: " + data );
        });
    });
    
    
    //CRUD button: Action for delete
    $('body').on("click",".something2",function(){
        var $buttonVal = $(this),
            idTar = $(this).attr("name");
        $.post("Queries/Q_Tareas.php",{"Response":[idTar,"deleteTar"]}).done(function(data){
            //Empty
            //alert("hello world");
            writbl();
        });
    });
    
    //CRUD btton: ACtion for edit
    $('body').on("click",".something1",function(){
        var $buttonVal = $(this),
            idTar = $(this).attr("name");
            $.post("Queries/Q_Tarea.php",{"Response":[idTar,"editTar"]}).done(function(data){
            //alert(data);
            $("#editTareaModal").html(data);
            //writbl();
        });
        //upl_tarea();
    });
    
    
    //Update Select Option Event
    $.post("Queries/Q_Competencias.php",{"Response":"tarea-select-call"},function(data){
        $('#select-competencia').append(data);
        $('#select-competencia').trigger('contentChanged'); 
    });
    
});