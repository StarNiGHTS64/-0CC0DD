$(document).ready(function() {
            $("#menu-toggle").click( function (e){
                e.preventDefault();
                $("#wrapper").toggleClass("menuDisplayed");
            });
    
            $("#addNewTarea").on('click', function () {
                $("#tableManagerTarea").modal('show');
                
                $.ajax({
                        url: '../admin-queries/adminTarea.php',
                        method: 'POST',
                        dataType: 'text',
                        data:{
                            key: 'updateSelect'
                        },success: function(response){
                            //alert(response);
                            $('select').html(response);
                        }
                    });
            });
     
                $("#tableManagerTarea").on('hidden.bs.modal', function () {
                $("#showContentTarea").fadeOut();
                $("#editContentTarea").fadeIn();
                $("#editRowIDTarea").val(0);
                $("#descripcionTarea").val("");
                $("#competencia-select").val("");
                $("#closeBtnTarea").fadeOut();
                $("#manageBtnTarea").attr('value', 'Agregar').attr('onclick', "manageDataTarea('addNewTarea')").fadeIn();
                $(".modal-titulo").html('Agregar Tarea');
            });

            getExistingDataTarea(0, 50);
            
        });

        function deleteRowTarea(rowID) {
            if (confirm('¿Deseas borrar el registro de la tarea?')) {
                $.ajax({
                    url: '../admin-queries/adminTarea.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowTarea',
                        rowID: rowID
                    }, success: function (response) {
                        $("#nombreTarea_"+rowID).parent().remove();
                        $("#descripcionTarea_"+rowID).parent().remove();
                        $("#competencia-select_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditTarea(rowID, type) {
            $.ajax({
                url: '../admin-queries/adminTarea.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataTarea',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "viewTarea") {
                        $("#showContentTarea").fadeIn();
                        $("#editContentTarea").fadeOut();
                        $("#nombreViewTarea").html(response.nombreTarea);
                        $("#descripcionViewTarea").html(response.descripcionTarea);
                        $("#selectCompetenciaViewTarea").html(response.competenciaTarea);
                        
                        $("#manageBtnTarea").fadeOut();
                        $("#closeBtnTarea").fadeIn();
                    } else if (type == "editTarea") {
                        $("#editContentTarea").fadeIn();
                        $("#editRowIDTarea").val(rowID);
                        $("#showContentTarea").fadeOut();
                        $("#nombreTarea").val(response.nombreTarea);
                        $("#descripcionTarea").val(response.municipioTarea);
                        $("#select-competencia").val(response.competenciaTarea);
                        $("#closeBtnTarea").fadeOut();
                        $("#manageBtnTarea").attr('value', 'Guardar Cambios').attr('onclick', "manageDataTarea('updateRowTarea')");
                    }

                    $(".modal-titulo").html(response.nombreTarea);
                    $("#tableManagerTarea").modal('show');
                }
            });
        }

        function getExistingDataTarea(start, limit) {
            $.ajax({
                url: '../admin-queries/adminTarea.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingDataTarea',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response == "reachedMax") {
                        $(".table").DataTable();
                    } else
                        $('tbody').append(response);
                        start += limit;
                        getExistingDataTarea(start, limit);
                }
            });
        }

        function manageDataTarea(key) {
            var nombreTarea = $("#nombreTarea");
            var descripcionTarea = $("#descripcionTarea");
            var nombreCompetencia = $("#select-competencias");
            var editRowIDTarea = $("#editRowIDTarea");

            if (isNotEmpty(nombreTarea) && isNotEmpty(descripcionTarea) && isNotEmpty(nombreCompetencia)){
                $.ajax({
                   url: '../admin-queries/adminTarea.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       nombreTarea: nombreTarea.val(),
                       descripcionTarea: descripcionTarea.val(),
                       nombreCompetencia: nombreCompetencia.val(),
                       rowID: editRowIDTarea.val()
                   }, success: function (response) {
                       if (response != "success")
                           alert(response);
                       else {
                           $("#nombreTarea_"+editRowIDTarea.val()).html(nombreTarea.val());
                           $("#descripcionTarea_"+editRowIDTarea.val()).html(nombreTarea.val());
                           $("#select-competencia_"+editRowIDTarea.val()).html(nombreTarea.val());
                        
                           nombreTarea.val('');
                           municipioTarea.val('');
                           direccionTarea.val('');
                           $("#tableManagerTarea").modal('hide');
                           $("#manageBtnTarea").attr('value', 'Agregar').attr('onclick', "manageDataTarea('addNewTarea')");
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