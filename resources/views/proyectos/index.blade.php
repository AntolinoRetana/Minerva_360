@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Proyectos</h1>

   
    <livewire:proyectos-index />

@endsection

@push('scripts')

    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: "¿Eliminar este proyecto?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarProyecto', { id: id });
                }
            });
        }
    </script>

    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
@endpush

