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
    
//BEGIN ALBERGUE
            $("#addNewAlbergue").on('click', function () {
               $("#tableManagerAlbergue").modal('show');
            });

            $("#tableManagerAlbergue").on('hidden.bs.modal', function () {
                $("#showContentAlbergue").fadeOut();
                $("#editContentAlbergue").fadeIn();
                $("#editRowIDAlbergue").val(0);
                $("#nombreAlbergue").val("");
                $("#municipioAlbergue").val("");
                $("#direccionAlbergue").val("");
                $("#closeBtn").fadeOut();
                $("#manageBtn").attr('value', 'Agregar').attr('onclick', "manageDataAlbergue('addNewAlbergue')").fadeIn();
                $(".modal-titulo").html('Agregar Albergue');
            });

            getExistingDataAlbergue(0, 50); 
//END ALBERGUE
    
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