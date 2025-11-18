@extends('layouts.app')

@section('template_title')
    {{ $imagenesProyecto->name ?? __('Show') . " " . __('Imagenes Proyecto') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Imagenes Proyecto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('imagenes-proyectos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Proyecto Id:</strong>
                                    {{ $imagenesProyecto->proyecto_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Url:</strong>
                                    {{ $imagenesProyecto->url }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Orden:</strong>
                                    {{ $imagenesProyecto->orden }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
