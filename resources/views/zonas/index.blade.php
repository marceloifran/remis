@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="alert alert-success text-center">
            <h2 class="h2">zonas</h2>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($zonas as $zona)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Destino: {{ $zona->nombre }}</h2>
                                    <h5 class="card-text">Zona: {{ $zona->zona }}</h5>
                                    <h5 class="card-text">Precio: ${{ $zona->precio }}</h5>
                                <div class="text-right">
                                    @can('eliminar-zonas')
                                    <form action="{{ route('zonas.destroy', $zona->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                @endcan
                                    @can('editar-zonas')
                                        <a class="btn btn-primary"
                                            href="{{ route('zonas.edit', $zona->id) }}">Editar</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center mb-4 fixed-bottom">
            <a href="{{ route('zonas.create') }}" class="btn btn-floating btn-lg btn-success" style="padding: 10px 16px; margin-right: 10px;"><i class="fas fa-plus"></i></a>
        </div>
    </section>
@endsection
