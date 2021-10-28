<div class="modal fade " id="modal-alerta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg bg-white border border-1 border-warning">
        <div class="modal-header">
            <h3 class="text-center p-1 lead text-uppercase">ALERTA</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-content p-3">
            <form action="" method="GET" id="modal-alert-target" class="row">

                @csrf
                <div class="col-md-11 mx-auto">
                    <span id="modal_alerta_mensaje"></span>
                </div>

                <div class="text-right p-3 col-12">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Aceptar
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
