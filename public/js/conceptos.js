$(() => {


    alert('todo bien');

    /****************************************** Lanzador de Modales ******************************************/

    $('#btn_conceptos_individual').on("click", function() {
        $('#modal-conceptos-create').modal("show");
    })


    $('.conceptos_pago_update').on("click", function() {
        $('#modal-conceptos-update').modal("show");
    })














    $(".table-secciones").addClass('d-none');
    $("#table-secciones-1-1").removeClass('d-none')
    $("#table-secciones-edit-1-1").removeClass('d-none')


    //alert('Hola mindo')



    $('#btn_crear_vacantes_masivo').on("click", function() {
        $('.bd-modal-anio-academico').modal("show");
    });



    $('.btn-edit-vac').on("click", function() {
        /**
         * modal-vacante
         * 
         * modal-vacante-id
         * modal-vacante-grado    
         * modal-vacante-seccion
         * modal-vacante-vac-totales
         * 
         * data-modal-vacante-id
         * data-modal-vacante-grado  
         * data-modal-vacante-seccion
         * data-modal-vacante-vac-totales
         */

        vacante_id = $(this).attr('data-modal-vacante-id');
        vacante_grado = $(this).attr('data-modal-vacante-grado');
        vacante_seccion = $(this).attr('data-modal-vacante-seccion');
        vacante_local = $(this).attr('data-modal-vacante-local');
        vacante_nivel = $(this).attr('data-modal-vacante-nivel');
        vacante_numero_vac = $(this).attr('data-modal-vacante-vac-totales');


        $('#id_vac').val(vacante_id);

        $('#modal-vacante-local').val(vacante_local);
        $('#modal-vacante-nivel').val(vacante_nivel);
        $('#modal-vacante-grado').val(vacante_grado);
        $('#modal-vacante-seccion').val(vacante_seccion);
        $('#num_vacantes').val(parseInt(vacante_numero_vac));

        $("#modal-vacante-edit").modal('show');

    })



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
    $(".cbxSecciones").change(function() {
        let idTxt = $(this).attr("id");
        // alert(idTxt);
        idTxt = "V" + idTxt.substring(1, idTxt.length);

        //alert(idTxt);
        //alert(idTxt);
        //alert($(this).prop('checked'));
        $("#" + idTxt).prop('disabled', !($(this).prop('checked')));

    })


    /*
     */


})