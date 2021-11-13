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

                        <input type="text" name="local_id" id="local_id_hidden" value="1">

                        <div class="form-group row  ">
                            <label for="local_id" class=" col-md-4 text-end">Local:</label>

                            <div class="cajaselect col-md-8">
                                <span class="seleccionado" id="txt_local_nombre">Principal</span>
                                <ul class="listaselect">
                                    @foreach ($locales as $local)
                                    <li  data-name="{{$local->MP_LOC_NOM}}">
                                        <a href="#" >
                                        <div class="row">
                                            <div class="col-6 " style="text-align: left; padding-left: 2em;"
                                             id="{{$local->MP_LOC_ID}}" 
                                             data_nombre="{{$local->MP_LOC_NOM}}">
                                             {{$local->MP_LOC_NOM}} 
                                            </div>
                                            <div class="col-6 text-right text-muted" style="text-align: right; padding-right: 2em;">({{$local->MP_LOC_DIR}})</div>
                                        </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <span class="trianguloinf" style="color: black"></span>
                            </div>
                        </div>
                        <br>

                        <div class="form-group ">
                            <label for="nivel_id" class="col-md-4  text-end">Nivel:</label>
                            <select name="nivel_id" id="nivel_id" class="col-md-5">
                                @foreach ($niveles as $nivel)
                                <option value="{{$nivel->MP_NIV_ID}}">
                                    <div class="col-6 text-center bg-danger">{{$nivel->MP_NIV_NIVEL}}</div>
                                </option>
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

<style>
.cajaselect {
  background: none repeat scroll 0 0 #fff;
  border-radius: 5px 5px 0 0;
  border: 1px solid black;
  cursor: pointer;
  position: relative;
  padding: 0;
  z-index: 1;
  height: 20px;
}
ul.listaselect {
  background: none repeat scroll 0 0 #fff;
  border: 1px solid #dedede;
  display: none;
  left: -1px;
  margin-left: 0;
  margin-top: 25px;
  padding-left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
ul.listaselect li {
  border-bottom: 1px solid #efefef;
  cursor: pointer;
  display: block;
  list-style: outside none none;
  margin: 0;
}
ul.listaselect li a {
  color: #333;
  text-decoration: none;
}
ul.listaselect li a:hover {
  color: #999797;
  text-decoration: none;
}
ul.SelectProductos li:last-child {
  border-bottom: medium none;
}
.seleccionado {
  color: black;
  display: block;
  text-indent: 10px;
}
.trianguloinf {
  border-left: 9px solid rgba(0, 0, 0, 0);
  border-right: 9px solid rgba(0, 0, 0, 0);
  border-top: 13px solid #ccc;
  height: 0;
  position: absolute;
  color: black;
  right: 10px;
  top: 2px;
  width: 0;
}
.triangulosup {
  border-bottom: 13px solid #ccc;
  border-left: 9px solid rgba(0, 0, 0, 0);
  border-right: 9px solid rgba(0, 0, 0, 0);
  height: 0;
  position: absolute;
  right: 10px;
  top: 2px;
  width: 0;
}


</style>

