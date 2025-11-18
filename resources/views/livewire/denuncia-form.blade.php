<div class="min-h-screen bg-gradient-to-br from-slate-50 via-sky-50/30 to-slate-50 p-4 md:p-6 lg:p-8">
    
    <div class="max-w-5xl mx-auto">
        
        <!-- ENCABEZADO MEJORADO -->
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-gradient-to-br from-sky-600 to-blue-600 rounded-xl shadow-lg">
                            <x-lucide-file-text class="w-5 h-5 text-white" />
                        </div>
                        <span class="text-xs font-bold text-slate-500 tracking-[0.2em] uppercase">
                            {{ $mode === 'edit' ? 'Actualización' : 'Nueva Denuncia' }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 leading-tight">
                        {{ $mode === 'edit' ? 'Editar denuncia' : 'Registrar denuncia' }}
                    </h1>
                    <p class="text-slate-600 mt-2 text-sm md:text-base">
                        {{ $mode === 'edit' 
                           ? 'Actualiza los datos de la denuncia ciudadana' 
                           : 'Complete el formulario con los datos de la nueva denuncia' }}
                    </p>
                </div>

                <a href="{{ route('denuncias.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-200 hover:border-slate-300 rounded-xl text-slate-700 hover:text-slate-900 font-medium transition-all shadow-sm hover:shadow group">
                    <x-lucide-arrow-left class="w-4 h-4 group-hover:-translate-x-1 transition-transform" />
                    Volver al listado
                </a>
            </div>
        </div>

        <!-- CONTENEDOR PRINCIPAL -->
        <div class="bg-white border border-slate-200 rounded-3xl shadow-xl overflow-hidden">
            
            <form wire:submit.prevent="submit" class="p-6 md:p-8 lg:p-10 space-y-8">

                <!-- SECCIÓN 1: INFORMACIÓN BÁSICA -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-slate-100">
                        <div class="p-2 bg-sky-100 rounded-lg">
                            <x-lucide-info class="w-5 h-5 text-sky-600" />
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Información básica</h2>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <!-- Título -->
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                                <x-lucide-heading class="w-4 h-4 text-sky-600" />
                                Título de la denuncia
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                wire:model.defer="formTitulo"
                                placeholder="Ej. Bache en carrera 7 con calle 45"
                                class="w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all"
                            />
                            @error('formTitulo')
                                <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                    <x-lucide-alert-circle class="w-3 h-3" />
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                                <x-lucide-circle-dot class="w-4 h-4 text-sky-600" />
                                Estado actual
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select
                                    wire:model.defer="formEstado"
                                    class="appearance-none w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all cursor-pointer"
                                >
                                    @foreach ($estados as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                <x-lucide-chevron-down class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" />
                            </div>
                            @error('formEstado')
                                <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                    <x-lucide-alert-circle class="w-3 h-3" />
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <!-- Descripción -->
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                            <x-lucide-align-left class="w-4 h-4 text-sky-600" />
                            Descripción detallada
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            wire:model.defer="formDescripcion"
                            rows="5"
                            placeholder="Describe brevemente el problema. Incluye detalles relevantes como magnitud, afectación, etc."
                            class="w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all resize-none"
                        ></textarea>
                        @error('formDescripcion')
                            <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                <x-lucide-alert-circle class="w-3 h-3" />
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- SECCIÓN 2: UBICACIÓN -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-slate-100">
                        <div class="p-2 bg-emerald-100 rounded-lg">
                            <x-lucide-map-pin class="w-5 h-5 text-emerald-600" />
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Ubicación</h2>
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                            <x-lucide-navigation class="w-4 h-4 text-emerald-600" />
                            Dirección o punto de referencia
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            wire:model.defer="formUbicacion"
                            placeholder="Ej. Barrio Centro, Calle 10 #5-20 o frente al parque principal"
                            class="w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                        />
                        @error('formUbicacion')
                            <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                <x-lucide-alert-circle class="w-3 h-3" />
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- SECCIÓN 3: DATOS DEL CIUDADANO -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-slate-100">
                        <div class="p-2 bg-amber-100 rounded-lg">
                            <x-lucide-user class="w-5 h-5 text-amber-600" />
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Datos del ciudadano</h2>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <!-- Nombre -->
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                                <x-lucide-user-circle class="w-4 h-4 text-amber-600" />
                                Nombre completo
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                wire:model.defer="formCiudadano"
                                placeholder="Ej. Juan Pérez García"
                                class="w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            />
                            @error('formCiudadano')
                                <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                    <x-lucide-alert-circle class="w-3 h-3" />
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                                <x-lucide-phone class="w-4 h-4 text-amber-600" />
                                Teléfono de contacto
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="tel"
                                wire:model.defer="formTelefonoCiudadano"
                                placeholder="Ej. 3001234567"
                                class="w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            />
                            @error('formTelefonoCiudadano')
                                <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                    <x-lucide-alert-circle class="w-3 h-3" />
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- SECCIÓN 4: FECHA Y EVIDENCIA -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-slate-100">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <x-lucide-calendar class="w-5 h-5 text-purple-600" />
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Fecha y evidencia</h2>
                    </div>

                    <!-- Fecha de registro -->
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                            <x-lucide-clock class="w-4 h-4 text-purple-600" />
                            Fecha y hora de registro
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="datetime-local"
                            wire:model.defer="formFechaRegistro"
                            class="w-full px-4 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl hover:border-slate-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        />
                        @error('formFechaRegistro')
                            <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                <x-lucide-alert-circle class="w-3 h-3" />
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-sm font-bold text-slate-700 uppercase tracking-wide">
                            <x-lucide-image class="w-4 h-4 text-purple-600" />
                            Fotografía de evidencia
                            @if($mode !== 'edit')
                                <span class="text-red-500">*</span>
                            @endif
                        </label>
                        
                        <div class="relative">
                            <input
                                type="file"
                                wire:model="formImagen"
                                accept="image/*"
                                id="file-upload"
                                class="hidden"
                            />
                            <label 
                                for="file-upload"
                                class="flex items-center justify-center gap-3 w-full px-6 py-4 bg-gradient-to-br from-slate-50 to-slate-100 border-2 border-dashed border-slate-300 rounded-xl hover:border-purple-400 hover:bg-purple-50/50 cursor-pointer transition-all group">
                                <div class="p-3 bg-white rounded-full shadow-sm group-hover:shadow group-hover:scale-110 transition-all">
                                    <x-lucide-upload class="w-6 h-6 text-purple-600" />
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-semibold text-slate-700 group-hover:text-purple-700">
                                        Haz clic para subir una imagen
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        PNG, JPG o WEBP (máx. 5MB)
                                    </p>
                                </div>
                            </label>
                        </div>

                        @error('formImagen')
                            <div class="flex items-center gap-2 text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                                <x-lucide-alert-circle class="w-3 h-3" />
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- PREVIEW DE IMAGEN -->
                    @if ($formImagen)
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-bold text-slate-700 uppercase tracking-wide">
                                    Vista previa de la nueva imagen
                                </p>
                                <button 
                                    type="button"
                                    wire:click="$set('formImagen', null)"
                                    class="text-xs text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                                    <x-lucide-x class="w-3 h-3" />
                                    Eliminar
                                </button>
                            </div>
                            <div class="relative w-full h-64 md:h-80 rounded-2xl border-2 border-purple-200 overflow-hidden bg-slate-100 shadow-lg group">
                                <img src="{{ $formImagen->temporaryUrl() }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
                                     alt="Vista previa" />
                                <div class="absolute inset-0 bg-gradient-to-t from-purple-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    @elseif ($formExistingImage)
                        <div class="space-y-3">
                            <p class="text-sm font-bold text-slate-700 uppercase tracking-wide">
                                Imagen actual registrada
                            </p>
                            <div class="relative w-full h-64 md:h-80 rounded-2xl border-2 border-slate-200 overflow-hidden bg-slate-100 shadow-lg group">
                                <img src="{{ $formExistingImage }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
                                     alt="Imagen registrada" />
                                <div class="absolute top-3 right-3">
                                    <span class="px-3 py-1.5 bg-slate-900/80 backdrop-blur text-white text-xs font-semibold rounded-full">
                                        Imagen actual
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- BOTONES DE ACCIÓN -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t-2 border-slate-100">
                    <a href="{{ route('denuncias.index') }}"
                       class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-all">
                        <x-lucide-x class="w-4 h-4" />
                        Cancelar
                    </a>
                    
                    <button
                        type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-xl hover:shadow-sky-500/40 transition-all hover:scale-105"
                    >
                        @if($mode === 'edit')
                            <x-lucide-check class="w-5 h-5" />
                            Actualizar denuncia
                        @else
                            <x-lucide-save class="w-5 h-5" />
                            Registrar denuncia
                        @endif
                    </button>
                </div>

            </form>
        </div>

        <!-- NOTA INFORMATIVA -->
        <div class="mt-6 p-4 bg-sky-50 border border-sky-200 rounded-2xl">
            <div class="flex gap-3">
                <div class="flex-shrink-0">
                    <x-lucide-info class="w-5 h-5 text-sky-600" />
                </div>
                <div class="text-sm text-sky-900">
                    <p class="font-semibold mb-1">Información importante</p>
                    <p class="text-sky-700">
                        Los campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios. 
                        Asegúrate de proporcionar información precisa para facilitar el seguimiento de la denuncia.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>