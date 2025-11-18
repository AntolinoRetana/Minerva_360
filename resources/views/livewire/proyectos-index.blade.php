<div>
    <!-- Opcional: Añade un buscador que funcione con Livewire -->
    <div class="mb-3">
        <input 
            wire:model.live="search" 
            type="text" 
            class="form-control" 
            placeholder="Buscar proyectos por nombre..."
        >
    </div>

    <!-- Contenedor de la tabla para hacerla responsive -->
    <div class="table-responsive">
        
        <!-- 1. Clases de Bootstrap para la tabla -->
        <table class="table table-hover align-middle">
            
            <!-- 2. Cabecera de tabla estilizada -->
            <thead class="table-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Meta</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                @forelse ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->nombre }}</td>
                        <td>{{ $proyecto->carrera }}</td>
                        <td>${{ number_format($proyecto->meta, 2) }}</td>
                        
                        <!-- 3. "Badge" (Etiqueta) para el estado -->
                        <td>
                            @if ($proyecto->estado == 'Activo')
                                <span class="badge bg-success">Activo</span>
                            @elseif ($proyecto->estado == 'Completado')
                                <span class="badge bg-primary-light text-primary">Completado</span>
                            @else
                                <span class="badge bg-secondary">{{ $proyecto->estado }}</span>
                            @endif
                        </td>
                        
                        <td>
                            <!-- 4. Botones estilizados -->
                            <button 
                                class="btn btn-sm btn-outline-secondary"
                                wire:click="editarProyecto({{ $proyecto->id }})"
                            >
                                <i class="bi bi-pencil-fill"></i> Editar
                            </button>
                            
                            <!-- 5. Botón de eliminar (llama a nuestra función JS) -->
                            <button 
                                class="btn btn-sm btn-outline-danger"
                                onclick="confirmarEliminacion({{ $proyecto->id }})"
                            >
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No se encontraron proyectos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>