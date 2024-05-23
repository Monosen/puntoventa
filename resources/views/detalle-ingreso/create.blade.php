@extends('layouts.admin')

@section('contenido')
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Crear Nuevo Detalle de Ingreso</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('detalle-ingreso.store') }}" method="POST" class="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_ingreso">Ingreso</label>
                        <select class="form-control" name="id_ingreso" id="id_ingreso">
                            @foreach($ingresos as $ingreso)
                                <option value="{{ $ingreso->id_ingreso }}">{{ $ingreso->num_comprobante }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_producto">Producto</label>
                        <select class="form-control" name="id_producto" id="id_producto">
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
                        <label for="precio_compra">Precio de Compra</label>
                        <input type="text" class="form-control" name="precio_compra" id="precio_compra" placeholder="Ingresa el precio de compra">
                    </div>
                    <div class="form-group">
                        <label for="precio_venta">Precio de Venta</label>
                        <input type="text" class="form-control" name="precio_venta" id="precio_venta" placeholder="Ingresa el precio de venta">
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
