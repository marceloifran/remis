@extends('layouts.app')

@section('content')
<section class="section" style="margin: 20px">
    <div class="section-header alert alert-success">
        <h3 class="text-center page__heading h2">Alta de Viaje</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('viajes.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div style="display: none" class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input id="fecha" type="date" name="fecha" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6" style="display: none">
                                    <div class="form-group">
                                        <label for="hora">Hora</label>
                                        <input id="hora" type="time" name="hora" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="desde">Desde</label>
                                <select id="desde" name="desde" class="form-control">
                                    <option value="" selected>Seleccione el lugar de partida</option>
                                    @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                                    @endforeach
                                </select>
                                <button id="botonDesde" type="button" class="btn btn-primary" onclick="agregarPrecio('desde')">
                                    <i class="fas fa-money-bill"></i>
                                </button>
                            </div>
                            
                            <div class="mb-3">
                                <label for="hasta">Hasta</label>
                                <select id="hasta" name="hasta" class="form-control">
                                    <option value="" selected>Seleccione el lugar de destino</option>
                                    @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                                    @endforeach
                                </select>
                                <button id="botonHasta" type="button" class="btn btn-primary" onclick="agregarPrecio('hasta')">
                                    <i class="fas fa-money-bill"></i>
                                </button>
                            </div>

                            @foreach($extras as $extra)
                            <div class="mb-3">
                                <label for="extra{{ $extra->id }}">{{ ucfirst($extra->nombre) }} (${{ $extra->precio }}):</label>
                                <div class="input-group">
                                    <button class="btn btn-success" type="button" onclick="sumarExtra('extra{{ $extra->id }}', {{ $extra->precio }})">
                                        +
                                    </button>
                                    <input type="text" class="form-control input-sm small-input" id="extra{{ $extra->id }}" value="0" readonly />
                                    <button class="btn btn-danger" type="button" onclick="restarExtra('extra{{ $extra->id }}', {{ $extra->precio }})">
                                        -
                                    </button>
                                </div>
                            </div>
                            @endforeach

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="usuario">Chofer</label>
                                        <select id="user_id" name="user_id" class="form-control" required>
                                            <option disabled selected value="">Seleccione el Chofer a cargo</option>
                                            @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="metodoPago">Método de pago</label>
                                        <select id="metodoPago" name="metodoPago" class="form-control" required>
                                            <option value="" disabled selected>Seleccione un método de pago</option>
                                            <option value="transferencia">Transferencia</option>
                                            <option value="efectivo">Efectivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="totalPagar">Total a pagar</label>
                                    <input id="totalPagar" type="number" step="0.01" name="totalPagar" class="form-control" readonly>
                                </div>
                            </div>

                            <div style="margin: 10px;" class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
// Obtener la fecha y hora actual
var now = new Date();
var fecha = now.toISOString().split('T')[0];
document.getElementById('fecha').value = fecha;
var hora = now.toTimeString().split(' ')[0].substring(0, 5);
document.getElementById('hora').value = hora;

// Variables globales para almacenar precios base y extras
var precioDesde = 0;
var precioHasta = 0;
var sumaExtras = {};

// Funciones para actualizar los precios base al hacer clic en el botón
function agregarPrecio(tipo) {
    var zonaSeleccionada = document.getElementById(tipo).value;
    if (zonaSeleccionada) {
        obtenerPrecioZona(zonaSeleccionada, tipo);
    }
}

function obtenerPrecioZona(zonaSeleccionada, tipo) {
    axios.get('/api/zonas/' + zonaSeleccionada)
        .then(response => {
            var precio = response.data.precio;
            if (tipo === 'desde') {
                precioDesde = precio;
            } else if (tipo === 'hasta') {
                precioHasta = precio;
            }
            actualizarTotalPagar();
        })
        .catch(error => {
            console.error('Error al obtener el precio de la zona:', error);
        });
}

// Funciones para sumar y restar extras
function sumarExtra(idExtra, precioExtra) {
    var inputExtra = document.getElementById(idExtra);
    var valorActual = parseInt(inputExtra.value);
    valorActual++;
    inputExtra.value = valorActual;

    if (!sumaExtras[idExtra]) {
        sumaExtras[idExtra] = 0;
    }
    sumaExtras[idExtra] += precioExtra;

    actualizarTotalPagar();
}

function restarExtra(idExtra, precioExtra) {
    var inputExtra = document.getElementById(idExtra);
    var valorActual = parseInt(inputExtra.value);
    if (valorActual > 0) {
        valorActual--;
        inputExtra.value = valorActual;

        sumaExtras[idExtra] -= precioExtra;

        actualizarTotalPagar();
    }
}

// Función para actualizar el total a pagar
function actualizarTotalPagar() {
    var totalExtras = Object.values(sumaExtras).reduce((a, b) => a + b, 0);
    var totalPagar = precioDesde + precioHasta + totalExtras;
    document.getElementById("totalPagar").value = totalPagar.toFixed(2);
}

// Inicializar la suma de extras
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fecha').addEventListener('input', actualizarTotalPagar);
    document.getElementById('hora').addEventListener('input', actualizarTotalPagar);
});
</script>
@endsection
