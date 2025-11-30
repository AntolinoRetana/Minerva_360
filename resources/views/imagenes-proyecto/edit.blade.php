@extends('layouts.app')

@section('template_title')
    Edit Imagenes Proyecto
@endsection

@section('content')
<section class="content container-fluid">
    <div>
        <div class="col-md-12">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Edit Imagenes Proyecto</span>
                </div>

                <div class="card-body bg-white">

                    <form method="POST" action="{{ route('imagenes-proyecto.update', $imagenesProyecto->id) }}">
                        @csrf
                        @method('PATCH')

                        @include('imagenes-proyecto.form')

                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
