<div class="modal fade " id="modal-conceptos-create" tabindex="-1"  role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead text-uppercase">Nuevo concepto de pago</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>

        <div class="modal-content p-3">
            <form action="{{ route('concepto.store') }}" method="POST"  class="row">

                @csrf
                <div class="col-md-8 mx-auto ">
                    <hr>
                    <div class="p-2  pt-0">
                        <input type="hidden" name="id_anio" value="{{$anio->MP_ANIO_ID}}">
                        
                        <div class="form-group ">
                            <label for="concepto" class="col-md-4 text-right">Concepto:</label>
                            <select name="concepto" id="concepto" class="col-md-6">
                                @foreach ($conceptos as $concepto)
                                    <option value="{{$concepto->MP_CON_ID}}">{{$concepto->MP_CON_CONCEPTO}}</option>
                                @endforeach
                            </select>
                        </div>

                        <br>
                        <div class="form-group ">
                            <label for="nivel" class="col-md-4 text-right">Nivel:</label>
                            <select name="nivel" id="nivel" class="col-md-6" >
                                <option value="PRIMARIA">PRIMARIA</option>
                                <option value="SECUNDARIA">SECUNDARIA</option>
                                <option value="0"> GENERAL </option>
                            </select>
                        </div>
                        <br>

                        
                        <div class="form-group ">
                            <label for="local" class="col-md-4 text-right">Local:</label>
                            <select name="local" id="local" class="col-md-6" >
                                <option value="1">Principal</option>
                                <option value="2">Anexo</option>
                                <option value="3">Polidocencia Proceres</option>
                                <option value="4">Polidocencia san martin</option>
                                <option value="0">General</option>
                            </select>
                        </div>
                        <br>
                        
                        <!-- 
                        <div class="form-group ">
                            <label for="fecha_vencimiento" class="col-md-4 text-right">Vencimiento:</label>
                            <input type="date" name="fecha_vencimiento" class="col-md-6" id="fecha_vencimiento" required>
                            
                            @error('fecha_vencimiento')
                                <div class=" alert offset-md-4 col-md-6 "> 
                                    <strong class="alert-danger">* {{$message  }}</strong>
                                </div>
                            @enderror  
                        </div>
                        <br>
                        -->


                        <div class="form-group ">
                            <label for="monto" class="col-md-4 text-right ">Monto: </label>
                            <input type="number" id="monto" name="monto" class="col-md-6 text-left"  required>
             
                            @error('monto')
                                <div class=" alert offset-md-4 col-md-6 "> 
                                    <strong class="alert-danger">* {{$message  }}</strong>
                                </div>
                            @enderror  
                        </div>
                    </div>
                    <br>
                    <br>
                </div>

                <div class="col-12 text-end ">
                    <span class="text-danger">
                        Nota: Solo se creara el nuevo concepto de pago si no se encuentra registrado en el a??o
                    </span>
                </div>
                <div class="text-end p-3 col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
