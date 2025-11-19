@extends('layouts.app')

@section('template_title')
    Show Imagenes Proyecto
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header" style="display: flex; justify-content: space-between;">
                    <div>
                        <span class="card-title">Show Imagenes Proyecto</span>
                    </div>

                    <div>
                        <a class="btn btn-primary btn-sm" href="{{ route('imagenes-proyecto.index') }}">Back</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2">
                        <strong>Proyecto Id:</strong>
                        {{ $imagenesProyecto->proyecto_id }}
                    </div>

                    <div class="form-group mb-2">
                        <strong>Url:</strong>
                        {{ $imagenesProyecto->url }}
                    </div>

                    <div class="form-group mb-2">
                        <strong>Orden:</strong>
                        {{ $imagenesProyecto->orden }}
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
@endsection
