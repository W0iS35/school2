$(() => {

    /****************************************** Lanzador de Modales ******************************************/

    //alert('Hola mindo')

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

})