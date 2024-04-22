@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="alert alert-success text-center">
            <h2 class="h2">Lista de Viajes</h2>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($viajes as $viaje)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Usuario: {{ $viaje->user->name }}</h5>
                                <p class="card-text">
                                    <strong>Fecha y Hora:</strong> {{ $viaje->fecha }} {{ $viaje->hora }}<br>
                                    <strong>Desde:</strong> {{ $viaje->zonaDesde->nombre }}<br>
                                    <strong>Hasta:</strong> {{ $viaje->zonaHasta->nombre }}<br>
                                    <strong>Monto total a pagar:</strong> ${{ number_format($viaje->totalPagar, 2) }}<br>
                                    <strong>Método de pago:</strong> {{ ucfirst($viaje->metodoPago) }}<br>
                                </p>
                                <div class="text-right">
                                    @can('eliminar-viajes')
                                    <form action="{{ route('viajes.destroy', $viaje->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-info">Eliminar</button>
                                    </form>
                                @endcan
                                
                                    @can('editar-viajes')
                                        <a class="btn btn-warning" href="{{ route('viajes.edit', $viaje->id) }}">Editar</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center mb-4 fixed-bottom">
            <a href="{{ route('viajes.create') }}" class="btn btn-floating btn-lg btn-warning" style="padding: 10px 16px; margin-right: 10px;"><i class="fas fa-plus"></i></a>
        </div>
    </section>
    <script>
        
    </script>
@endsection
