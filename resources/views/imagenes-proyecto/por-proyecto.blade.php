@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4">
        Imágenes del proyecto: 
        <strong>{{ $proyecto->nombre }}</strong>
    </h3>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session("success") }}',
                timer: 1500,
                showConfirmButton: false
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session("error") }}'
            })
        </script>
    @endif


    <div class="mb-3">
        <a href="{{ route('imagenes-proyecto.create', ['proyecto_id' => $proyecto->id]) }}"
           class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Subir nueva imagen
        </a>
    </div>

    <div class="row">

        @forelse($imagenes as $img)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">

                    <img src="{{ $img->url }}" 
                         class="card-img-top" 
                         style="height: 180px; object-fit: cover;">

                    <div class="card-body text-center">

                        <button onclick="confirmarEliminacion({{ $img->id }})"
                                class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash-fill"></i> Eliminar
                        </button>

                        <form id="form-delete-{{ $img->id }}" 
                              action="{{ route('imagenes-proyecto.eliminar', ['id' => $img->id]) }}"
                              method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>

                </div>
            </div>

        @empty
            <p class="text-muted text-center">No hay imágenes para este proyecto.</p>
        @endforelse

    </div>

</div>

<script>
function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Eliminar imagen?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${id}`).submit();
        }
    })
}
</script>

@endsection
