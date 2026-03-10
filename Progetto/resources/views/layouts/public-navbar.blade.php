
{{-- Navbar - Livello 1-2-3-4 --------------------------------------------------------------- --}}
<nav class="navbar">
    <div class="nav-container">

        {{-- Parte sinistra (condivisa) ----------------------------------------------------- --}}
        <div class="nav-left">
            <a href="{{ url('/') }}" class="nav-logo">
                <img src="{{ asset('images/logo1.png') }}" alt="KitchenFix Logo">
            </a>
        </div>
        {{-- -------------------------------------------------------------------------------- --}}

        {{-- Parte centrale (differenziata) ------------------------------------------------- --}}
        <div class="nav-center">

            {{-- Livello 1 - Utente non registrato ------------------------------------------ --}}
            @guest
                <a href="{{ route('home') }}#chi-siamo" class="nav-link">Chi Siamo</a>
                <a href="{{ route('home') }}#prodotti" class="nav-link">Prodotti</a>
                <a href="{{ route('home') }}#centri" class="nav-link">Centri</a>
                <a href="{{ route('home') }}#contatti" class="nav-link">Contatti</a>
            @endguest
            {{-- ---------------------------------------------------------------------------- --}}

            @auth

                {{-- Livello 2 - Tecnico centro di assistenza ------------------------------- --}}
                @if(auth()->user()->role === 'technician')
                    <a href="{{ route('home') }}#chi-siamo" class="nav-link">Chi Siamo</a>
                    <a href="{{ route('home') }}#prodotti" class="nav-link">Prodotti</a>
                    <a href="{{ route('home') }}#centri" class="nav-link">Centri</a>
                    <a href="{{ route('home') }}#contatti" class="nav-link">Contatti</a>
                @endif

                {{-- Livello 3 - Tecnico dello staff ---------------------------------------- --}}
                @if(auth()->user()->role === 'staff')
                    <a href="{{ route('staff.products') }}" class="nav-link">Prodotti Assegnati</a>
                @endif

                {{-- Livello 4 - Amministratore --------------------------------------------- --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.products') }}" class="nav-link">Lista Prodotti</a>
                    <a href="{{ route('admin.technicians') }}" class="nav-link">Lista Tecnici</a>
                    <a href="{{ route('admin.centers') }}" class="nav-link">Lista Centri</a>
                @endif

            @endauth
        </div>
        {{-- -------------------------------------------------------------------------------- --}}

        {{-- Parte destra ------------------------------------------------------------------- --}}
        <div class="nav-right">

            @guest
                <a href="{{ route('login') }}" class="nav-button login-btn">Login</a>
            @endguest

            @auth
                <span class="nav-username">{{ auth()->user()->username }}</span>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="nav-button logout-btn">Logout</button>
                </form>
            @endauth
        </div>
        {{-- -------------------------------------------------------------------------------- --}}
    </div>
</nav>
{{-- ---------------------------------------------------------------------------------------- --}}

