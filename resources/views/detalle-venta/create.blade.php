@extends('layouts.admin')

@section('contenido')
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Nuevo Detalle de Venta</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('detalle-venta.store') }}" method="POST" class="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_venta">ID de Venta</label>
                        <select class="form-control" name="id_venta" id="id_venta">
                            <!-- Itera sobre las ventas disponibles -->
                            @foreach($ventas as $venta)
                                <option value="{{ $venta->id_venta }}">{{ $venta->num_comprobante }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_producto">ID de Producto</label>
                        <select class="form-control" name="id_producto" id="id_producto">
                            <!-- Itera sobre los productos disponibles -->
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Ingresa la cantidad">
                    </div>
                    <div class="form-group">
                        <label for="precio_venta">Precio de Venta</label>
                        <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Ingresa el precio de venta">
                    </div>
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input type="text" class="form-control" name="descuento" id="descuento" placeholder="Ingresa el descuento">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                    <a href="{{ route('detalle-venta.index') }}" class="btn btn-danger me-1 mb-1">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->
@endsection


