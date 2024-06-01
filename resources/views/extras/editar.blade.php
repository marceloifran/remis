@extends('layouts.app')

@section('content')
    <section class="section" style="margin: 20px">
        <div class="section-header alert alert-info">
            <h3 class="text-center page__heading h2">Editar Extra</h3>
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

                            <form method="POST" action="{{ route('extras.update', $extras->id) }}">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" value="{{ $extras->nombre }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="text" name="precio" value="{{ $extras->precio }}" class="form-control">
                                        </div>
                                    </div>
                                   
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button style="margin: 10px" type="submit" class="btn btn-info">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
