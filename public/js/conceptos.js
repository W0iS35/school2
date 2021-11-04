$(() => {



    /****************************************** Lanzador de Modales ******************************************/

    $('#btn_conceptos_individual').on("click", function() {
        $('#modal-conceptos-create').modal("show");
    })


    $('.conceptos_pago_update').on("click", function() {

        id_concepto_pago = $(this).attr('data-id-concepto-pago');
        id_monto = $(this).attr('data-id-monto');
        id_concepto = $(this).attr('data-id-concepto');
        id_nivel = $(this).attr('data-id-nivel');
        id_local = $(this).attr('data-id-local');

        $("#id_concepto_pago_update").val(id_concepto_pago);
        $("#monto_update").val(id_monto);
        $("#concepto_update").val(id_concepto);
        $("#nivel_update").val(id_nivel);
        $("#local_update").val(id_local);
/*

        alert("concepto pago: "+id_concepto_pago+"___"+
            "monto: "+id_monto+"___"+
            "concepto: "+id_concepto+"___"+
            "nivel: "+id_nivel+"___"+
            "local: "+id_local+"___");

*/


        $('#modal-conceptos-update').modal("show");
    })



})