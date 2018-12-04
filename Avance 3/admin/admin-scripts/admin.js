$(document).ready(function() {
            $("#menu-toggle").click( function (e){
                e.preventDefault();
                $("#wrapper").toggleClass("menuDisplayed");
            });
    
    
            $("#addNew").on('click', function () {
               $("#tableManager").modal('show');
            });

                $("#tableManager").on('hidden.bs.modal', function () {
                $("#showContent").fadeOut();
                $("#editContent").fadeIn();
                $("#editRowID").val(0);
                $("#descripcion").val("");
                $("#autor").val("");
                $("#tierra").val("");
                $("#titulo").val("");
                $("#closeBtn").fadeOut();
                $("#manageBtn").attr('value', 'Agregar').attr('onclick', "manageData('addNew')").fadeIn();
                $(".modal-titulo").html('Nueva Historia');
            });

            getExistingData(0, 50);
//=====================================================================================
    
            function writbl(){
                $.post("../../functionalities/Queries/Q_Tareas.php",{"Response":"lol"},function(data){
                    $("#dispTareas").html(data);
                    //$('#dispTareas').trigger('update');
                });
            }
      
        //Upload Tarea

            $("#upl-tarea").on('click',function(event){
                event.preventDefault();
                var $form = $(this),
                    nameTar = $form.find("input[name='nombreTarea']").val(),
                    descTar = $form.find("textarea[name='descripcionTarea']").val(),
                    idDesc = $form.find("option:selected").val();
                $.post( "functionalities/Queries/Q_Tareas.php", {"Response": [nameTar,descTar,idDesc,"uploadTar"]}).done(function( data ) {
                    writbl();
                });
            });
    
    
    //=======================================================================================================================
    
            $.post("../../functionalities/Queries/Q_Competencias.php",{"Response":"competencia-view"}).done(function(data){
                //alert(data);
                $('#tabla-competencia').html(data);
            });
    
            //Submit Competencia
            $("#upl-competencia").on('click',function(){

                var $form = $("#edit-competencia-content"),
                    nameComp = $form.find("input[name='nombre-competencia']").val(),
                    descComp = $form.find("textarea[name='descripcion-competencia']").val();
                $.post( "../../functionalities/Queries/Q_Competencias.php", {"Response": [nameComp,descComp,"uploadComp"]}).done(function( data ) {
                    $.post("../../functionalities/Queries/Q_Competencias.php",{"Response":"competencia-view"}).done(function(data){
                        $('#tabla-competencia').html(data);
                    });
                });
            });
    
    
            
    
    //=======================================================================================================================
    
            //CRUD button: Action for delete
            $('body').on("click",".something2",function(){
                var $buttonVal = $(this),
                    idTar = $(this).attr("name");
                $.post("../../functionalities/Queries/Q_Tareas.php",{"Response":[idTar,"deleteTar"]}).done(function(data){
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
            $.post("../../functionalities/Queries/Q_Competencias.php",{"Response":"tarea-select-call"},function(data){
                $('#select-competencia').append(data);
                $('#select-competencia').trigger('contentChanged'); 
            });
            
    
        });

        function deleteRow(rowID) {
            if (confirm('¿Deseas eliminar la historia?')) {
                $.ajax({
                    url: '../../functionalities/agregaHistoria.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRow',
                        rowID: rowID
                    }, success: function (response) {
                        $("#tiera_"+rowID).parent().remove();
                        $("#titulo_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewORedit(rowID, type) {
            $.ajax({
                url: '../../functionalities/agregaHistoria.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowData',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "view") {
                        $("#showContent").fadeIn();
                        $("#editContent").fadeOut();
                        $("#descripcionView").html(response.descripcion);
                        $("#autorView").html(response.autor);
                        $("#tierraView").val(response.tierra);
                        $("#manageBtn").fadeOut();
                        $("#closeBtn").fadeIn();
                    } else {
                        $("#editContent").fadeIn();
                        $("#editRowID").val(rowID);
                        $("#showContent").fadeOut();
                        $("#descripcion").val(response.descripcion);
                        $("#autor").val(response.autor);
                        $("#titulo").val(response.titulo);
                        $("#tierra").val(response.tierra);
                        $("#closeBtn").fadeOut();
                        $("#manageBtn").attr('value', 'Guardar Cambios').attr('onclick', "manageData('updateRow')");
                    }

                    $(".modal-titulo").html(response.titulo);
                    $("#tableManager").modal('show');
                }
            });
        }

        function getExistingData(start, limit) {
            $.ajax({
                url: '../../functionalities/agregaHistoria.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingData',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response == "reachedMax") {
                        $(".table").DataTable();
                    } else
                        $('tbody').append(response);
                        start += limit;
                        getExistingData(start, limit);
                }
            });
        }

        function manageData(key) {
            var titulo = $("#titulo");
            var autor = $("#autor");
            var tierra = $("#tierra");
            var descripcion = $("#descripcion");
            var editRowID = $("#editRowID");

            if (isNotEmpty(titulo) && isNotEmpty(tierra) && isNotEmpty(autor) && isNotEmpty(descripcion)) {
                $.ajax({
                   url: '../../functionalities/agregaHistoria.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       titulo: titulo.val(),
                       autor: autor.val(),
                       tierra: tierra.val(),
                       descripcion: descripcion.val(),
                       rowID: editRowID.val()
                   }, success: function (response) {
                       if (response != "success")
                           alert(response);
                       else {
                           $("#titulo_"+editRowID.val()).html(titulo.val());
                           $("#tierra_"+editRowID.val()).html(tierra.val());
                           titulo.val('');
                           tierra.val('');
                           autor.val('');
                           descripcion.val('');
                           $("#tableManager").modal('hide');
                           $("#manageBtn").attr('value', 'Agregar').attr('onclick', "manageData('addNew')");
                       }
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            
            if (caller == 'tierra'){
                if (caller.val() == "Azul" || "Amarilla" || "Rosa" || "Blanca" || "Verde" || "Roja" || "Morada")
                    caller.css('border', '');
                else {
                    caller.css('border', '1px solid red');
                    return false;
                }
            }
            
            if (caller.val() == '') {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');
            
            return true;
        }