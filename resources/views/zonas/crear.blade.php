@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="section-header alert alert-success">
            <h3 class="page__heading h2 text-center">Alta de Destinos</h3>
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

                            <form action="{{ route('zonas.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="zona">Zona</label>
                                            <select name="zona" class="form-control" required>
                                                <option value="">Selecciona una zona</option>
                                                <option value="zona1">Zona 1 / base</option>
                                                <option value="zona2">Zona 2</option>
                                                <option value="zona3">Zona 3</option>
                                                <!-- Agrega más opciones según sea necesario -->
                                            </select>
                                        </div>
                                    </div>
                                  
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="zonas">Precio</label>
                                            <input type="float" name="precio" class="form-control" required>
                                        </div>
                                    </div>

                                    <div style="margin: 10px;" class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
