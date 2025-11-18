@php
    $initialType = session('error') ? 'error' : (session('success') ? 'success' : null);
    $initialMessage = session('error') ?? session('success');
@endphp

<div
    x-data="{
        open: @js((bool) $initialType),
        type: @js($initialType),
        message: @js($initialMessage ?? ''),
        close() {
            this.open = false;
        },
        init() {
            window.addEventListener('layout-confirm', event => {
                this.type = event.detail.type;
                this.message = event.detail.message;
                this.open = true;
            });
        },
    }"
    x-init="init()"
    x-cloak
>
    <template x-if="open">
        <div x-transition.opacity class="modal modal-open modal-bottom sm:modal-middle" @click.self="close()">
            <div class="modal-box border-t-4 shadow-2xl text-center"
                 :class="type === 'error' ? 'border-red-600' : 'border-emerald-600'">
                <button
                    type="button"
                    class="btn btn-ghost btn-sm btn-circle absolute right-2 top-2 text-gray-400 hover:text-gray-600"
                    @click="close()"
                >
                    <x-lucide-x class="w-4 h-4" />
                </button>

                <div class="flex justify-center mb-4">
                    <template x-if="type === 'error'">
                        <x-lucide-circle-x class="w-12 h-12 text-red-600" />
                    </template>
                    <template x-if="type === 'success'">
                        <x-lucide-circle-check class="w-12 h-12 text-emerald-600" />
                    </template>
                </div>

                <h3 class="text-xl font-semibold mb-2"
                    :class="type === 'error' ? 'text-red-700' : 'text-emerald-700'">
                    <template x-if="type === 'error'">¡Error!</template>
                    <template x-if="type === 'success'">¡Éxito!</template>
                </h3>

                <p class="text-sm text-gray-600" x-text="message"></p>
            </div>
        </div>
    </template>
</div>
