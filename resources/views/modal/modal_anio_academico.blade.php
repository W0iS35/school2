<div class="modal fade bd-modal-anio-academico   " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead text-uppercase">NUEVO AñO ACADEMICO</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>

        <div class="modal-content p-3">

            <form action="{{ route('anio.store') }}" method="POST" class="row">
                @csrf
                <div class="col-md-8 mx-auto">
                    <hr>
                    <div class="p-2  pt-0">
                        <div class="form-group  ">
                            <label for="nombre" class="col-md-4 text-right">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="col-md-7 text-left" placeholder="Introduzca un año. ejem:2020,2021,2022,..." >
                            
                            @error('nombre')
                                <div class=" alert offset-md-4 col-md-7 "> 
                                    <strong class="alert-danger">* {{$message  }}</strong>
                                </div>
                            @enderror

                        </div>

                        <div class="form-group  mt-0">
                            <label for="descripcion" class="col-md-4 text-right">Descripcion:</label>
                            <textarea name="descripcion" id="descripcion" class="col-md-7 text-left" placeholder="Introduzca una descripcion del año"
                                required></textarea>
                                
                            @error('descripcion')
                                <div class=" alert offset-md-4 col-md-7 "> 
                                    <strong class="alert-danger">* {{$message  }}</strong>
                                </div>
                             @enderror
                        </div>

                        <div class="form-group  ">
                            <label for="estado" class="col-md-4 text-right">Estado:</label>
                            <select name="estado" class="col-md-7" id="estado">
                                <option value="VIGENTE">Vigente</option>
                                <option value="CONCLUIDO">Concluido</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="fechaInit" class="col-md-4 text-right">Inicio:</label>
                            <input type="date" name="fechaInit" id="fechaInit" class="col-md-7" required>
                            
                            @error('fechaInit')
                                <div class=" alert offset-md-4 col-md-7 "> 
                                    <strong class="alert-danger">* {{$message  }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fechaFin" class="col-md-4 text-right">Fin:</label>
                            <input type="date" name="fechaFin" id="fechaFin" class="col-md-7" required>
                            
                            @error('fechaFin')
                                <div class=" alert offset-md-4 col-md-7 "> 
                                    <strong class="alert-danger">* {{$message  }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right p-3 col-12">
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
