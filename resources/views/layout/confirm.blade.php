@if(session('error') || session('success'))
<input type="checkbox" id="feedback-modal" class="modal-toggle" checked />
<div class="modal" role="dialog">
    <label for="feedback-modal" class="modal-backdrop backdrop-blur-sm"></label>
    <div class="modal-box border-t-4 max-w-sm shadow-xl relative text-center 
              {{ session('error') ? 'border-red-600' : 'border-green-600'}} ">

        <!-- Botón de cierre -->
        <label for="feedback-modal" class="absolute top-2 right-2 cursor-pointer text-gray-400 hover:text-red-600 transition">
            <x-lucide-x class="w-6 h-6" />
        </label>

        <!-- Icono dinámico -->
        <div class="flex justify-center mb-4">
            @if(session('error'))
            <x-lucide-circle-x class="w-12 h-12 text-red-600" />
            @else
            <x-lucide-circle-check class="w-12 h-12 text-green-600" />
            @endif
        </div>

        <!-- Título dinámico -->
        <h3 class="text-xl font-semibold mb-2 
                {{ session('error') ? 'text-red-700' : 'text-green-700' }}">
            {{ session('error') ? '¡Error!' : '¡Éxito!' }}
        </h3>

        <!-- Mensaje desde el controlador -->
        <p class="text-sm text-gray-600">
            {{ session('error') ?? session('success') }}
        </p>
    </div>
</div>
@endif