
$( ()=>{
    
    
    /****************************  Begin: Load default  *******************************/
    let selectLocal = $("#LocalForm");
    let selectNivel = $("#nivelForm");
    let tabla = $("#tableFom");
 
    
    selectLocal.change(onChangeSelect);
    selectNivel.change(onChangeSelect);
    
    

    /****************************  End: Load default  *******************************/
    

    /****************************  Begin: Lanzador de modales  *******************************/
    $("#btn-conceptos").on("click", ()=>{
        $("#modal-conceptos-index").modal("show");
    })
   /****************************  End: Lanzador de modales  *******************************/




     function  onChangeSelect (e){
        url = `${tabla.attr("data-origin")}/${selectLocal.val()}/${selectNivel.val()}`;
        cargarData(url);
    }

   /****************************  Begin: peticiones FETCH  *******************************/
   
   cargarData =  async (url)=>{
       response = await fetch(url,{
           "method":"GET",
           "headers":{
               "Accept":'application/json',
               "Content-type":'application/json',
            }
        });
        data =  await response.json();

        let grados = new Map();
        grados.set("1","Primero");
        grados.set("2","Segundo");
        grados.set("3","Tercero");
        grados.set("4","Cuarto");
        grados.set("5","Quinto");
        grados.set("6","Sexto");
        
        let tbody = $("#tbody_vacantes");
        
        let mostrar = '';
        try {
            mostrar = filasShow(data)
        } catch (error) {
            mostrar = ''
            mostrar = filasShow(Object.entries(data).map(([key,val])=>val));
        }
        mostrar = (mostrar=='')? "<tr class='text-center'><td colspan='5'>No se encontro registros </td></tr>":mostrar;
        tbody.html(mostrar);
        
        function filasShow (datos){
            let filas = '';
            datos.forEach((value, index) => {
                filas+= `<tr> 
                <td class='text-center'> ${(index+1)}</td>
                <td class='text-center'> ${grados.get(value.MP_GRAD_ID)}</td>
                <td class='text-center'> ${String.fromCharCode(64+parseInt(value.MP_SEC_ID))}</td>
                <td class='text-center'> ${value.MP_VAC_DISP}</td>
                <td class='text-center'> ${value.MP_VAC_OCU}</td>
                </tr>`
            });
            return filas;
        }
    }
    /****************************  End: peticiones FETCH  *******************************/
    


    
    url = `${tabla.attr("data-origin")}/1/1`;
    cargarData(url);
})