<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">
    <form wire:submit.prevent="actualizar">

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Nombre</label>
            <input type="text" wire:model="nombre"
                   class="w-full border p-2 rounded">
            @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea wire:model="descripcion"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Carrera</label>
            <input type="text" wire:model="carrera"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Ubicación</label>
            <input type="text" wire:model="ubicacion"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Meta ($)</label>
            <input type="number" wire:model="meta"
                   class="w-full border p-2 rounded">
            @error('meta') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Progreso ($)</label>
            <input type="number" wire:model="progreso"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Estado</label>
            <select wire:model="estado" class="w-full border p-2 rounded">
                <option value="Activo">Activo</option>
                <option value="Completado">Completado</option>
            </select>
            @error('estado') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('proyectos.index') }}"
               class="px-4 py-2 border rounded">
                Cancelar
            </a>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded">
                Guardar cambios
            </button>
        </div>

    </form>
</div>
