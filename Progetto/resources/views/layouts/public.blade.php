{{-- Layout Generale -------------------------------------- --}}

<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechSolve</title>

    {{-- CSS pubblico (public/css/style.css) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- NAVBAR (uguale per livello 1 e 2) --}}
    @include('layouts.public-navbar')

    {{-- Contenuto variabile delle pagine --}}
    <main class="public-main">
        @yield('content')
    </main>

</body>
</html>
