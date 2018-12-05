$("#menu-toggle").click( function (e){
    e.preventDefault();
    $("#wrapper").toggleClass("menuDisplayed");
});

 $(document).ready(function() {
    
            $("#addNewCompetencia").on('click', function () {
               $("#tableManagerCompetencia").modal('show');
            });
     
                $("#tableManagerCompetencia").on('hidden.bs.modal', function () {
                $("#showContentCompetencia").fadeOut();
                $("#editContentCompetencia").fadeIn();
                $("#editRowIDCompetencia").val(0);
                $("#nombreCompetencia").val("");
                $("#descripcionCompetencia").val("");
                $("#closeBtnCompetencia").fadeOut();
                $("#manageBtnCompetencia").attr('value', 'Agregar').attr('onclick', "manageDataCompetencia('addNewCompetencia')").fadeIn();
                $(".modal-titulo").html('Agregar Competencia');
            });

            getExistingDataCompetencia(0, 50);
            
        });

        function deleteRowCompetencia(rowID) {
            if (confirm('¿Deseas eliminar el registro de la competencia?')) {
                $.ajax({
                    url: '../admin-queries/adminCompetencia.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowCompetencia',
                        rowID: rowID
                    }, success: function (response) {
                        $("#nombreCompetencia_"+rowID).parent().remove();
                        $("#descripcionCompetencia_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditCompetencia(rowID, type) {
            $.ajax({
                url: '../admin-queries/adminCompetencia.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataCompetencia',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "viewCompetencia") {
                        $("#showContentCompetencia").fadeIn();
                        $("#editContentCompetencia").fadeOut();
                        $("#nombreViewCompetencia").html(response.nombreCompetencia);
                        $("#descripcionViewCompetencia").html(response.descripcionCompetencia);
                        $("#manageBtnCompetencia").fadeOut();
                        $("#closeBtnCompetencia").fadeIn();
                    } else if (type == "editCompetencia") {
                        $("#editContentCompetencia").fadeIn();
                        $("#editRowIDCompetencia").val(rowID);
                        $("#showContentCompetencia").fadeOut();
                        $("#nombreCompetencia").val(response.nombreCompetencia);
                        $("#descripcionCompetencia").val(response.descripcionCompetencia);
                        $("#closeBtnCompetencia").fadeOut();
                        $("#manageBtnCompetencia").attr('value', 'Guardar Cambios').attr('onclick', "manageDataCompetencia('updateRowCompetencia')");
                    }

                    $(".modal-titulo").html(response.nombreCompetencia);
                    $("#tableManagerCompetencia").modal('show');
                }
            });
        }

        function getExistingDataCompetencia(start, limit) {
            $.ajax({
                url: '../admin-queries/adminCompetencia.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingDataCompetencia',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response == "reachedMax") {
                        $(".table").DataTable();
                    } else
                        $('tbody').append(response);
                        start += limit;
                        getExistingDataCompetencia(start, limit);
                }
            });
        }

        function manageDataCompetencia(key) {
            var nombreCompetencia = $("#nombreCompetencia");
            var descripcionCompetencia = $("#descripcionCompetencia");
            var editRowIDCompetencia = $("#editRowIDCompetencia");

            if (isNotEmpty(nombreCompetencia) && isNotEmpty(descripcionCompetencia)) {
                $.ajax({
                   url: '../admin-queries/adminCompetencia.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       nombreCompetencia: nombreCompetencia.val(),
                       descripcionCompetencia: descripcionCompetencia.val(),
                       rowID: editRowIDCompetencia.val()
                   }, success: function (response) {
                       if (response != "success")
                           alert(response);
                       else {
                           $("#nombreCompetencia_"+editRowIDCompetencia.val()).html(nombreCompetencia.val());
                           $("#descripcionCompetencia_"+editRowIDCompetencia.val()).html(nombreCompetencia.val());
                           nombreCompetencia.val('');
                           descripcionCompetencia.val('');
                           $("#tableManagerCompetencia").modal('hide');
                           $("#manageBtnCompetencia").attr('value', 'Agregar').attr('onclick', "manageDataCompetencia('addNewCompetencia')");
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