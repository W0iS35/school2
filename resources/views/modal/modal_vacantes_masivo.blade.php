<div class="modal fade bd-modal-anio-academico   " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead">CREACION MASIVA DE SECCIONES</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>

        <div class="modal-content p-3">

            <form action="{{ route('vacantes.masivo') }}" method="POST" >
                @csrf
                <input type="hidden" name="id_anio" value="{{$anio->MP_ANIO_ID}}">
                
                <div class="col-12 border border-2 mx-auto border-left row">
                    <div class=" col-4 p-2 pt-0 bg-d ">
                        <h3 class="lead">Secciones</h3>
                        <hr>
                        <div class="row  ">
                            <label for="local" class="col-4 text-end">Local: </label>
                            <div class="col-8 text-start">
                                <select class="select-secciones col-8  text-start" id="localSeleccionado"  >
                                    @foreach ($locales as $local)
                                        <option option value="{{$local->MP_LOC_ID}}">{{$local->MP_LOC_NOM}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="form-group  row">
                            <label for="local" class="col-4 text-end    ">Nivel: </label>
                            <div class="col-8 text-start">
                                <select class="select-secciones col-8  text-start" id="nivelSeleccionado" class="col-8">
                                    @foreach ($niveles as $nivel)
                                    <option value="{{$nivel->MP_NIV_ID}}">{{$nivel->MP_NIV_NIVEL}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="border border-2 border-left ">
                            <div style="height: 40vh; overflow-x: scroll;" class="col-12">
                                @foreach ($locales as $local)
                                @foreach ($niveles as $nivel)
                                <table class="table table-sm  text-center mt-1 table-secciones d-none table-striped"
                                    id="table-secciones-{{$local->MP_LOC_ID}}-{{$nivel->MP_NIV_ID}}">
                                    <thead class="table-dark">
                                        <tr>
                                            <th colspan="4" class=" text-center text-uppercase">
                                                {{$nivel->MP_NIV_NIVEL}}:{{$local->MP_LOC_NOM}} </th>
                                        </tr>
                                        <tr>
                                            <th>N??</th>
                                            <th>Grado</th>
                                            <th>Seccion</th>
                                            <th>Vacantes</th>
                                        </tr>
                                    </thead>
                                    <tbody  >
                                        @foreach ($grados as $grado)
                                        @foreach ($secciones as $seccion)
                                        @if (!(($grado->MP_GRA_GRADO==6 && $nivel->MP_NIV_ID==2)||
                                        $seccion->MP_SEC_NOMBRE=="-" ))
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="cbxSecciones"
                                                    name="CODE{{$nivel->MP_NIV_ID}}C{{$local->MP_LOC_ID}}:{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}"
                                                    id="C{{$nivel->MP_NIV_ID}}{{$local->MP_LOC_ID}}{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}">
                                            </td>
                                            <td>{{$grado->MP_GRA_GRADO}}</td>
                                            <td>{{$seccion->MP_SEC_NOMBRE}}</td>
                                            <td><input type="number"
                                                    name="CODE{{$nivel->MP_NIV_ID}}V{{$local->MP_LOC_ID}}:{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}"
                                                    id="V{{$nivel->MP_NIV_ID}}{{$local->MP_LOC_ID}}{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}"
                                                    value="0" disabled>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                @endforeach

                                @endforeach

                            </div>


                        </div>
                    </div>

                    <div class="text-end p-3 col-12">
                        <button type="submit" class="btn btn-success ">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
