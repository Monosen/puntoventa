@extends('layouts.admin')
@section('contenido')
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Persona {{ $persona->nombre }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('persona.update', $persona->id_persona) }}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="tipo_persona">Tipo de persona</label>
                        <input type="text" class="form-control" name="tipo_persona" id="tipo_persona" value="{{ $persona->tipo_persona }}" placeholder="Ingresa el tipo de persona">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $persona->nombre }}" placeholder="Ingresa el nombre">
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de documento</label>
                        <input type="text" class="form-control" name="tipo_documento" id="tipo_documento" value="{{ $persona->tipo_documento }}" placeholder="Ingresa el tipo de documento">
                    </div>
                    <div class="form-group">
                        <label for="num_documento">Número de documento</label>
                        <input type="text" class="form-control" name="num_documento" id="num_documento" value="{{ $persona->num_documento }}" placeholder="Ingresa el número de documento">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $persona->direccion }}" placeholder="Ingresa la dirección">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $persona->telefono }}" placeholder="Ingresa el teléfono">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $persona->email }}" placeholder="Ingresa el email">
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
