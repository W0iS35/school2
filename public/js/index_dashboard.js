

$( ()=>{
   // alert('Hello wprd');

    let selectLocal = $("#LocalForm");
    let selectNivel = $("#nivelForm");
    let tabla = $("#tableFom");
    let tbody  = $("#tbody_vacantes");

    selectLocal.change(onChangeSelect);
    selectNivel.change(onChangeSelect);

     function  onChangeSelect (e){
        url = `${tabla.attr("data-origin")}/${selectLocal.val()}/${selectNivel.val()}`;
        //alert(url);
        data = Array.from(getData(url));
        //console.log(datos);MP_VACANTES
    
        let grados = new Map();
        grados.set("1","Primero");
        grados.set("2","Segundo");
        grados.set("3","Tercero");
        grados.set("4","Cuarto");
        grados.set("5","Quinto");
        grados.set("6","Sexto");

        filas='<h1> AAAAAAAA</h1>';

        console.log(data);

        data[0].forEach((valu) => {
            alert("ssssssss")
        })
        tbody.prepend(filas);
    }

    /** peticiones FETCH */

    getData =  async (url)=>{
        response = await fetch(url,{
            "method":"GET",
            "headers":{
                "Accept":'application/json',
                "Content-type":'application/json',
            }
        });
        data = await response.json();
        console.log(data);
        return data;
    }


    
})