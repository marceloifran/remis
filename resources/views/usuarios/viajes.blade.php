@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="section-header">
            <h3 class="page__heading">Viajes de Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach($usuarios as $usuario)
                                <div class="mb-3">
                                    <h5>{{ $usuario->name }}</h5>
                                    <ul>
                                        @foreach($usuario->viajes as $viaje)
                                            <li>{{ $viaje->nombre }} - {{ $viaje->precio }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
