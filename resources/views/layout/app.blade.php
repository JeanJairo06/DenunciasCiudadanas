<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Denuncias Ciudadanas')</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    @include('layout.header')

    <main class="flex-1 max-w-7xl mx-auto px-4 py-10">
        @yield('content')
    </main>

    @include('layout.footer')

    @livewireScripts
    @vite('resources/js/app.js')
    @include('layout.confirm')
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/lucide.min.js"></script>
    <script>
        const initLucideIcons = () => window.lucide?.createIcons();

        document.addEventListener('livewire:load', () => {
            initLucideIcons();
            Livewire.hook('message.processed', () => initLucideIcons());
        });

        window.addEventListener('layout-confirm', initLucideIcons);
    </script>
</body>
</html>
