<div class="modal fade" id="modal-delete-{{ $detalle_venta->id_detalle_venta }}">
    <div class="modal-dialog">
        <form action="{{ route('detalle-venta.destroy', $detalle_venta->id_detalle_venta) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar detalle de venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Deseas eliminar el detalle de venta con el ID {{ $detalle_venta->id_detalle_venta }}?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
            <!--/.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!--/.modal -->
