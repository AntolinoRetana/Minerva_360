<div>
    <form wire:submit.prevent="guardar">
        
        <!-- Fila 1: Nombre (Ancho Completo) -->
        <div class="row mb-3">
            <div class="col-12">
                <label for="nombre" class="form-label label-t">Nombre del Proyecto</label>
                <input type="text" id="nombre" wire:model="nombre"
                       class="form-control @error('nombre') is-invalid @enderror">
                @error('nombre') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        <!-- Fila 2: Descripción (Ancho Completo) -->
        <div class="row mb-3">
            <div class="col-12">
                <label for="descripcion" class="form-label label-t">Descripción</label>
                <textarea id="descripcion" wire:model="descripcion" rows="4"
                          class="form-control @error('descripcion') is-invalid @enderror"></textarea>
                @error('descripcion') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        <!-- Fila 3: Carrera y Ubicación -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="carrera" class="form-label label-t">Carrera</label>
                <input type="text" id="carrera" wire:model="carrera"
                       class="form-control @error('carrera') is-invalid @enderror">
                @error('carrera') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <label for="ubicacion" class="form-label label-t">Ubicación</label>
                <input type="text" id="ubicacion" wire:model="ubicacion"
                       class="form-control @error('ubicacion') is-invalid @enderror">
                @error('ubicacion') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        <!-- Fila 4: Meta, Progreso y Estado -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="meta" class="form-label label-t">Meta ($)</label>
                <input type="number" id="meta" wire:model="meta" step="0.01"
                       class="form-control @error('meta') is-invalid @enderror">
                @error('meta') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
            
            <div class="col-md-4 mt-3 mt-md-0">
                <label for="progreso" class="form-label label-t">Progreso ($)</label>
                <input type="number" id="progreso" wire:model="progreso" step="0.01"
                       class="form-control @error('progreso') is-invalid @enderror">
                @error('progreso') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <label for="estado" class="form-label label-t">Estado</label>
                <select id="estado" wire:model="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="Activo">Activo</option>
                    <option value="Completado">Completado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
                @error('estado') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>
        </div>

        <!-- Fila 5: Botones -->
        <hr>
        <div class="d-flex justify-content-end gap-2 mt-4">
            
            <!-- Botón Cancelar -->
            <a href="{{ route('proyectos.index') }}"
               class="btn btn-outline-secondary">
               Cancelar
            </a>

            <!-- Botón Guardar -->
            <button type="submit"
                    class="btn btn-primary">
                Guardar Cambios
            </button>
            
        </div>

    </form>
</div>
