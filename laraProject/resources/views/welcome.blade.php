@extends('layouts.public')

{{-- Livello 1-2 ---------------------------------------------------------------------------- --}}
@section('content')

    {{-- Sezione Chi siamo ------------------------------------------------------------------ --}}
    <section id="chi-siamo" class="section-about">
        <div class="container">
            <h2>La nostra azienda</h2>
            <p>
                KitchenFix è specializzata nell’assistenza tecnica per elettrodomestici da cucina,
                offrendo supporto a tecnici e centri assistenza nella gestione degli interventi
                e nella consultazione delle informazioni sui prodotti.
            </p>
            <p>
                Attraverso la nostra piattaforma è possibile accedere a schede tecniche,
                individuare i problemi più frequenti e consultare soluzioni operative
                per forni, microonde, cappe, e altri dispositivi da cucina.
            </p>
            <p>
                Il nostro obiettivo è rendere il servizio di assistenza più rapido,
                preciso e organizzato, semplificando il lavoro quotidiano dei professionisti del settore.
            </p>
        </div>
    </section>
    {{-- ------------------------------------------------------------------------------------ --}}

    {{-- Sezione Prodotti ------------------------------------------------------------------- --}}
    <section id="prodotti" class="section-prodotti">
        <div class="container">
            <h2>I nostri prodotti</h2>

            <div class="prodotti-grid">
                <div class="prodotto-card">
                    <img src="{{ asset('images/micro1.png') }}" alt="Micro">
                </div>

                <div class="prodotto-card">
                    <img src="{{ asset('images/cappa1.png') }}" alt="Cappa">
                </div>

                <div class="prodotto-card">
                    <img src="{{ asset('images/forno1.png') }}" alt="Forno">
                </div>

                <div class="prodotto-card">
                    <img src="{{ asset('images/piano1.png') }}" alt="Piano">
                </div>
            </div>

            <div class="catalogo-button">
                <a href="{{ route('products.index') }}" class="btn-catalogo">
                    Esplora catalogo
                </a>
            </div>
        </div>
    </section>
    {{-- ------------------------------------------------------------------------------------ --}}

    {{-- Sezione Centri --------------------------------------------------------------------- --}}
    <section id="centri" class="section-centri">
        <div class="container">
            <h2>I nostri centri</h2>
            <div class="centri-container">
                @foreach($centers as $center)
                <div class="centro-card">
                    <h3>{{ $center->name }}</h3>
                    <p>{{ $center->address }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- ------------------------------------------------------------------------------------ --}}

    {{-- Sezione Contatti ------------------------------------------------------------------- --}}
    <section id="contatti" class="section-contatti">
        <div class="container contatti-bar">

            <h2>Contatti</h2>
            <div class="contatti-info">
                <span>Email: info@kitchenfix.it</span>
                <span class="divider">|</span>
                <span>Telefono: +39 000 000 000</span>
            </div>

        </div>
    </section>
    {{-- ------------------------------------------------------------------------------------ --}}

@endsection
{{-- ---------------------------------------------------------------------------------------- --}}
