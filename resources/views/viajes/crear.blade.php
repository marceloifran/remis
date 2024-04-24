@extends('layouts.app')

@section('content')
<section class="section" style="margin: 20px">
    <div class="section-header alert alert-success">
        <h3 class="page__heading h2 text-center">Alta de Viaje</h3>
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
                                        <input  id="fecha" type="date" name="fecha" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div  class="col-xs-12 col-sm-12 col-md-6">
                                    <div style="display: none" class="form-group">
                                        <label for="hora">Hora</label>
                                        <input  id="hora" type="time" name="hora" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="desde">Desde</label>
                                <select id="desde" name="desde" class="form-control" >
                                    <option value=""  selected>Seleccione el lugar de partida</option>
                                    @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                                    @endforeach
                                </select>
                                <button id="botonDesde" type="button" class="btn btn-primary" onclick="agregarPrecio('desde')">
                                    <i class="fas fa-money-bill"></i> <!-- Icono de dinero -->
                                </button>
                            </div>
                            
                            <div class="mb-3">
                                <label for="hasta">Hasta</label>
                                <select id="hasta" name="hasta" class="form-control" >
                                    <option value=""  selected>Seleccione el lugar de destino</option>
                                    @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                                    @endforeach
                                </select>
                                <button id="botonHasta" type="button" class="btn btn-primary" onclick="agregarPrecio('hasta')">
                                    <i class="fas fa-money-bill"></i> <!-- Icono de dinero -->
                                </button>
                            </div>
                            <div class="mb-3">
                                <label for="paradasModal">Paradas:</label>
                                <div class="input-group">
                                    <button class="btn btn-success" type="button" onclick="sumarParadas()">
                                        +
                                    </button>
                                    <input type="text" class="form-control input-sm small-input" id="paradasModal" value="0" readonly />
                                    <button class="btn btn-danger" type="button" onclick="restarParadas()">
                                        -
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="desvio1Modal">Desvío 1 ($200):</label>
                                <div class="input-group">
                                    <button class="btn btn-success" type="button" onclick="sumarDesvio('desvio1Modal', 200)">
                                        +
                                    </button>
                                    <input type="text" class="form-control input-sm small-input" id="desvio1Modal" value="0" readonly />
                                    <button class="btn btn-danger" type="button" onclick="restarDesvio('desvio1Modal', 200)">
                                        -
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="desvio2Modal">Desvío 2 ($250):</label>
                                <div class="input-group">
                                    <button class="btn btn-success" type="button" onclick="sumarDesvio('desvio2Modal', 250)">
                                        +
                                    </button>
                                    <input type="text" class="form-control input-sm small-input" id="desvio2Modal" value="0" readonly />
                                    <button class="btn btn-danger" type="button" onclick="restarDesvio('desvio2Modal', 250)">
                                        -
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="desvio3Modal">Desvío 3 ($300):</label>
                                <div class="input-group">
                                    <button class="btn btn-success" type="button" onclick="sumarDesvio('desvio3Modal', 300)">
                                        +
                                    </button>
                                    <input type="text" class="form-control input-sm small-input" id="desvio3Modal" value="0" readonly />
                                    <button class="btn btn-danger" type="button" onclick="restarDesvio('desvio3Modal', 300)">
                                        -
                                    </button>
                                </div>
                            </div>
                         
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="usuario">Chofer</label>
                                        <select id="user_id"
                                            class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal text-black-800 border border-gray-200 rounded"
                                            name="user_id" style="width: 100%" required>
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
                                    <input id="totalPagar" type="number" step="0.01" name="totalPagar"
                                        class="form-control" readonly>
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

// Formatear la fecha como YYYY-MM-DD para el campo de fecha
var fecha = now.toISOString().split('T')[0];
document.getElementById('fecha').value = fecha;

