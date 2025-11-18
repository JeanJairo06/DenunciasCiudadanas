<div class="bg-white border border-slate-200 rounded-2xl shadow-lg p-8 space-y-8">

    <!-- ENCABEZADO -->
    <div class="flex items-center justify-between gap-3">
        <div>
            <p class="text-sm font-medium text-slate-500 tracking-[0.15em] uppercase">Denuncias</p>
            <h1 class="text-3xl font-bold text-slate-900 leading-tight">
                {{ $mode === 'edit' ? 'Editar denuncia' : 'Registrar nueva denuncia' }}
            </h1>
        </div>

        <a href="{{ route('denuncias.index') }}"
           class="btn btn-ghost btn-sm gap-2 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition">
            <x-lucide-arrow-left class="w-4 h-4" />
            Volver al listado
        </a>
    </div>

    <!-- FORMULARIO -->
    <form wire:submit.prevent="submit" class="space-y-6">

        <!-- FILA 1 -->
        <div class="grid gap-6 md:grid-cols-2">

            <label class="space-y-2 text-sm font-medium text-slate-700">
                Título
                <input
                    type="text"
                    wire:model.defer="formTitulo"
                    placeholder="Ej. Bache en carrera 7"
                    class="input input-bordered w-full h-11 rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                />
                @error('formTitulo')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <label class="space-y-2 text-sm font-medium text-slate-700">
                Estado
                <select
                    wire:model.defer="formEstado"
                    class="select select-bordered w-full h-11 rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                >
                    @foreach ($estados as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('formEstado')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </label>

        </div>

        <!-- DESCRIPCION -->
        <label class="space-y-2 text-sm font-medium text-slate-700">
            Descripción
            <textarea
                wire:model.defer="formDescripcion"
                rows="4"
                placeholder="Describe brevemente el problema."
                class="textarea textarea-bordered w-full rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
            ></textarea>
            @error('formDescripcion')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </label>

        <!-- FILA 2 -->
        <div class="grid gap-6 md:grid-cols-2">

            <label class="space-y-2 text-sm font-medium text-slate-700">
                Ubicación
                <input
                    type="text"
                    wire:model.defer="formUbicacion"
                    placeholder="Barrio, calle o punto de referencia"
                    class="input input-bordered w-full h-11 rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                />
                @error('formUbicacion')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <label class="space-y-2 text-sm font-medium text-slate-700">
                Ciudadano
                <input
                    type="text"
                    wire:model.defer="formCiudadano"
                    placeholder="Nombre del denunciante"
                    class="input input-bordered w-full h-11 rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                />
                @error('formCiudadano')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </label>

        </div>

        <!-- FILA 3 -->
        <div class="grid gap-6 md:grid-cols-2">

            <label class="space-y-2 text-sm font-medium text-slate-700">
                Teléfono ciudadano
                <input
                    type="tel"
                    wire:model.defer="formTelefonoCiudadano"
                    placeholder="3001234567"
                    class="input input-bordered w-full h-11 rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                />
                @error('formTelefonoCiudadano')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </label>

            <label class="space-y-2 text-sm font-medium text-slate-700">
                Fecha de registro
                <input
                    type="datetime-local"
                    wire:model.defer="formFechaRegistro"
                    class="input input-bordered w-full h-11 rounded-xl border-slate-300 text-slate-700 focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                />
                @error('formFechaRegistro')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </label>

        </div>

        <!-- IMAGEN -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-700">Imagen</label>

            <input
                type="file"
                wire:model="formImagen"
                accept="image/*"
                class="file-input file-input-bordered w-full rounded-xl border-slate-300 text-slate-700"
            />

            @error('formImagen')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- PREVIEW -->
        @if ($formImagen)
            <div class="text-sm font-medium text-slate-700">
                Vista previa nueva
                <div class="mt-2 w-full h-48 rounded-xl border border-dashed border-slate-300 overflow-hidden bg-slate-50 shadow-inner">
                    <img src="{{ $formImagen->temporaryUrl() }}" class="w-full h-full object-cover" />
                </div>
            </div>
        @elseif ($formExistingImage)
            <div class="text-sm font-medium text-slate-700">
                Imagen registrada
                <div class="mt-2 w-full h-48 rounded-xl border border-slate-200 overflow-hidden bg-slate-50 shadow-inner">
                    <img src="{{ $formExistingImage }}" class="w-full h-full object-cover" />
                </div>
            </div>
        @endif

        <!-- BOTÓN -->
        <div class="flex justify-end pt-4">
            <button
                type="submit"
                class="btn btn-primary rounded-xl px-6 py-3 text-sm font-semibold shadow-lg shadow-sky-500/30 hover:shadow-sky-500/40 transition"
            >
                {{ $mode === 'edit' ? 'Actualizar denuncia' : 'Registrar denuncia' }}
            </button>
        </div>

    </form>
</div>
