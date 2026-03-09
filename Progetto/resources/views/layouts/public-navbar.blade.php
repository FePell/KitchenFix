
{{-- Navbar ------------------------------------------------------------------------------ --}}
<nav class="navbar">
    <div class="nav-container">

        {{-- Parte sinistra -------------------------------------------------------------- --}}
        <div class="nav-left">
            <a href="{{ url('/') }}" class="nav-logo">
                <img src="{{ asset('images/logo1.png') }}" alt="KitchenFix Logo">
            </a>
        </div>
        {{-- ----------------------------------------------------------------------------- --}}

        {{-- Parte centrale -------------------------------------------------------------- --}}
        <div class="nav-center">
            @guest
                <a href="{{ route('home') }}#chi-siamo" class="nav-link">Chi siamo</a>
                <a href="{{ route('home') }}#prodotti" class="nav-link">Prodotti</a>
                <a href="{{ route('home') }}#centri" class="nav-link">Centri</a>
                <a href="{{ route('home') }}#contatti" class="nav-link">Contatti</a>
            @endguest

            @auth
                @if(auth()->user()->role === 'technician')
                    <a href="{{ route('home') }}#chi-siamo" class="nav-link">Chi siamo</a>
                    <a href="{{ route('home') }}#prodotti" class="nav-link">Prodotti</a>
                    <a href="{{ route('home') }}#centri" class="nav-link">Centri</a>
                    <a href="{{ route('home') }}#contatti" class="nav-link">Contatti</a>
                @endif
            @endauth
        </div>
        {{-- ----------------------------------------------------------------------------- --}}

        {{-- Parte destra ---------------------------------------------------------------- --}}
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
        {{-- ----------------------------------------------------------------------------- --}}
    </div>
</nav>
