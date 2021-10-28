$(() => {
    $(".cbxSecciones").change(function() {
        let idTxt = $(this).attr("id");
        // alert(idTxt);
        idTxt = "V" + idTxt.substring(1, idTxt.length);

        //alert(idTxt);
        //alert(idTxt);
        //alert($(this).prop('checked'));
        $("#" + idTxt).prop('disabled', !($(this).prop('checked')));

    })

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



        $(".table-secciones").addClass('d-none');
        $("#table-secciones-1-1").removeClass('d-none')
        $("#table-secciones-edit-1-1").removeClass('d-none')
    }

    $(".select-secciones").change(() => {
        let local = $("#localSeleccionado option:selected").val();
        let nivel = $("#nivelSeleccionado option:selected").val();
        //alert("local " + local + " - nivel " + nivel);

        $(".table-secciones").addClass('d-none');
        $("#table-secciones-" + local + "-" + nivel).removeClass('d-none');

    });

    $(".select-secciones-edit").change(() => {
        let local = $("#edit-local option:selected").val();
        let nivel = $("#edit-nivel option:selected").val();
        //alert("local " + local + " - nivel " + nivel);

        $(".table-secciones-edit").addClass('d-none');
        $("#table-secciones-edit-" + local + "-" + nivel).removeClass('d-none');

    })



})