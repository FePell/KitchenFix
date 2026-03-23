@extends('layouts.public')

{{-- Livello 1-2 ---------------------------------------------------------------------------- --}}
@section('content')

    {{-- Sezione Chi siamo ------------------------------------------------------------------ --}}
    <section id="chi-siamo" class="section-about">
        <div class="about-container">
            <h2>La nostra azienda</h2>

            <div class="about-intro">
                <p>
                    KitchenFix è un'azienda specializzata nell’assistenza tecnica per elettrodomestici da cucina.
                </p>
                <p>
                    La piattaforma è accessibile pubblicamente e consente a tutti gli utenti non autenticati di consultare
                    il catalogo dei prodotti, visualizzandone le schede tecniche, le descrizioni e le informazioni di utilizzo.
                </p>
                <p>
                    L’accesso alle funzionalità avanzate è riservato esclusivamente agli utenti autorizzati, i cui account
                    vengono creati e gestiti dall’amministratore. Il sistema prevede tre livelli di accesso.
                </p>
            </div>

            <div class="about-roles">
                <div class="role-card">
                    <h3>Tecnici di assistenza</h3>
                    <p>
                        Accedono al sito pubblico come gli utenti base, ma con funzionalità aggiuntive che permettono di
                        visualizzare, per ogni prodotto, i malfunzionamenti e le relative soluzioni tecniche.
                    </p>
                </div>

                <div class="role-card">
                    <h3>Tecnici dello staff</h3>
                    <p>
                        Accedono a un’area riservata in cui visualizzano i prodotti assegnati e possono aggiungere, 
                        modificare ed eliminare i malfunzionamenti e le relative soluzioni.
                    </p>
                </div>

                <div class="role-card">
                    <h3>Amministratore</h3>
                    <p>
                        Accede a un’area gestionale dedicata con la quale può gestire l’intero sistema aggiungendo,  
                        modificando ed eliminando i centri di assistenza, gli account dei tecnici e tutti i prodotti
                        dell'azienda, senza intervenire sui malfunzionamenti. 
                    </p>
                </div>
            </div>

            <div class="about-footer">
                <p>
                    Per assistenza o per richiedere informazioni relative alla creazione di un account, è possibile
                    contattare l’azienda tramite l’apposita sezione contatti.
                </p>
                <br>
                <a class="btn-home" href="{{ asset('docs/Tesina_KitchenFix.pdf') }}" target="_blank">
                    Visualizza tesina progetto
                </a>
            </div>
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
            <br><br>
            <a href="{{ route('products.index') }}" class="btn-home">
                    Esplora catalogo
            </a>
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
            <br><br>
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
