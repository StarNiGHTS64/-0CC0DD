$("#menu-toggle").click( function (e){
                e.preventDefault();
                $("#wrapper").toggleClass("menuDisplayed");
            });

$(document).ready(function() {
            $("#addNewMtro").on('click', function () {
               $("#tableManagerMtro").modal('show');
            });

                $("#tableManagerMtro").on('hidden.bs.modal', function () {
                $("#showContentMtro").fadeOut();
                $("#editContentMtro").fadeIn();
                $("#editRowIDMtro").val(0);
                $("#nombreMtro").val("");
                $("#aPaternoMtro").val("");
                $("#aMaternoMtro").val("");
                $("#corroeMtro").val("");
                $("#contrasenaMtro").val("");
                $("#closeBtnMtro").fadeOut();
                $("#manageBtnMtro").attr('value', 'Agregar').attr('onclick', "manageDataMtro('addNewMtro')").fadeIn();
                $(".modal-titulo").html('Registrar Maestro');
            });

            getExistingDataMtro(0, 50);
        });

        function deleteRowMtro(rowID) {
            if (confirm('¿Deseas eliminar la historia?')) {
                $.ajax({
                    url: '../admin-queries/adminMaestro.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowMtro',
                        rowID: rowID
                    }, success: function (response) {
                        $("#nombreMtro_"+rowID).parent().remove();
                        $("#aPaternoMtro_"+rowID).parent().remove();
                        $("#aMaternoMtro_"+rowID).parent().remove();
                        $("#correoMtro_"+rowID).parent().remove();
                        $("#contrasenaMtro_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditMtro(rowID, type) {
            $.ajax({
                url: '../admin-queries/adminHistoria.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataMtro',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "viewMtro") {
                        $("#showContentMtro").fadeIn();
                        $("#editContentMtro").fadeOut();
                        $("#nombreViewMtro").html(response.nombreMtro);
                        $("#aPaternoViewMtro").html(response.aPaternoMtro);
                        $("#aMaternoViewMtro").html(response.aMaternoMtro);
                        $("#correoViewMtro").html(response.correoMtro);
                        $("#contrasenaViewMtro").html(response.contrasenaMtro);
                        $("#manageBtnMtro").fadeOut();
                        $("#closeBtnMtro").fadeIn();
                    } else if (type == "editMtro") {
                        $("#editContentMtro").fadeIn();
                        $("#editRowIDMtro").val(rowID);
                        $("#showContentMtro").fadeOut();
                        $("#nombreMtro").val(response.nombreMtro);
                        $("#aPaternoMtro").val(response.aPaternoMtro);
                        $("#aMaternoMtro").val(response.aMaternoMtro);
                        $("#correoMtro").val(response.correoMtro);
                        $("#contrasenaMtro").val(response.correoMtro);
                        $("#closeBtnMtro").fadeOut();
                        $("#manageBtnMtro").attr('value', 'Guardar Cambios').attr('onclick', "manageDataMtro('updateRowMtro')");
                    }

                    $(".modal-titulo").html(response.nombreMtro);
                    $("#tableManagerMtro").modal('show');
                }
            });
        }

        function getExistingDataMtro(start, limit) {
            $.ajax({
                url: '../admin-queries/adminMaestro.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'getExistingDataMtro',
                    start: start,
                    limit: limit
                }, success: function (response) {
                    if (response != "reachedMax") {
                        $('tbody').append(response);
                        start += limit;
                        getExistingDataMtro(start, limit);
                    } else
                        $(".table").DataTable();
                }
            });
        }

        function manageDataMtro(key) {
            var nombreMtro = $("#nombreMtro");
            var aPaternoMtro = $("#aPaternoMtro");
            var aMaternoMtro = $("#aMaternoMtro");
            var correoMtro = $("#correoMtro");
            var contrasenaMtro = $("#contrasenaMtro");
            var editRowIDMtro = $("#editRowIDMtro");

            if (isNotEmpty(nombreMtro) && isNotEmpty(aPaternoMtro) && isNotEmpty(aMaternoMtro) && isNotEmpty(correoMtro) && isNotEmpty(contrasenaMtro)) {
                $.ajax({
                   url: '../admin-queries/adminMaestro.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       nombreMtro: nombreMtro.val(),
                       aPaternoMtro: aPaternoMtro.val(),
                       aMaternoMtro: aMaternoMtro.val(),
                       correoMtro: correoMtro.val(),
                       contrasenaMtro: contrasenaMtro.val(),
                       rowID: editRowIDMtro.val()
                   }, success: function (response) {
                       if (response != "success")
                           alert(response);
                       else {
                           $("#nombreMtro_"+editRowIDMtro.val()).html(nombreMtro.val());
                           $("#aPaternoMtro_"+editRowIDMtro.val()).html(aPaternoMtro.val());
                           $("#aMaternoMtro_"+editRowIDMtro.val()).html(aMaternoMtro.val());
                           $("#correoMtro_"+editRowIDMtro.val()).html(correoMtro.val());
                           $("#contrasenaMtro_"+editRowIDMtro.val()).html(contrasenaMtro.val());
                           nombreMtro.val('');
                           aPaternoMtro.val('');
                           aMaternoMtro.val('');
                           contrasenaMtro.val('');
                           correoMtro.val('');
                           $("#tableManagerMtro").modal('hide');
                           $("#manageBtnMtro").attr('value', 'Agregar').attr('onclick', "manageDataMtro('addNewMtro')");
                       }
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            
            if (caller.val() == '') {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');
            
            return true;
        }
    