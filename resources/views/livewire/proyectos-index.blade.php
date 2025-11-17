
<div>
    <div class="mb-4">
        <a href="{{ route('proyectos.crear') }}"
           class="px-4 py-2 bg-green-600 text-white rounded">
            Crear Proyecto
        </a>
    </div>

    <table class="table-auto w-full mt-4 bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Carrera</th>
                <th class="px-4 py-2 text-left">Meta</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $p)
                <tr>
                    <td class="border px-4 py-2">{{ $p->nombre }}</td>
                    <td class="border px-4 py-2">{{ $p->carrera }}</td>
                    <td class="border px-4 py-2">${{ $p->meta }}</td>
                    <td class="border px-4 py-2">{{ $p->estado }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('proyectos.editar', $p->id) }}" class="text-blue-500">Editar</a>

                        <button onclick="confirmarEliminacion({{ $p->id }})" class="text-red-600">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">
                        No hay proyectos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
