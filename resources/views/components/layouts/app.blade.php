<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @livewireStyles
</head>

<body>



    <main class="py-4">
        {{ $slot }}
    </main>


    @livewireScripts
</body>

</html>
