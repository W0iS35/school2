<form>
    <div class="form-group text-center">
        <label for="pago_tipo_seleccion">Seleccionar por</label>
        <select name="pago_tipo_seleccion" id="pago_tipo_seleccion">
            <option value="1">Dia en especifico</option>    
            <option value="2">Rango de fecha</option>    
        </select> 
    </div>
    <br>
    <div class="d-flex justify-content-around">
        <div class="form-group">
            <label for="fecha_inicio" >Del</label>
            <input type="date" name="fecha_inicio"  id="fecha_inicio">
        </div>
        <div class="form-group">
            <label for="fecha_fin"> al </label>
            <input type="date" name="fecha_fin" id="fecha_fin">
        </div>
    </div>

</form>
<!-- End: Formulario de busqueda de resumen -->