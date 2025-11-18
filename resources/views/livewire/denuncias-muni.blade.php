<div
    x-data="{ showDeleteModal: @entangle('showDeleteModal') }"
    x-cloak
    class="space-y-6 p-4 md:p-6">

    <!-- =============================
         ENCABEZADO DEL PANEL
    ============================== -->
    <section class="bg-gradient-to-br from-white to-slate-50 rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8">
        
        <!-- Header principal -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-1">
                    Panel de Denuncias
                </h1>
                <p class="text-slate-600 text-sm">
                    Gestiona y administra las denuncias ciudadanas
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <!-- Por página -->
                <div class="relative">
                    <select
                        wire:model="perPage"
                        class="appearance-none pl-4 pr-10 py-2.5 text-sm font-medium bg-white border border-slate-300 rounded-xl hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all cursor-pointer">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="15">15 por página</option>
                        <option value="20">20 por página</option>
                    </select>
                    <x-lucide-chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" />
                </div>

                <!-- Nueva denuncia -->
                <a href="{{ route('denuncias.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-xl hover:shadow-sky-500/40 transition-all duration-200 hover:scale-105">
                    <x-lucide-plus class="w-4 h-4" />
                    Nueva denuncia
                </a>

                <!-- Reset -->
                <button
                    type="button"
                    wire:click="clearFilters"
                    class="p-2.5 bg-white border border-slate-300 hover:border-slate-400 rounded-xl hover:bg-slate-50 transition-all duration-200 group"
                    title="Limpiar filtros">
                    <x-lucide-rotate-ccw class="w-4 h-4 text-slate-600 group-hover:rotate-180 transition-transform duration-500" />
                </button>
            </div>
        </div>

        <!-- =============================
             FILTROS AVANZADOS
        ============================== -->
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6">

            <!-- Buscar - Ocupa más espacio -->
            <div class="sm:col-span-2 lg:col-span-2">
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">
                    Búsqueda general
                </label>
                <div class="relative group">
                    <x-lucide-search class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4 group-focus-within:text-sky-600 transition-colors" />
                    <input
                        type="text"
                        wire:model.debounce.300ms="filterText"
                        placeholder="Título, descripción, ciudadano..."
                        class="w-full pl-11 pr-4 py-2.5 text-sm bg-white border border-slate-300 rounded-xl hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all" />
                </div>
            </div>

            <!-- Estado -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">
                    Estado
                </label>
                <div class="relative">
                    <select
                        wire:model="filterEstado"
                        class="appearance-none w-full px-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-xl hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all cursor-pointer">
                        <option value="">Todos</option>
                        @foreach ($estados as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-lucide-chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" />
                </div>
            </div>

            <!-- Ciudadano -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">
                    Ciudadano
                </label>
                <input
                    type="text"
                    wire:model.debounce.300ms="filterCiudadano"
                    placeholder="Nombre..."
                    class="w-full px-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-xl hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all" />
            </div>

            <!-- Ubicación -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">
                    Ubicación
                </label>
                <input
                    type="text"
                    wire:model.debounce.300ms="filterUbicacion"
                    placeholder="Distrito..."
                    class="w-full px-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-xl hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all" />
            </div>

            <!-- Fecha -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">
                    Desde
                </label>
                <input
                    type="date"
                    wire:model="filterDesde"
                    class="w-full px-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-xl hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all" />
            </div>

        </div>
    </section>

    <!-- =============================
         INFO Y ORDENAMIENTO
    ============================== -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-2">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-sky-100 rounded-lg">
                <x-lucide-database class="w-5 h-5 text-sky-600" />
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-900">
                    Ordenado por: {{ str()->title(str_replace('_', ' ', $sortField)) }}
                </p>
                <p class="text-xs text-slate-500">
                    {{ $sortDirection === 'asc' ? 'Ascendente ↑' : 'Descendente ↓' }}
                </p>
            </div>
        </div>

        @if ($denuncias->total())
        <div class="flex items-center gap-2 text-sm">
            <span class="text-slate-500">Mostrando</span>
            <span class="font-semibold text-slate-900">{{ $denuncias->firstItem() }} – {{ $denuncias->lastItem() }}</span>
            <span class="text-slate-500">de</span>
            <span class="font-semibold text-slate-900">{{ $denuncias->total() }}</span>
        </div>
        @endif
    </div>

    <!-- =============================
         TABLA DESKTOP
    ============================== -->
    <section class="hidden lg:block bg-white border border-slate-200 rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100 border-b-2 border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left">
                            <button wire:click="sortBy('titulo')" class="flex items-center gap-2 text-xs font-bold text-slate-700 uppercase tracking-wider hover:text-sky-600 transition-colors group">
                                Título
                                <span class="text-slate-400 group-hover:text-sky-600">
                                    @if ($sortField === 'titulo')
                                    {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                    @else
                                    ↕
                                    @endif
                                </span>
                            </button>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Ciudadano</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Ubicación</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Teléfono</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Imagen</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Cambiar Estado</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($denuncias as $denuncia)
                    <tr class="hover:bg-sky-50/50 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-900 line-clamp-2">{{ $denuncia->titulo }}</p>
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full
                                    {{ $denuncia->estado === 'resuelto' ? 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200'
                                    : ($denuncia->estado === 'en proceso' ? 'bg-amber-100 text-amber-700 ring-1 ring-amber-200'
                                    : 'bg-slate-100 text-slate-700 ring-1 ring-slate-200') }}">
                                {{ ucfirst($denuncia->estado) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-700">{{ $denuncia->ciudadano }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $denuncia->ubicacion }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $denuncia->telefono_ciudadano }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700">{{ $denuncia->fecha_registro?->format('d/m/Y H:i') }}</td>

                        <td class="px-6 py-4">
                            <div class="w-20 h-14 rounded-lg overflow-hidden shadow-md border-2 border-white ring-1 ring-slate-200 hover:ring-sky-400 transition-all cursor-pointer group">
                                <img src="{{ $denuncia->imagen }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-300" />
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="relative">
                                <select
                                    wire:change="changeEstadoQuick({{ $denuncia->id }}, $event.target.value)"
                                    class="appearance-none w-full px-3 py-1.5 pr-8 text-xs font-medium bg-white border border-slate-300 rounded-lg hover:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all cursor-pointer">
                                    @foreach ($estados as $value => $label)
                                    <option value="{{ $value }}" @selected($denuncia->estado === $value)>
                                        {{ $label }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-lucide-chevron-down class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 text-slate-400 pointer-events-none" />
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('denuncias.edit', $denuncia) }}"
                                    class="p-2 bg-sky-50 hover:bg-sky-100 text-sky-600 rounded-lg transition-all hover:scale-110"
                                    title="Editar">
                                    <x-lucide-pen class="w-4 h-4" />
                                </a>

                                <button
                                    type="button"
                                    wire:click="confirmDelete({{ $denuncia->id }})"
                                    class="p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-all hover:scale-110"
                                    title="Eliminar">
                                    <x-lucide-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-16">
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                                    <x-lucide-inbox class="w-8 h-8 text-slate-400" />
                                </div>
                                <p class="text-slate-600 font-medium">No se encontraron denuncias</p>
                                <p class="text-slate-500 text-sm mt-1">Intenta ajustar los filtros de búsqueda</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($denuncias->total())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
            {{ $denuncias->links() }}
        </div>
        @endif
    </section>

    <!-- =============================
         VISTA DE TARJETAS MÓVIL
    ============================== -->
    <section class="lg:hidden space-y-4">
        @forelse ($denuncias as $denuncia)
        <div class="bg-white border border-slate-200 rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            
            <!-- Imagen destacada -->
            <div class="relative h-48 bg-slate-100">
                <img src="{{ $denuncia->imagen }}" class="w-full h-full object-cover" />
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-full shadow-lg backdrop-blur-sm
                            {{ $denuncia->estado === 'resuelto' ? 'bg-emerald-500/90 text-white'
                            : ($denuncia->estado === 'en proceso' ? 'bg-amber-500/90 text-white'
                            : 'bg-slate-500/90 text-white') }}">
                        {{ ucfirst($denuncia->estado) }}
                    </span>
                </div>
            </div>

            <div class="p-5 space-y-4">
                <!-- Título -->
                <h3 class="text-lg font-bold text-slate-900 line-clamp-2">
                    {{ $denuncia->titulo }}
                </h3>

                <!-- Info grid -->
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Ciudadano</p>
                        <p class="text-slate-900 font-medium">{{ $denuncia->ciudadano }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Teléfono</p>
                        <p class="text-slate-900 font-medium">{{ $denuncia->telefono_ciudadano }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Ubicación</p>
                        <p class="text-slate-900 font-medium">{{ $denuncia->ubicacion }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Fecha de registro</p>
                        <p class="text-slate-900 font-medium">{{ $denuncia->fecha_registro?->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <!-- Cambiar estado -->
                <div>
                    <label class="block text-xs text-slate-500 font-semibold uppercase tracking-wide mb-2">
                        Cambiar estado
                    </label>
                    <div class="relative">
                        <select
                            wire:change="changeEstadoQuick({{ $denuncia->id }}, $event.target.value)"
                            class="appearance-none w-full px-4 py-2.5 text-sm font-medium bg-slate-50 border border-slate-300 rounded-xl hover:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-all cursor-pointer">
                            @foreach ($estados as $value => $label)
                            <option value="{{ $value }}" @selected($denuncia->estado === $value)>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        <x-lucide-chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" />
                    </div>
                </div>

                <!-- Acciones -->
                <div class="flex gap-2 pt-2">
                    <a href="{{ route('denuncias.edit', $denuncia) }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition-all">
                        <x-lucide-pen class="w-4 h-4" />
                        Editar
                    </a>

                    <button
                        type="button"
                        wire:click="confirmDelete({{ $denuncia->id }})"
                        class="px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition-all"
                        title="Eliminar">
                        <x-lucide-trash class="w-5 h-5" />
                    </button>
                </div>
            </div>
        </div>

        @empty
        <div class="bg-white border border-slate-200 rounded-2xl p-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                <x-lucide-inbox class="w-10 h-10 text-slate-400" />
            </div>
            <p class="text-slate-600 font-medium text-lg">No se encontraron denuncias</p>
            <p class="text-slate-500 text-sm mt-2">Intenta ajustar los filtros de búsqueda</p>
        </div>
        @endforelse

        @if ($denuncias->total())
        <div class="bg-white border border-slate-200 rounded-2xl p-4">
            {{ $denuncias->links() }}
        </div>
        @endif
    </section>

    <!-- =============================
         MODAL DE ELIMINACIÓN
    ============================== -->
    <div
        x-show="showDeleteModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4"
        @keydown.escape.window="$wire.closeDeleteModal()"
        style="display: none;">
        
        <div
            x-show="showDeleteModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden"
            @click.away="$wire.closeDeleteModal()">
            
            <!-- Header del modal -->
            <div class="bg-gradient-to-r from-red-500 to-rose-500 p-6 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur rounded-full mb-3">
                    <x-lucide-alert-triangle class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-xl font-bold text-white">Confirmar eliminación</h3>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <p class="text-slate-600 text-center leading-relaxed">
                    ¿Estás seguro de que deseas eliminar la denuncia
                    <strong class="text-slate-900 block mt-2 text-lg">{{ $deleteDenunciaTitle }}</strong>
                </p>
                <p class="text-slate-500 text-sm text-center mt-3">
                    Esta acción no se puede deshacer.
                </p>
            </div>

            <!-- Acciones -->
            <div class="flex gap-3 p-6 pt-0">
                <button 
                    wire:click="closeDeleteModal"
                    class="flex-1 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-all">
                    Cancelar
                </button>

                <button 
                    wire:click="deleteDenuncia"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 transition-all">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

</div>