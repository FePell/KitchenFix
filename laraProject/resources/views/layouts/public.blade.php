
{{-- Layout Generale ------------------------------------------------------------------------ --}}
<!doctype html>

<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KitchenFix</title>

        {{-- CSS pubblico (public/css/style.css) --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>

        {{-- Contenuto comune delle pagine -------------------------------------------------- --}}
        @include('layouts.public-navbar')

        {{-- Contenuto variabile delle pagine ----------------------------------------------- --}}
        <main class="public-main">
            @yield('content')
        </main>

        {{-- Contenuto JavaScript ----------------------------------------------------------- --}}
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
