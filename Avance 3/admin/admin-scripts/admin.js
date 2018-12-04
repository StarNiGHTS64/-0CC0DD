$(document).ready(function() {
            $("#menu-toggle").click( function (e){
                e.preventDefault();
                $("#wrapper").toggleClass("menuDisplayed");
            });
    
    //////////////////////  BEGIN NINO  /////////////////////////////////////////////
    
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
            //////////////////  END NINO  //////////////////////////////
    
            ////////////////////////////////////////////////
    
            $("#addNew").on('click', function () {
               $("#tableManager").modal('show');
            });

                $("#tableManager").on('hidden.bs.modal', function () {
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

            //getExistingData(0, 50);

        /////////////////////////////////////////////////////////////////////////
    
        });

        function deleteRowNino(rowID) {
            if (confirm('¿Deseas el registro del niño?')) {
                $.ajax({
                    url: '../admin.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowNino',
                        rowID: rowID
                    }, success: function (response) {
                        $("#nombreNino_"+rowID).parent().remove();
                        $("#aPaternoNino_"+rowID).parent().remove();
                        $("#aMaternoNino_"+rowID).parent().remove();
                        $("#correoNino_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditNino(rowID, type) {
            $.ajax({
                url: '../admin.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataNino',
                    rowID: rowID
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
                        $("#editRowIDNino").val(rowID);
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
                url: '../admin.php',
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
                   url: '../admin.php',
                   method: 'POST',
                   dataType: 'text',
                   data: {
                       key: key,
                       nombreNino: nombreNino.val(),
                       aPaternoNino: aPaternoNino.val(),
                       aMaternoNino: aMaternoNino.val(),
                       correoNino: correoNino.val(),
                       rowID: editRowIDNino.val()
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

//BEGIN ALBERGUE

            function deleteRowAlbergue(rowID) {
            if (confirm('¿Deseas eliminar el albergue?')) {
                $.ajax({
                    url: '../admin.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'deleteRowAlbergue',
                        rowID: rowID
                    }, success: function (response) {
                        $("#tiera_"+rowID).parent().remove();
                        $("#titulo_"+rowID).parent().remove();
                        alert(response);
                    }
                });
            }
        }

        function viewOReditAlbergue(rowID, type) {
            $.ajax({
                url: '../admin.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'getRowDataAlbergue',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "view") {
                        $("#showContentAlbergue").fadeIn();
                        $("#editContentAlbergue").fadeOut();
                        $("#nombreViewAlbergue").html(response.nombre);
                        $("#municipioViewAlbergue").html(response.municipio);
                        $("#direccionViewAlbergue").html(response.direccion);
                        $("#manageBtn").fadeOut();
                        $("#closeBtn").fadeIn();
                    } else {
                        $("#editContentAlbergue").fadeIn();
                        $("#editRowIDAlbergue").val(rowID);
                        $("#showContentAlbergue").fadeOut();
                        $("#nombreAlbergue").val(response.nombre);
                        $("#municipioAlbergue").val(response.municipio);
                        $("#direccionAlbergue").val(response.direccion);
                        $("#closeBtn").fadeOut();
                        $("#manageBtn").attr('value', 'Guardar Cambios').attr('onclick', "manageDataAlbergue('updateRowAlbergue')");
                    }

                    $(".modal-titulo").html(response.nombre);
                    $("#tableManagerAlbergue").modal('show');
                }
            });
        }

        function getExistingDataAlbergue(start, limit) {
            $.ajax({
                url: '../admin.php',
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
            var municipio = $("#autor");
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

//END ALBERGUE

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