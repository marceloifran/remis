@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="alert alert-warning text-center">
            <h2 class="h2">Usuarios</h2>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($usuarios as $usuario)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Nombre: {{ $usuario->name }}</h5>
                                <p class="card-text">
                                    <strong>Email:</strong> {{ $usuario->email }}<br>
                                    <strong>Rol:</strong>
                                    @if (!empty($usuario->getRoleNames()))
                                        @foreach ($usuario->getRoleNames() as $rolNombre)
                                            <span class="badge badge-primary">{{ $rolNombre }}</span>
                                        @endforeach
                                    @endif
                               
                                <div class="text-right">
                                    @can('eliminar-usuarios')
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-info">Eliminar</button>
                                    </form>
                                @endcan

                                    @can('editar-usuarios')
                                        <a class="btn btn-warning"
                                            href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                                    @endcan
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center mb-4 fixed-bottom">
            <a href="{{ route('usuarios.create') }}" class="btn btn-floating btn-lg btn-warning" style="padding: 10px 16px; margin-right: 10px;"><i class="fas fa-plus"></i></a>
        </div>
    </section>
@endsection
