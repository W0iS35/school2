<div class="modal fade bd-modal-anio-academico   " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead">Crear nuevo año académico</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>

        <div class="modal-content p-3">

            <form action="{{ route('anio.store') }}" method="POST" class="row">
                @csrf
                <div class="col-md-5">
                    <hr>
                    <div class="p-2  pt-0">
                        <h3 class="lead">Nuevo año </h3>

                        <hr>
                        <div class="form-group  mt-0">
                            <label for="descripcion" class="">Descripcion:</label>
                            <textarea name="descripcion" id="descripcion" class="col-12 form-text" placeholder="2021"
                                required></textarea>
                        </div>

                        <div class="form-group  ">
                            <label for="nombre" class="col-md-4 text-right">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="col-md-7 text-right" placeholder="2021"
                                required>
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
                        </div>


                        <div class="form-group">
                            <label for="fechaFin" class="col-md-4 text-right">Fin:</label>
                            <input type="date" name="fechaFin" id="fechaFin" class="col-md-7" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 border border-2 border-left">
                    <hr>
                    <div class=" p-2 pt-0 bg-d ">
                        <h3 class="lead">Secciones</h3>
                        <hr>

                        <div class="form-group">
                            <label for="local">Local: </label>
                            <select class="select-secciones" id="localSeleccionado">
                                @foreach ($locales as $local)
                                <option value="{{$local->MP_LOC_ID}}">{{$local->MP_LOC_NOM}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="local">Nivel: </label>
                            <select class="select-secciones" id="nivelSeleccionado">
                                @foreach ($niveles as $nivel)
                                <option value="{{$nivel->MP_NIV_ID}}">{{$nivel->MP_NIV_NIVEL}}</option>
                                @endforeach
                            </select>
                        </div>

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
                                            <th>Nº</th>
                                            <th>Grado</th>
                                            <th>Seccion</th>
                                            <th>Vacantes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

                    <div class="text-right p-3 col-12">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
