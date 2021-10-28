$(() => {

    /****************************************** Lanzador de Modales ******************************************/


    $('.btn-alert-modal').on("click", function() {

        mensaje = $(this).attr('data_modal_alerta_mensaje');
        ruta = $(this).attr('data_modal-alert-target');

        $('#modal_alerta_mensaje').html(mensaje);
        $('#modal-alert-target').attr('action', ruta);

        $("#modal-alerta").modal('show');

    })

})