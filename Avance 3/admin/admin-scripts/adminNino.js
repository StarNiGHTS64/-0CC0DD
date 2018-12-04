$(document).ready(function() {
    
            $("#menu-toggle").click( function (e){
                e.preventDefault();
                $("#wrapper").toggleClass("menuDisplayed");
            });
    
            $("#addNewNino").on('click', function () {
               $("#tableManagerNino").modal('show');
            });

                $("#tableManagerNino").on('hidden.bs.modal', function () {
                $("#showContentNino").fadeOut();
                $("#editContentNino").fadeIn();
                $("#editRowIDNino").val(0);
                $("#nombreNino").val("");
                $("#aPaternoNino").val("");
                $("#aMaternoNino").val("");
                $("#correoNino").val("");
                $("#closeBtnNino").fadeOut();
                $("#manageBtnNino").attr('value', 'Agregar').attr('onclick', "manageDataNino('addNewNino')").fadeIn();
                $(".modal-titulo").html('Agregar Niño');
            });

            getExistingDataNino(0, 50);
    
        });


        function deleteRowNino(rowIDNino) {
            if (confirm('¿Deseas eliminar el registro del niño?')) {
                $.ajax({
                    url: '../adminNino.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowNino',
                        rowID: rowIDNino
                    }, success: function (response) {
                        $("#nombreNino_"+rowIDNino).parent().remove();
                        $("#aPaternoNino_"+rowIDNino).parent().remove();
                        $("#aMaternoNino_"+rowIDNino).parent().remove();
                        $("#correoNino_"+rowIDNino).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditNino(rowIDNino, type) {
            $.ajax({
                url: '../adminNino.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataNino',
                    rowID: rowIDNino
                }, success: function (response) {
                    if (type == "viewNino") {
                        $("#showContentNino").fadeIn();
                        $("#editContentNino").fadeOut();
                        $("#nombreViewNino").html(response.nombreNino);
                        $("#aPaternoViewNino").html(response.aPaternoNino);
                        $("#aMaternoViewNino").html(response.aMaternoNino);
                        $("#correoViewNino").html(response.correoNino);
                        $("#manageBtnNino").fadeOut();
                        $("#closeBtnNino").fadeIn();
                    } else if (type == "editNino") {
                        $("#editContentNino").fadeIn();
                        $("#editRowIDNino").val(rowIDNino);
                        $("#showContentNino").fadeOut();
                        $("#nombreNino").val(response.nombreNino);
                        $("#aPaternoNino").val(response.aPaternoNino);
                        $("#aMaternoNino").val(response.aMaternoNino);
                        $("#correoNino").val(response.correoNino);
                        $("#closeBtnNino").fadeOut();
                        $("#manageBtnNino").attr('value', 'Guardar Cambios').attr('onclick', "manageDataNino('updateRowNino')");
                    }

                    $(".modal-titulo").html(response.nombreNino);
                    $("#tableManagerNino").modal('show');
                }
            });
        }

        function getExistingDataNino(start, limit) {
            $.ajax({
                url: '../adminNino.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingDataNino',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response == "reachedMax") {
                        $(".table").DataTable();
                    } else
                        $('tbody').append(response);
                        start += limit;
                        getExistingDataNino(start, limit);
                }
            });
        }

        function manageDataNino(key) {
            var nombreNino = $("#nombreNino");
            var aPaternoNino = $("#aPaternoNino");
            var aMaternoNino = $("#aMaternoNino");
            var correoNino = $("#correoNino");
            var editRowIDNino = $("#editRowIDNino");

            if (isNotEmpty(nombreNino) && isNotEmpty(aPaternoNino) && isNotEmpty(aMaternoNino) && isNotEmpty(correoNino)) {
                $.ajax({
                   url: '../adminNino.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       nombreNino: nombreNino.val(),
                       aPaternoNino: aPaternoNino.val(),
                       aMaternoNino: aMaternoNino.val(),
                       correoNino: correoNino.val(),
                       rowIDNino: editRowIDNino.val()
                   }, success: function (response) {
                       if (response != "success")
                           alert(response);
                       else {
                           $("#nombreNino_"+editRowIDNino.val()).html(nombreNino.val());
                           $("#aPaternoNino_"+editRowIDNino.val()).html(nombreNino.val());
                           $("#aMaternoNino_"+editRowIDNino.val()).html(nombreNino.val());
                           $("#correoNino_"+editRowIDNino.val()).html(correoNino.val());
                           nombreNino.val('');
                           correoNino.val('');
                           aPaternoNino.val('');
                           aMaternoNino.val('');
                           $("#tableManagerNino").modal('hide');
                           $("#manageBtnNino").attr('value', 'Agregar').attr('onclick', "manageDataNino('addNewNino')");
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