
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

        {{-- Caricamento jQuery x AJAX e contenuto JavaScript ------------------------------- --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            window.searchURL = "{{ route('products.index') }}";
            window.baseURL = "{{ url('')}}";
        </script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
