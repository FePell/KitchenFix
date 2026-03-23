@extends('layouts.public')

{{-- Livello 1-2 ---------------------------------------------------------------------------- --}}
@section('content')

    {{-- Sezione Chi siamo ------------------------------------------------------------------ --}}
    <section id="chi-siamo" class="section-about">
        <div class="container">
            <h2>La nostra azienda</h2>
            <p>
                KitchenFix è un'azienda specializzata nell’assistenza tecnica per elettrodomestici da cucina.
            </p>
            <p>
                La nostra piattaforma permette la visualizzazione delle schede tecniche dei prodotti dell'azienda
                a tutti coloro che non sono registrati, mentre offre informazioni aggiuntive a tutti
                i tecnici dei centri di assistenza ai quali è stato assegnato un account.
            </p>
            <p>
                Un particolare ringraziamento ai tecnici dello staff, che si occupano periodicamente di gestire
                i propri prodotti, aggiornando i loro malfunzionamenti e fornendo le opportune soluzioni, e al nostro 
                amministratore che gestisce l'intero sito, aggiornando le semplici schede prodotto, i centri di 
                assistenza e tutto il gruppo di tecnici, fornendo i rispettivi account.
            </p>
            <p>
                Per assistenza o informazioni riguardo la creazione di un account contattateci pure visualizzando
                l'opportuna sezione contatti.
            </p>
            <a href="{{ asset('docs/Tesina_KitchenFix.pdf') }}" target="_blank">
                Visualizza tesina progetto
            </a>
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
                <span>Telefono: +39 071 676 767</span>
            </div>

        </div>
    </section>
    {{-- ------------------------------------------------------------------------------------ --}}
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}
