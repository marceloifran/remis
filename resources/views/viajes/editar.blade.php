@extends('layouts.app')

@section('content')
<section class="section" style="margin: 20px">
    <div class="section-header alert alert-success">
        <h3 class="page__heading h2 text-center">Editar Viaje</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Formulario de edición -->
                        <form action="{{ route('viajes.update', $viaje->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Campos del formulario -->
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input id="fecha" type="date" name="fecha" class="form-control" value="{{ $viaje->fecha }}" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input id="hora" type="time" name="hora" class="form-control" value="{{ $viaje->hora }}" required>
                            </div>
                            <div class="form-group">
                                <label for="desde">Desde</label>
                                <select id="desde" name="desde" class="form-control" required>
                                    <option value="" disabled>Seleccione el lugar de partida</option>
                                    @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}" {{ $viaje->desde == $zona->id ? 'selected' : '' }}>{{ $zona->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="hasta">Hasta</label>
                                <select id="hasta" name="hasta" class="form-control" required>
                                    <option value="" disabled>Seleccione el lugar de destino</option>
                                    @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}" {{ $viaje->hasta == $zona->id ? 'selected' : '' }}>{{ $zona->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id">Chofer</label>
                                <select id="user_id" name="user_id" class="form-control" required>
                                    <option value="" disabled>Seleccione el Chofer a cargo</option>
                                    @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ $viaje->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="metodoPago">Método de pago</label>
                                <select id="metodoPago" name="metodoPago" class="form-control" required>
                                    <option value="" disabled>Seleccione un método de pago</option>
                                    <option value="transferencia" {{ $viaje->metodoPago == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                    <option value="efectivo" {{ $viaje->metodoPago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="totalPagar">Total a pagar</label>
                                <input id="totalPagar" type="number" step="0.01" name="totalPagar" class="form-control" value="{{ $viaje->totalPagar }}" required>
                            </div>
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
