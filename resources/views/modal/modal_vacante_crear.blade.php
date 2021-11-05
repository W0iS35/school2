<div class="modal fade " id="modal-vacante-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead text-uppercase">Creacion de Secciones</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-content p-3">
            <form action="{{ route('vacantes.store') }}" method="POST" class="row">

                @csrf
                <div class="col-md-8 mx-auto">
                    <hr>
                    <div class="p-2  pt-0">

                        <input type="hidden" name="id_anio" value="{{$anio->MP_ANIO_ID}}">

                        <div class="form-group  ">
                            <label for="local_id" class=" col-md-4 text-end">Local:</label>
                            <select name="local_id" class="col-md-5" id="local_id " >
                                @foreach ($locales as $local)
                                <option value="{{$local->MP_LOC_ID}}">{{$local->MP_LOC_NOM}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="form-group ">
                            <label for="nivel_id" class="col-md-4  text-end">Nivel:</label>
                            <select name="nivel_id" id="nivel_id" class="col-md-5">
                                @foreach ($niveles as $nivel)
                                <option value="{{$nivel->MP_NIV_ID}}">{{$nivel->MP_NIV_NIVEL}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="form-group  ">
                            <label for="grado_id" class="col-md-4 text-end">Grado:</label>
                            <select name="grado_id" id="grado_id" class="col-md-5">
                                @foreach ($grados as $grado)
                                <option value="{{$grado->MP_GRA_ID}}">{{$grado->MP_GRA_GRADO}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="form-group ">
                            <label for="seccion" class="col-md-4 text-end">Seccion:</label>
                            <select name="seccion_id" id="seccion_id" class="col-md-5">
                                @foreach ($secciones as $seccion)
                                <option value="{{$seccion->MP_SEC_ID}}">{{$seccion->MP_SEC_NOMBRE}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="form-group ">
                            <label for="numero_vacantes" class="col-md-4 text-end">Numero de vacantes:</label>
                            <input type="number" id="numero_vacantes" name="numero_vacantes" class="col-md-5 text-start"
                                required>
                            @error('vacantes')
                            <div class=" alert offset-md-4 col-md-5 ">
                                <strong class="alert-danger">* {{$message  }}</strong>
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="text-end p-3 col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Guardar
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
