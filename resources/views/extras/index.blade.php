@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="text-center alert alert-success">
            <h2 class="h2">zonas</h2>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($extras as $extra)
                    <div class="mb-4 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Extra: {{ $extra->nombre }}</h2>
                                    <h5 class="card-text">Precio: ${{ $extra->precio }}</h5>
                                <div class="text-right">
                                    @can('eliminar-extras')
                                    <form action="{{ route('extras.destroy', $extra->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                @endcan
                                    @can('editar-extras')
                                        <a class="btn btn-primary"
                                            href="{{ route('extras.edit', $extra->id) }}">Editar</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-4 d-flex justify-content-center fixed-bottom">
            <a href="{{ route('extras.create') }}" class="btn btn-floating btn-lg btn-success" style="padding: 10px 16px; margin-right: 10px;"><i class="fas fa-plus"></i></a>
        </div>
    </section>
@endsection
