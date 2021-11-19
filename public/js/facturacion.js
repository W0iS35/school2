$(()=>{
    let $formulario_pago= document.getElementById('formulario_pago'), 
    $alumno= document.getElementById("alumno_nombre"),
    $cronograma_pagos = document.getElementById("cronograma_pagos");
    $otros_pagos = document.getElementById("otros_pagos");
    
    let conceptos = null;
    //$tbody_cronograma =  document.getElementById("tbody_cronograma"),
    //$tbody_cronograma =  $cronograma_pagos.querySelector("tbody"),
    //$tbody_otro = document.getElementById("tbody");


    $('.menu-facturacion').addClass('d-none');

    $('.btn-menu-facturacion').on('click', onClickBtnMenu);
    $formulario_pago.btn_buscar.addEventListener('click', onClickBtnSearch, null);
    $formulario_pago.tipo_pago.addEventListener('change', handleTipoPago, null);
    $formulario_pago.concepto_pago.addEventListener('change', selectOptionConcepto, null);
    
    //$formulario_pago.concepto_pago.addEventListener('change', selectOptionConcepto, null);
    
    document.getElementById('btn-confirmar-pago').addEventListener('click', onClickEnviarPeticion , null)
    document.getElementById('btn-confirmar-limpiar').addEventListener('click', onClickLimpiarFormulario  , null)

    resetearPagina(true);

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

    function selectOptionConcepto(e){
        //alert('Seleccionando concepto')
            monto = e.target.options[e.target.selectedIndex].getAttribute('data-monto');
            formulario_pago.pago_monto.value = monto;
    }

    function handleTipoPago(e){
        //alert (e.target.value)
        switch(e.target.value){
            case '1':
                $formulario_pago.querySelector('.pago_banco').style.display = 'none'
            break;
            case '2':
                $formulario_pago.querySelector('.pago_banco').style.display = 'block'
            break;
            default:
                console.warn('Selecciono una opcion valida en el tipo de pago .... => ', e.target.value);
            break;
        } 
    }    

    function onClickBtnSearch(e){
        e.preventDefault();
        url= $(this).attr('target-url');
        dni= $("#dni_alumno").val();
        id_anio= $("#anio_id").val();
        url = `${url}/${dni}/${id_anio}`
        console.warn(url);
        buscarAlumo(url);
    }

    function onClickEnviarPeticion(e){
        e.preventDefault();
        alert('Enviando Peticion ...');

        RefrescarCambios();
        resetearPagina();
    }

    function onClickLimpiarFormulario(e){
        resetearPagina(true);
    }

    function selectCronogramaPendiente(e){
        e.stopPropagation()
        console.log(this);
        console.log(this.dataset);
        console.log(this.dataset.id);
        console.log(this.dataset.monto);
        console.log(this.dataset.concepto);

        // Agregando configuracion al formulario 
        let option = document.createElement('option');
        let textoOption = document.createTextNode(`${this.dataset.concepto} (${this.dataset.monto})`);
        option.value = this.dataset.id;
        option.appendChild(textoOption);
        $formulario_pago.concepto_pago.prepend(option);

        $formulario_pago.concepto_pago.value= this.dataset.id;
        $formulario_pago.pago_monto.value = this.dataset.monto;
    }

    /************************************************ End: Eventos ***********************************************/
    

    /************************************************ Begin: Peticiones ************************************************/
    async function buscarAlumo(url){

        //alert(url);
        // Limpiando formulario y tablas
        resetearPagina(true);

        try {
            // Realizando la peticion
            data = await fetch(url);
            json = await data.json();
            console.log(json); 

            // Activando botnoes
            disableStateForm(false);

            //Caragando la data
            $alumno.value=`${json.alumno.apellidos} ${json.alumno.nombres}`;

            let tableCronograma = "";
            json.cronograma.forEach((value) => {
                tableCronograma+= `
                <tr class="${value.MP_CRO_ESTADO=='PENDIENTE'? 'table-danger bg-hover-light pagar-cronograma':''}"  data-id="${value.id_cronograma}" data-monto="${value.MP_CRO_MONTO}" data-concepto="${value.MP_CON_CONCEPTO}"" >
                    <td class='text-center text-capitalize' > ${value.id_cronograma} </td>
                    <td class='text-center text-capitalize' > ${value.MP_CON_CONCEPTO.toLowerCase()} </td>
                    <td class='text-center text-capitalize' > ${value.MP_CRO_TIPODEUDA.toLowerCase()} </td>
                    <td class='text-center text-capitalize' > ${value.MP_CRO_ESTADO.toLowerCase()} </td>
                    <td class='text-center text-capitalize' > ${value.MP_CRO_MONTO.toLowerCase()} S/ </td>
                    </tr>`
                })
                //<td class='text-center' > ${value.MP_CRO_FECHAVEN.substring(0, 10)} </td>
                $cronograma_pagos.querySelector("tbody").innerHTML = tableCronograma==""? "<tr colspan='5' class='text-center'> No se encontro un cronograma de pagos </tr>":tableCronograma;


            conceptos = json.conceptosPago;
            cargarConceptos();
            
            document.getElementsByClassName('pagar-cronograma').forEach((element)=>element.addEventListener('click', selectCronogramaPendiente, null))
        } catch (error) {
            console.error(error);
        }
    }

    /************************************************ End: Peticiones ************************************************/
    
    
    /************************************************ Begin: Helpers ************************************************/
    function RefrescarCambios() {
        
    }
    
    function cargarConceptos(){
        //Cargando conceptos
        let selectConceptos = "";
        conceptos.forEach((value) => {
            selectConceptos+= `
            <option id="${value.id_conceptoPago}" data-monto='${value.monto}' > ${value.concepto_nombre} (${value.monto})  [${value.id_conceptoPago}]  </option> `
        })
        $formulario_pago.concepto_pago.innerHTML=selectConceptos;
        
        //Cargando Monto
        formulario_pago.pago_monto.value = formulario_pago.concepto_pago.options[0].getAttribute('data-monto');
    }

    function resetearPagina(total=false){

        let $tbody_cronograma =  $cronograma_pagos.querySelector("tbody"),
        $tbody_otro = $otros_pagos.querySelector("tbody"),
        fecha = (new Date(Date.now())).toLocaleDateString().split('/');
        

        if(total){
            //Reseteo cambio de alumno
            //$formulario_pago.dni_alumno.value= '' ;
            $formulario_pago.concepto_pago.innerHTML=' <option> - </option> ';
            $formulario_pago.pago_monto.value=0;
            $alumno.value='-';
            
            $tbody_cronograma.innerHTML = `<tr><td class="text-center" colspan="5">Introdusca los datos del alumno a buscar</td></tr>`;
            $tbody_otro.innerHTML = `<tr><td class="text-center" colspan="5">No se han encontrado otros pagos realizados</td></tr>`;

            // Desactivacion de botones
            disableStateForm();
        }
        
        //Reseteo pago
        $formulario_pago.tipo_pago.value=1;
        $formulario_pago.pago_banco.value='BCP';
        $formulario_pago.numero_operacion.value='';
        $formulario_pago.fecha_pago.value= `${fecha[2]}-${fecha[1]}-${fecha[0]}`; 
        $formulario_pago.fecha_operacion.value='';
        $formulario_pago.tipo_comprobante.value=2;
        
        // Formateando estilos
        document.querySelector('.pago_banco').style.display = 'none'
        $formulario_pago.concepto_pago.value = $formulario_pago.concepto_pago.options[0].value;
        $formulario_pago.pago_monto.value = formulario_pago.concepto_pago.options[0].getAttribute('data-monto');
        
        
        $('#cronograma_pagos').removeClass('d-none');
        $('#btn-cronograma').addClass("bg-white");
    }

    function disableStateForm(activo=true){
        $formulario_pago.concepto_pago.disabled = activo;
        $formulario_pago.tipo_pago.disabled = activo;
        $formulario_pago.fecha_pago.disabled = activo;
        $formulario_pago.tipo_comprobante.disabled = activo;
        
        $formulario_pago.btn_confirmar.disabled = activo;
        $formulario_pago.btn_limpiar.disabled = activo;
    }
    /************************************************ Begin: Helpers ************************************************/


})