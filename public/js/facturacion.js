$(()=>{
    //alert("Hola mundo");

    /**
        menu-facturacion
        cronograma_pagos 
     */
    $('.menu-facturacion').addClass('d-none');
    $('.btn-menu-facturacion').on('click', onClickBtnMenu);
    
    cargaPagina();

   /************************************************ Begin: Eventos ***********************************************/
   function onClickBtnMenu (e){
       let target=  $(this).attr('target');
       target = $(target);
       $('.menu-facturacion').addClass('d-none');
       $('.btn-menu-facturacion').removeClass('bg-white');
       $(this).addClass('bg-white');
       target.removeClass('d-none');
       target.fadeIn();
    }
    /************************************************ End: Eventos ***********************************************/
    
    function cargaPagina(){
        $('#cronograma_pagos').removeClass('d-none');
        $('#btn-cronograma').addClass("bg-white");

    }



})