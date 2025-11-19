@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3 class="mb-4">
        Subir imagen al proyecto: 
        <strong>{{ $proyecto->nombre }}</strong>
    </h3>

    {{-- SweetAlert al subir --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Imagen subida',
                text: '{{ session("success") }}',
                timer: 1500,
                showConfirmButton: false
            })
        </script>
    @endif

    <div class="card shadow p-4">

        <form method="POST" action="{{ route('imagenes-proyecto.store') }}" enctype="multipart/form-data">
            @csrf

            @include('imagenes-proyecto.form')

        </form>

    </div>

</div>

@endsection
