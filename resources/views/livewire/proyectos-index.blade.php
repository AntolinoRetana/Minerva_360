<div>
    <!-- Barra de Herramientas: Buscador -->
    <div class="mb-4">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted">
                <i class="bi bi-search"></i>
            </span>
            <input 
                wire:model.live="search" 
                type="text" 
                class="form-control border-start-0 ps-0" 
                placeholder="Buscar proyectos por nombre, carrera o ubicación..."
                aria-label="Buscar proyectos">
        </div>
    </div>

    <!-- Contenedor de la tabla -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="py-3">Nombre</th>
                    <th scope="col" class="py-3">Carrera</th>
                    <th scope="col" class="py-3">Meta</th>
                    <th scope="col" class="py-3">Estado</th>
                    <th scope="col" class="py-3 text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyectos as $proyecto)
                    <tr>
                        <td class="fw-medium">{{ $proyecto->nombre }}</td>
                        <td class="text-muted">{{ $proyecto->carrera }}</td>
                        <td class="fw-bold text-success">${{ number_format($proyecto->meta, 2) }}</td>
                        
                        <!-- Badge de Estado -->
                        <td>
                            @if ($proyecto->estado == 'Activo')
                                <span class="badge bg-success-light text-success">Activo</span>
                            @elseif ($proyecto->estado == 'Completado')
                                <span class="badge bg-primary-light text-primary">Completado</span>
                            @elseif ($proyecto->estado == 'Cancelado')
                                <span class="badge bg-danger-light text-danger">Cancelado</span>
                            @else
                                <span class="badge bg-secondary-light text-secondary">{{ $proyecto->estado }}</span>
                            @endif
                        </td>
                        
                        <!-- Botones de Acción -->
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <!-- Botón Editar -->
                                <a href="{{ route('proyectos.editar', $proyecto->id) }}" 
                                   class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1"
                                   title="Editar">
                                    <i class="bi bi-pencil-fill"></i> 
                                    <span class="d-none d-md-inline">Editar</span>
                                </a>
                                
                                <!-- Botón Eliminar -->
                                <button 
                                    type="button"
                                    class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                                    onclick="confirmarEliminacion({{ $proyecto->id }})"
                                    title="Eliminar">
                                    <i class="bi bi-trash-fill"></i> 
                                    <span class="d-none d-md-inline">Eliminar</span>
                                </button>

                                <!-- Botón Ver Imágenes (Color Info) -->
                                <a href="{{ route('imagenes-proyecto.por-proyecto', $proyecto->id) }}"
                                   class="btn btn-sm btn-outline-info d-flex align-items-center gap-1"
                                   title="Galería">
                                    <i class="bi bi-images"></i> 
                                    <span class="d-none d-md-inline">Imágenes</span>
                                </a>

                                <!-- Botón Añadir Imagen (Color Primario/Marca) -->
                                <a href="{{ route('imagenes-proyecto.create', ['proyecto_id' => $proyecto->id]) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1"
                                   title="Subir Imagen">
                                    <i class="bi bi-cloud-upload-fill"></i> 
                                    <span class="d-none d-md-inline">Subir</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-search fs-1 d-block mb-2"></i>
                                No se encontraron proyectos que coincidan con tu búsqueda.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>