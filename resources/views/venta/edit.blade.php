@extends('layouts.admin')

@section('contenido')
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Venta</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('venta.update', $venta->id_venta) }}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_cliente">Cliente</label>
                        <select class="form-control" name="id_cliente" id="id_cliente">
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_persona }}" {{ $cliente->id_persona == $venta->id_cliente ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipo_comprobante">Tipo de Comprobante</label>
                        <input type="text" class="form-control" name="tipo_comprobante" id="tipo_comprobante" value="{{ $venta->tipo_comprobante }}" placeholder="Ingresa el tipo de comprobante">
                    </div>
                    <div class="form-group">
                        <label for="num_comprobante">Número de Comprobante</label>
                        <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" value="{{ $venta->num_comprobante }}" placeholder="Ingresa el número de comprobante">
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora">Fecha/Hora</label>
                        <input type="datetime-local" class="form-control" name="fecha_hora" id="fecha_hora" value="{{ date('Y-m-d\TH:i', strtotime($venta->fecha_hora)) }}" placeholder="Ingresa la fecha y hora">
                    </div>
                    <div class="form-group">
                        <label for="impuesto">Impuesto</label>
                        <input type="text" class="form-control" name="impuesto" id="impuesto" value="{{ $venta->impuesto }}" placeholder="Ingresa el impuesto">
                    </div>
                    <div class="form-group">
                        <label for="total_venta">Total Venta</label>
                        <input type="text" class="form-control" name="total_venta" id="total_venta" value="{{ $venta->total_venta }}" placeholder="Ingresa el total de la venta">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                    <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->
@endsection
