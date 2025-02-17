@extends('layouts.admin')

@section('contenido')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTADO DE VENTAS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Ventas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Hoverable rows start -->
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-xl-12">
                            <form action="{{ route('venta.index') }}" method="get">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                            <input type="text" class="form-control" name="texto" placeholder="Buscar ventas" value="" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-plus-circle-fill"></i></span>
                                            <a href="{{ route('venta.create') }}" class="btn btn-success">Nuevo</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Número Comprobante</th>
                                    <th>Fecha/Hora</th>
                                    <th>Impuesto</th>
                                    <th>Total Venta</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>
                                            <a href="{{ route('venta.edit', $venta->id_venta) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <!-- Button trigger for danger theme modal -->
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $venta->id_venta }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <td>{{ $venta->id_venta }}</td>
                                        <td>{{ $venta->id_cliente }}</td>
                                        <td>{{ $venta->tipo_comprobante }}</td>
                                        <td>{{ $venta->num_comprobante }}</td>
                                        <td>{{ $venta->fecha_hora }}</td>
                                        <td>{{ $venta->impuesto }}</td>
                                        <td>{{ $venta->total_venta }}</td>
                                        <td>{{ $venta->estado }}</td>
                                    </tr>
                                    @include('venta.modal')
                                @endforeach
                                </tbody>
                            </table>
                            {{ $ventas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->

@endsection
