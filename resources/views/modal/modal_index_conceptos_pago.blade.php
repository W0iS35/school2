<div class="modal fade " id="modal-conceptos-index" tabindex="-1"  role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white">
        <div class="modal-header">
            <h3 class="text-center p-1 lead text-uppercase"> Conceptos de pago para el año {{$anioActual->MP_ANIO_NOMBRE}} </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-content p-3">
            <table class="table table-sm table-light table-striped text-center " >
                <thead class="table-success">
                    <tr>
                        <th colspan="6" class="text-center text-uppercase">Conceptos de pago</th>
                    </tr>
                    <tr>
                        <th class="">Nº</th>
                        <th class="">Codigo</th>
                        <th class="">Tipo Concepto</th>
                        <th class="">Monto</th>
                        <th class="">Nivel</th>
                        <th class="">Local</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php $n = 1; ?>
                    @foreach ($conceptosPago as $concepto)
                    <tr>
                        <td class="text-lowercase  ">{{$n++}}</td>
                        <td class="text-lowercase ">{{$concepto->MP_CONPAGO_ID}}</td>
                        <td class="text-capitalize text-start">{{Str::lower($concepto->concepto->MP_CON_CONCEPTO)}}</td>
                        <td class="text-lowercase ">{{$concepto->MP_CONPAGO_MONTO}}</td>
                        <td class="text-capitalize ">{{Str::lower($concepto->nivel?$concepto->nivel->MP_NIV_NIVEL:"-")}}</td>
                        <td class="text-lowercase ">{{$concepto->local? $concepto->local->MP_LOC_NOM:"-"}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
