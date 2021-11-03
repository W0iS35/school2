$(() => {


    $('.edit-m').on('click', function() {
        /*
        data-anio-anio
        data-anio-fInicio
        data-anio-fFin
        data-anio-descripcion
        data-anio-nombre
        data-anio-estado

        id_anio
        */
        fechaInicio = $(this).attr('data-anio-fInicio').substring(0, 10);
        fechaFin = $(this).attr('data-anio-fFin').substring(0, 10);

        $("#id_anio").val($(this).attr('data-anio-anio'));

        $("#edit-titulo").html($(this).attr('data-anio-nombre'));
        $("#edit-descripcion").val($(this).attr('data-anio-descripcion'));
        $("#edit-nombre").val($(this).attr('data-anio-nombre'));

        $("#edit-estado").val($(this).attr('data-anio-estado'));


        $("#edit-fechaInit").val(fechaInicio);
        $("#edit-fechaFin").val(fechaFin);

        //alert(fechaInicio);
        //alert(fechaFin);
        $('#bd-modal-anio-academico-edit').modal('show');
    });


    $('#btn_crear_anio').on('click', function() {
        $('#bd-modal-anio-academico').modal('show');
    });


    cargarDefault();

    function cargarDefault() {

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        $("#fechaInit").val(yyyy + '-' + mm + '-' + dd);
        $("#nombre").val(yyyy);
        /*
                $("#fechaFin").val((parseInt(yyyy) + 1) + '-' + mm + '-' + dd);

                $("#descripcion").val("Año académico - " + yyyy);

        */

        // Cargar secciones desde js


    }



})