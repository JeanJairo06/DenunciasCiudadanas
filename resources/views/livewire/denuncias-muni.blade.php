<div class="space-y-6">

    <section class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="space-y-2">
                <label for="text" class="text-sm font-medium text-slate-600">Buscar</label>
                <input type="text" id="text" wire:model.live.debounce.300ms="text" placeholder="Buscar..."
                       class="input input-bordered w-full h-8 px-3 border border-slate-300 rounded focus:outline-none focus:ring-2 focus:ring-sky-500" />
            </div>

            <div class="space-y-2">
                <label for="estado" class="text-sm font-medium text-slate-600">Estado</label>
                <select id="estado" wire:model="estado"
                        class="w-full border border-slate-300 rounded h-10 px-3 focus:ring-2 focus:ring-sky-500">
                    <option value="">Todos</option>
                    @foreach ($estados as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label for="perPage" class="text-sm font-medium text-slate-600">Mostrar por página</label>
                <select id="perPage" wire:model="perPage"
                        class="w-full border border-slate-300 rounded h-10 px-3 focus:ring-2 focus:ring-sky-500">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-600">Fecha registrada</label>
                <div class="flex gap-2">
                    <input wire:model="desde" type="date" class="w-full border border-slate-200 rounded h-10 px-3 focus:ring-2 focus:ring-sky-500" />
                    <input wire:model="hasta" type="date" class="w-full border border-slate-200 rounded h-10 px-3 focus:ring-2 focus:ring-sky-500" />
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-sm text-slate-500">Resultados: <span class="font-semibold text-slate-700">{{ $denuncias->total() }}</span></p>
                <p class="text-xs text-slate-400">Ordenado por {{ str()->title(str_replace('_', ' ', $sortField)) }} {{ $sortDirection === 'asc' ? '↑' : '↓' }}</p>
            </div>
            <p class="text-xs text-slate-500">Página {{ $denuncias->currentPage() }} de {{ $denuncias->lastPage() }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="text-xs uppercase bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-6 py-3 whitespace-nowrap">
                            <button wire:click="sortBy('titulo')" class="flex items-center gap-1">
                                Título
                                @if ($sortField === 'titulo')
                                    <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Ciudadano</th>
                        <th class="px-6 py-3">Ubicación</th>
                        <th class="px-6 py-3">Teléfono</th>
                        <th class="px-6 py-3">
                            <button wire:click="sortBy('fecha_registro')" class="flex items-center gap-1">
                                Fecha
                                @if ($sortField === 'fecha_registro')
                                    <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3">Imagen</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse ($denuncias as $denuncia)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $denuncia->titulo }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $denuncia->estado === 'resuelto' ? 'bg-emerald-100 text-emerald-700' : ($denuncia->estado === 'en proceso' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-700') }}">
                                    {{ ucfirst($denuncia->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $denuncia->ciudadano }}</td>
                            <td class="px-6 py-4">{{ $denuncia->ubicacion }}</td>
                            <td class="px-6 py-4">{{ $denuncia->telefono_ciudadano }}</td>
                            <td class="px-6 py-4">{{ $denuncia->fecha_registro->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="w-20 h-16 overflow-hidden rounded shadow-sm bg-slate-100 flex items-center justify-center">
                                    <img src="{{ $denuncia->imagen }}" alt="Imagen de {{ $denuncia->titulo }}" class="h-full w-full object-cover" loading="lazy">
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                No se encontraron denuncias con los criterios seleccionados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
            {{ $denuncias->links() }}
        </div>
    </section>
</div>
