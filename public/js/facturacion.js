
$(() => {
    let $formulario_pago = document.getElementById('formulario_pago'),
        $alumno = document.getElementById("alumno_nombre"),
        $cronograma_pagos = document.getElementById("cronograma_pagos"),
        $otros_pagos = document.getElementById("otros_pagos"),
        $pagosPendientes = document.getElementById("pagos_pendientes"),
        $alertasDOM = document.getElementById("alertas");

    let conceptos = null,
        intervaloAlerta = null,
        urlDataGeneral=null;

    $('.menu-facturacion').addClass('d-none');
    //document.querySelectorAll(".menu-facturacion").forEach(el=>el.classList.addClass('d-none'));


    document.getElementsByClassName('btn-menu-facturacion').forEach((el)=>el.addEventListener('click', onClickBtnMenu));
    $formulario_pago.btn_buscar.addEventListener('click', onClickBtnSearch, null);
    $formulario_pago.tipo_pago.addEventListener('change', handleTipoPago, null);
    $formulario_pago.concepto_pago.addEventListener('change', selectOptionConcepto, null);
    $formulario_pago.btn_confirmar.addEventListener('click', onClickPagar, null)
    $formulario_pago.btn_limpiar.addEventListener('click', onClickLimpiarFormulario, null)

    resetearPagina(true);

    /************************************************ Begin: Eventos ***********************************************/
    function onClickBtnMenu(e) {
        let target = $(this).attr('target');
        target = $(target);
        $('.menu-facturacion').addClass('d-none');
        $('.btn-menu-facturacion').removeClass('bg-white');
        $(this).addClass('bg-white');
        target.removeClass('d-none');
        target.fadeIn();
    }

    function selectOptionConcepto(e) {
        let indiceSeleccionado = e.target.selectedIndex;
        //alert  (indiceSeleccionado);
        cargarConceptos()
        e.target.selectedIndex = indiceSeleccionado;
        monto = e.target.options[indiceSeleccionado].getAttribute('data-monto');
        formulario_pago.pago_monto.value = monto;
        $formulario_pago.cronograma_id.value = "";
    }

    function handleTipoPago(e) {
        //alert (e.target.value)
        switch (e.target.value) {
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

    function onClickBtnSearch(e) {
        e.preventDefault();
        urlDataGeneral = $(this).attr('target-url');
        dni = $("#dni_alumno").val();
        id_anio = $("#anio_id").val();
        urlDataGeneral = `${urlDataGeneral}/${dni}/${id_anio}`
        console.warn(urlDataGeneral);
        cargarDataAlumno(urlDataGeneral);
    }

    function onClickPagar(e) {
        e.preventDefault();
        url = e.target.dataset.endpoint;
        //alert(url);

        const pagar = async () => {

            let formData = new FormData($formulario_pago);
            //formData.keys().forEach(key=>{ });
            /*
                for(let key of formData.keys())
                console.log(`${key} => ${formData.get(key)}`);
            */
            



            
            console.log("*********************** Begin: Pagando ***********************" )
           try {
            respuesta = await fetch($formulario_pago.btn_confirmar.dataset.endpoint, {
                method: "POST",
                body: formData
            });

            json = await respuesta.json();
            console.log(respuesta);
            console.log(json);

            if(json.ok){
                resetearPagina();
                cargarDataAlumno(urlDataGeneral);
                alertaFacturacion("Se registro el pago correctamente", "success");
            }
            else
                alertaFacturacion(json.msg, "warning");

           } catch (error) {
               console.error('Error al realizar la peticion de pagar. ');
           }
           console.log("*********************** End: Pagando ***********************" )


            
        }
        pagar()
        
        //RefrescarCambios();
    }

    function onClickLimpiarFormulario(e) {
        resetearPagina(true);
    }

    function selectCronogramaPendiente(e) {
        e.stopPropagation()

        cargarConceptos();
        // Agregando configuracion al formulario 
        let option = document.createElement('option');
        let textoOption = document.createTextNode(`${this.dataset.concepto} (${this.dataset.monto})`);
        option.value = this.dataset.id;
        option.appendChild(textoOption);
        $formulario_pago.concepto_pago.prepend(option);

        $formulario_pago.concepto_pago.value = this.dataset.id;
        $formulario_pago.pago_monto.value = this.dataset.monto;
        $formulario_pago.cronograma_id.value = this.dataset.id;
        
    }

    /************************************************ End: Eventos ***********************************************/


    /************************************************ Begin: Peticiones ************************************************/
    async function cargarDataAlumno(url) {
        let temp= urlDataGeneral
        resetearPagina(true);
        urlDataGeneral = temp;

        try {
            // Realizando la peticion
            data = await fetch(url);
            console.log(data);

            json = await data.json();
            console.log(json);

            if(json.ok){
                // Activando botnoes
                disableStateForm(false);

                if (json.data.deudasPendientes.length>0) {
                    intervaloAlerta = setInterval(() => {
                        document.getElementById('btn-pagos-pendientes').classList.toggle('bg-warning');
                    }, 1000);
                    alertaFacturacion("El  alumno tiene deudas pendientes", "warning");
                }

                //Cargando la data del alumno
                $alumno.value = `${json.data.alumno.apellidos} ${json.data.alumno.nombres}`;
                $formulario_pago.matricula_id.value = json.data.matricula.matricula_id;

                cargarTableCronograma(json.data.cronograma);
                cargarTableOtrosPagos(json.data.otrosPagos);
                
                //**************************  Si tiene deudas antiguas ***************************** */
                if(json.data.deudasPendientes.length!==0)
                    cargarTablePagosPendientes(json.data.deudasPendientes);
                else{
                    if (intervaloAlerta === null) {
                        clearInterval(intervaloAlerta);
                        intervaloAlerta = null;
                    }
                    document.getElementById('btn-pagos-pendientes').style.display =  'none';
                }
                conceptos = json.data.conceptosPago;
                cargarConceptos();

                document.getElementsByClassName('pagar-cronograma').forEach((element) => element.addEventListener('click', selectCronogramaPendiente, null))
            }
        } catch (error) {
            console.error('Error al realizar la peticion de obtener la data del alumno. ');
            console.error(error);
        }
    }
    /************************************************ End: Peticiones ************************************************/


    /************************************************ Begin: Helpers ************************************************/
    
    function cargarConceptos() {
        $formulario_pago.cronograma_id.value = '';
        let selectConceptos = "";
        conceptos.forEach((value) => {
            selectConceptos += `
            <option value="${value.id_conceptoPago}" data-monto='${value.monto}' > ${value.concepto_nombre} (${value.monto})  </option> `
        })
        $formulario_pago.concepto_pago.innerHTML = selectConceptos;
        
        //Cargando Monto
        formulario_pago.pago_monto.value = formulario_pago.concepto_pago.options[0].getAttribute('data-monto');
    }

    function cargarTableCronograma(cronograma){
        let tableCronograma = "";
        cronograma.forEach((value) => {
            tableCronograma += `
            <tr class="${value.MP_CRO_ESTADO=='PENDIENTE'? 'table-danger bg-hover-light pagar-cronograma':''}"  data-id="${value.id_cronograma}" data-monto="${value.MP_CRO_MONTO}" data-concepto="${value.MP_CON_CONCEPTO}"" >
            <td class='text-center text-capitalize' > ${value.MP_CON_CONCEPTO.toLowerCase()} </td>
            <td class='text-center text-capitalize' > ${value.MP_CRO_TIPODEUDA.toLowerCase()} </td>
            <td class='text-center text-capitalize' > ${value.MP_CRO_ESTADO.toLowerCase()} </td>
            <td class='text-center text-capitalize' > ${value.MP_CRO_MONTO.toLowerCase()} S/ </td>
            </tr>`
        })
        $cronograma_pagos.querySelector("tbody").innerHTML = tableCronograma == "" ? "<tr colspan='5' class='text-center'> No se encontro un cronograma de pagos </tr>" : tableCronograma;
    }

    function cargarTableOtrosPagos(otrosPagos){
        let tableOtrosPagos = "";
        otrosPagos.forEach((value) => {
            tableOtrosPagos += `
                <tr>
                <td class='text-center ' > ${value.MP_PAGO_NRO} </td>
                <td class='text-center text-capitalize' > ${value.MP_CON_CONCEPTO.toLowerCase()} </td>
                <td class='text-center' > ${value.MP_CONPAGO_MONTO} </td>
                <td class='text-center' > ${value.MP_PAGO_FECHA.substring(0,10)}</td>
                </tr>`
        })
        $otros_pagos.querySelector("tbody").innerHTML = tableOtrosPagos == "" ? "<tr> <td colspan='4' class='text-center'> No se encontro otros pagos para esta matricula </td> </tr>" : tableOtrosPagos;
    }

    function cargarTablePagosPendientes(deudasPendientes){
        let tableDeudasaPendientes="";
        deudasPendientes.forEach((value) => {
            tableDeudasaPendientes += `
            <tr class="table-danger bg-hover-light pagar-cronograma"  data-id="${value.MP_CRO_ID}" data-monto="${value.MP_CRO_MONTO}" data-concepto="${value.MP_CON_CONCEPTO}"" >
                <td class='text-center text-capitalize' > ${value.MP_CRO_TIPODEUDA.toLowerCase()} </td>
                <td class='text-center text-capitalize' > ${value.MP_CON_CONCEPTO.toLowerCase()} </td>
                <td class='text-center ' > ${value.MP_CRO_MONTO} S/ </td>
                <td class='text-center ' > ${value.MP_CRO_FECHAVEN.substring(0,10)} </td>
            </tr>`
        })
        $pagosPendientes.querySelector("tbody").innerHTML = tableDeudasaPendientes == "" ? "<tr> <td colspan='4' class='text-center'> No se encontro otros pagos para esta matricula </td> </tr>" : tableDeudasaPendientes;
    }


            /*
            function RefrescarCambios() {
            }
            */

    function resetearPagina(total = false) {

        let $tbody_cronograma = $cronograma_pagos.querySelector("tbody"),
            $tbody_otro = $otros_pagos.querySelector("tbody"),
            fecha = (new Date(Date.now())).toLocaleDateString().split('/');

        if (total) {
            $formulario_pago.concepto_pago.innerHTML = ' <option> - </option> ';
            $formulario_pago.pago_monto.value = 0;
            $alumno.value = '-';

            $tbody_cronograma.innerHTML = `<tr><td class="text-center" colspan="5">Introdusca los datos del alumno a buscar</td></tr>`;
            $tbody_otro.innerHTML = `<tr><td class="text-center" colspan="5">No se han encontró otros pagos para esta matricula</td></tr>`;

            $formulario_pago.matricula_id.value = '';

            disableStateForm();
            conceptos=null;
            urlDataGeneral=null;
        }

        //Reseteo pago
        $formulario_pago.tipo_pago.value = 1;
        $formulario_pago.pago_banco.value = 'BCP';
        $formulario_pago.numero_operacion.value = '';
        $formulario_pago.fecha_pago.value = `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
        $formulario_pago.fecha_operacion.value = '';
        $formulario_pago.tipo_comprobante.value = 2;
        
        if(conceptos){
            cargarConceptos();
            $formulario_pago.concepto_pago.selectedIndex=0;
            $formulario_pago.pago_monto.value=$formulario_pago.concepto_pago.options[0].dataset.monto;
        }

        // Formateando estilos
        document.querySelector('.pago_banco').style.display = 'none'
        $formulario_pago.concepto_pago.value = $formulario_pago.concepto_pago.options[0].value;
        $formulario_pago.pago_monto.value = formulario_pago.concepto_pago.options[0].getAttribute('data-monto');

        $('#cronograma_pagos').removeClass('d-none');
        $('#btn-cronograma').addClass("bg-white");
    }

    function disableStateForm(activo = true) {
        $formulario_pago.concepto_pago.disabled = activo;
        $formulario_pago.tipo_pago.disabled = activo;
        $formulario_pago.fecha_pago.disabled = activo;
        $formulario_pago.tipo_comprobante.disabled = activo;

        $formulario_pago.btn_confirmar.disabled = activo;
        $formulario_pago.btn_limpiar.disabled = activo;

        if (intervaloAlerta !== null) {
            clearInterval(intervaloAlerta);
            intervaloAlerta = null;
        }
        document.getElementById('btn-pagos-pendientes').style.display = (activo) ? 'none' : 'inline-block';
    }

    function alertaFacturacion(mensaje, classAlert="warning" ){

        let idAlerta=Math.round(Math.random()*200);

        $alertasDOM.innerHTML=`
        <div class="alert alert-${classAlert} alert-dismissible fade show" id="alerta_show-${idAlerta}" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" >
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            ${mensaje}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <>
        `;
        setInterval(()=>{
            let alerta = document.getElementById(`alerta_show-${idAlerta}`);
            if(alerta){
                let bsAlerta = new bootstrap.Alert(alerta);
                bsAlerta.close();
            }

        },7500)
    }

    // temporizador para alertas

    /************************************************ Begin: Helpers ************************************************/


    document.querySelectorAll("button").forEach(btn => btn.addEventListener('click', (e)=>{  e.target.disabled=true; setTimeout(()=>{ e.target.disabled=false },500)  }, false))

})