// Formatear la hora como HH:mm para el campo de hora
var hora = now.toTimeString().split(' ')[0].substring(0, 5); // Tomar solo los primeros 5 caracteres (HH:mm)
document.getElementById('hora').value = hora;


    // Calcular el total a pagar
    function calcularTotalPagar() {
        var precioDesde = obtenerPrecioZona(document.getElementById('desde').value);
        var precioHasta = obtenerPrecioZona(document.getElementById('hasta').value);
        var totalPagarInput = document.getElementById('totalPagar');

        if (precioDesde && precioHasta) {
            var totalPagar = precioDesde + precioHasta;
            totalPagarInput.value = totalPagar.toFixed(2); // Ajustar el total a dos decimales
        } else {
            // Si no se puede obtener alguno de los precios, mostrar un mensaje de error
            totalPagarInput.value = "Error: Precio no disponible";
        }
    }

    // Llamar a la función para calcular el total a pagar cuando se cambie el lugar de partida o de destino
    document.getElementById('desde').addEventListener('change', function () {
        calcularTotalPagar();
    });

    document.getElementById('hasta').addEventListener('change', function () {
        calcularTotalPagar();
    });

    // Función para obtener el precio de la zona seleccionada mediante una llamada AJAX
    function obtenerPrecioZona(zonaSeleccionada) {
        console.log('Obteniendo precio de la zona ' + zonaSeleccionada + '...');
        return axios.get('/api/zonas/' + zonaSeleccionada)
            .then(function (response) {
                var precio = response.data.precio;
                console.log('Precio de la zona ' + zonaSeleccionada + ': ' + precio);
                return precio;
            })
            .catch(function (error) {
                console.error('Error al obtener el precio de la zona ' + zonaSeleccionada + ':', error);
                return null;
            });
    }
    function agregarPrecio(tipo) {
    var zonaSeleccionada = document.getElementById(tipo).value;
    obtenerPrecioZona(zonaSeleccionada)
        .then(function(precioZona) {
            var totalPagarInput = document.getElementById('totalPagar');
            var botonAgregar = document.getElementById('boton' + tipo.charAt(0).toUpperCase() + tipo.slice(1));
            var botonOtro = document.getElementById('boton' + (tipo === 'desde' ? 'hasta' : 'desde'));

            if (precioZona !== null && !isNaN(precioZona)) {
                var precioActual = parseFloat(totalPagarInput.value) || 0;
                totalPagarInput.value = (precioActual + parseFloat(precioZona)).toFixed(2);

                // Deshabilitar el botón de agregar si ya se agregó desde o hasta
                var desdeSeleccionado = document.getElementById('desde').value !== '';
                var hastaSeleccionado = document.getElementById('hasta').value !== '';
                if (desdeSeleccionado && hastaSeleccionado) {
                    botonAgregar.disabled = true;
                }

                // Deshabilitar el otro botón de agregar
                botonOtro.disabled = true;
            } else {
                totalPagarInput.value = "Error: Precio no disponible";
            }
        });
}




    // Función para sumar paradas
    function sumarParadas() {
        var paradasInput = document.getElementById('paradasModal');
        var totalPagarInput = document.getElementById('totalPagar');
        var totalPagar = parseFloat(totalPagarInput.value) || 0;
        totalPagarInput.value = (totalPagar + 100).toFixed(2); // Sumar $100 al total a pagar
        paradasInput.value = parseInt(paradasInput.value) + 1;
    }

    // Función para restar paradas
    function restarParadas() {
        var paradasInput = document.getElementById('paradasModal');
        var totalPagarInput = document.getElementById('totalPagar');
        var totalPagar = parseFloat(totalPagarInput.value) || 0;
        if (paradasInput.value > 0) {
            totalPagarInput.value = (totalPagar - 100).toFixed(2); // Restar $100 al total a pagar
            paradasInput.value = parseInt(paradasInput.value) - 1;
        }
    }
// Función para sumar desvíos
function sumarDesvio(id, valor) {
    var inputDesvio = document.getElementById(id);
    var valorActual = parseInt(inputDesvio.value);
    inputDesvio.value = valorActual + 1;

    // Actualizar el total a pagar sumando el valor del desvío
    var totalPagarInput = document.getElementById('totalPagar');
    var precioActual = parseFloat(totalPagarInput.value) || 0;
    totalPagarInput.value = (precioActual + valor).toFixed(2);
}

// Función para restar desvíos
function restarDesvio(id, valor) {
    var inputDesvio = document.getElementById(id);
    var valorActual = parseInt(inputDesvio.value);
    if (valorActual > 0) {
        inputDesvio.value = valorActual - 1;

        // Actualizar el total a pagar restando el valor del desvío
        var totalPagarInput = document.getElementById('totalPagar');
        var precioActual = parseFloat(totalPagarInput.value) || 0;
        totalPagarInput.value = (precioActual - valor).toFixed(2);
    }
}



    // Función para sumar demoras
    function sumarDemoras() {
        var demorasInput = document.getElementById('demorasModal');
        var totalPagarInput = document.getElementById('totalPagar');
        var totalPagar = parseFloat(totalPagarInput.value) || 0;
        totalPagarInput.value = (totalPagar + 100).toFixed(2); // Sumar $100 al total a pagar
        demorasInput.value = parseInt(demorasInput.value) + 1;
    }

    // Función para restar demoras
    function restarDemoras() {
        var demorasInput = document.getElementById('demorasModal');
        var totalPagarInput = document.getElementById('totalPagar');
        var totalPagar = parseFloat(totalPagarInput.value) || 0;
        if (demorasInput.value > 0) {
            totalPagarInput.value = (totalPagar - 100).toFixed(2); // Restar $100 al total a pagar
            demorasInput.value = parseInt(demorasInput.value) - 1;
        }
    }
   
// 77hola
    function guardarViaje() {
    var formData = new FormData();
    formData.append('desde', document.getElementById('desde').value);
    formData.append('hasta', document.getElementById('hasta').value);
    formData.append('metodoPago', document.getElementById('metodoPago').value);
    formData.append('user_id', document.getElementById('user_id').value);
    formData.append('totalPagar', document.getElementById('totalPagar').value);
    formData.append('fecha', document.getElementById('fecha').value);
    formData.append('hora', document.getElementById('hora').value);

    console.log("Datos a enviar:", formData);

    axios.post('/viajes', formData)
        .then(function (response) {
            console.log(response.data);
            alert('Viaje guardado correctamente');
            // Aquí podrías redirigir a otra página o hacer alguna otra acción
        })
        .catch(function (error) {
            console.error(error);
            // Agregar registro de error al archivo de logs
            console.error('Error al guardar el viaje:', error);
            alert('Error al guardar el viaje');
        });
}



</script>

@endsection
