$("#menu-toggle").click( function (e){
    e.preventDefault();
    $("#wrapper").toggleClass("menuDisplayed");
});

 $(document).ready(function() {
    
            $("#addNewAlbergue").on('click', function () {
               $("#tableManagerAlbergue").modal('show');
            });
     
                $("#tableManagerAlbergue").on('hidden.bs.modal', function () {
                $("#showContentAlbergue").fadeOut();
                $("#editContentAlbergue").fadeIn();
                $("#editRowIDAlbergue").val(0);
                $("#nombreAlbergue").val("");
                $("#closeBtnAlbergue").fadeOut();
                $("#manageBtnAlbergue").attr('value', 'Agregar').attr('onclick', "manageDataAlbergue('addNewAlbergue')").fadeIn();
                $(".modal-titulo").html('Agregar Albergue');
            });

            getExistingDataAlbergue(0, 50);
            
        });

        function deleteRowAlbergue(rowID) {
            if (confirm('¿Deseas borrar el registro del albergue?')) {
                $.ajax({
                    url: '../admin-queries/adminAlbergue.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowAlbergue',
                        rowID: rowID
                    }, success: function (response) {
                        $("#nombreAlbergue_"+rowID).parent().remove();
                        $("#municipioAlbergue_"+rowID).parent().remove();
                        $("#direccionAlbergue_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditAlbergue(rowID, type) {
            $.ajax({
                url: '../admin-queries/adminAlbergue.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataAlbergue',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "viewAlbergue") {
                        $("#showContentAlbergue").fadeIn();
                        $("#editContentAlbergue").fadeOut();
                        $("#nombreViewAlbergue").html(response.nombreAlbergue);
                        $("#municipioViewAlbergue").html(response.municipioAlbergue);
                        $("#direccionViewAlbergue").html(response.direccionAlbergue);
                        
                        $("#manageBtnAlbergue").fadeOut();
                        $("#closeBtnAlbergue").fadeIn();
                    } else if (type == "editAlbergue") {
                        $("#editContentAlbergue").fadeIn();
                        $("#editRowIDAlbergue").val(rowID);
                        $("#showContentAlbergue").fadeOut();
                        $("#nombreAlbergue").val(response.nombreAlbergue);
                        $("#municipioAlbergue").val(response.municipioAlbergue);
                        $("#direccionAlbergue").val(response.direccionAlbergue);
                        $("#closeBtnAlbergue").fadeOut();
                        $("#manageBtnAlbergue").attr('value', 'Guardar Cambios').attr('onclick', "manageDataAlbergue('updateRowAlbergue')");
                    }

                    $(".modal-titulo").html(response.nombreAlbergue);
                    $("#tableManagerAlbergue").modal('show');
                }
            });
        }

        function getExistingDataAlbergue(start, limit) {
            $.ajax({
                url: '../admin-queries/adminAlbergue.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingDataAlbergue',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response == "reachedMax") {
                        $(".table").DataTable();
                    } else
                        $('tbody').append(response);
                        start += limit;
                        getExistingDataAlbergue(start, limit);
                }
            });
        }

        function manageDataAlbergue(key) {
            var nombreAlbergue = $("#nombreAlbergue");
            var municipioAlbergue = $("#municipioAlbergue");
            var direccionAlbergue = $("#direccionAlbergue");
            var editRowIDAlbergue = $("#editRowIDAlbergue");

            if (isNotEmpty(nombreAlbergue) && isNotEmpty(municipioAlbergue) && isNotEmpty(direccionAlbergue)){
                $.ajax({
                   url: '../admin-queries/adminAlbergue.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       nombreAlbergue: nombreAlbergue.val(),
                       municipioAlbergue: municipioAlbergue.val(),
                       direccionAlbergue: direccionAlbergue.val(),
                       rowID: editRowIDAlbergue.val()
                   }, success: function (response) {
                       if (response != "success")
                           alert(response);
                       else {
                           $("#nombreAlbergue_"+editRowIDAlbergue.val()).html(nombreAlbergue.val());
                           $("#municipioAlbergue_"+editRowIDAlbergue.val()).html(nombreAlbergue.val());
                           $("#direccionAlbergue_"+editRowIDAlbergue.val()).html(nombreAlbergue.val());
                        
                           nombreAlbergue.val('');
                           municipioAlbergue.val('');
                           direccionAlbergue.val('');
                           $("#tableManagerAlbergue").modal('hide');
                           $("#manageBtnAlbergue").attr('value', 'Agregar').attr('onclick', "manageDataAlbergue('addNewAlbergue')");
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