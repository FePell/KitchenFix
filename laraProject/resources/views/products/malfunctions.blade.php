@extends('layouts.public')

{{-- Livello 2 ------------------------------------------------------------------------------ --}}
    @section('content')
    <section class="section-malfunctions-page">
        <div class="container">
            <h2 class="malfunctions-page-title">
                Malfunzionamenti di {{ $product->name }}
            </h2>

            {{-- Barra di ricerca ----------------------------------------------------------- --}}
            <div class="malfunctions-search">
                <form action="{{ route('products.malfunctions', $product->id) }}" method="GET" class="malfunctions-search-form">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cerca malfunzionamento..." 
                        value="{{ request('search') }}"
                    >
                    <button type="submit">Cerca</button>
                </form>
            </div>
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Lista dei Malfunzionamenti x Prodotto -------------------------------------- --}}
            <div class="malfunctions-main">
                @if(!isset($malfunctions) || $malfunctions->count() === 0)
                    @if(request('search'))
                        <p class="no-malfunctions">
                            Nessun risultato trovato per "{{ request('search') }}". Inserisci una parola completa.
                        </p>
                    @else
                        <p class="no-malfunctions">
                            Nessun malfunzionamento trovato per questo prodotto.
                        </p>
                    @endif
                @else
                    <div class="malfunctions-grid">
                        @foreach($malfunctions as $malfunction)
                            <article class="malfunction-card">
                                <p class="malfunction-description">
                                    <strong>Malfunzionamento:</strong> {{ $malfunction->description }}
                                </p>

                                <p class="malfunction-solution">
                                    <strong>Soluzione:</strong> {{ $malfunction->solution }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Bottone x tornare ai Prodotti ---------------------------------------------- --}}
            <div class="back-to-products">
                <a href="{{ route('products.index') }}" class="back-products-btn">
                    Torna al prodotto
                </a>
            </div>
            {{-- ---------------------------------------------------------------------------- --}}
        </div>
    </section>
    @endsection
{{-- ---------------------------------------------------------------------------------------- --}}
