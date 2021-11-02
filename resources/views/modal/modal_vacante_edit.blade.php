<div class="modal fade " id="modal-vacante-edit" tabindex="-1"  role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead text-uppercase"> Actualizando Vacantes</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>

        <div class="modal-content p-3">
            <form action="{{ route('vacantes.update') }}" method="POST"  class="row">
                @method('put')
                @csrf
                <div class="col-md-8 mx-auto">
                    <hr>
                    <div class="p-2  pt-0">

                        <input type="hidden" value="" id="id_vac" name="id_vac">

                        <div class="form-group ">
                            <label for="local" class="col-md-4 text-right">Local:</label>
                            <input type="text" id="modal-vacante-local" class="col-md-7 text-left" readonly disabled>
                        </div>

                        
                        <div class="form-group ">
                            <label for="nivel" class="col-md-4 text-right">Nivel:</label>
                            <input type="text" id="modal-vacante-nivel" class="col-md-7 text-left" readonly disabled>
                        </div>

                        <div class="form-group  ">
                            <label for="grado" class="col-md-4 text-right">Grado:</label>
                            <input type="text" id="modal-vacante-grado" class="col-md-7 text-left" readonly disabled>
                        </div>

                        <div class="form-group ">
                            <label for="seccion" class="col-md-4 text-right">Seccion:</label>
                            <input type="text" id="modal-vacante-seccion" class="col-md-7 text-left" readonly disabled>
                        </div>

                        <div class="form-group ">
                            <label for="num_vacantes" class="col-md-4 text-right">Numero de vacantes:</label>
                            <input type="number" id="num_vacantes" name="vacantes" class="col-md-7 text-left"  required>
             
                            @error('vacantes')
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
