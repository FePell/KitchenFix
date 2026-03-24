@extends('layouts.public')

{{-- Livello 1-2 ---------------------------------------------------------------------------- --}}
    @section('content')
    <section class="section-products-page">
        <div class="container">
            <h2 class="page-title">Catalogo prodotti</h2>

            {{-- Barra di ricerca ----------------------------------------------------------- --}}
            <div class="search-wrapper">
                <form action="{{ route('products.index') }}" method="GET" class="search-form" id="search-form">
                    <input type="text" 
                           name="search" 
                           id="search"
                           placeholder="Cerca prodotto..." 
                           value="{{ request('search') }}">
                    <button type="submit">Cerca</button>
                </form>
            </div>
            <p class="search-error" id="search-error">
                @if(!empty($searchError))
                    {{ $searchError }}
                @endif
            </p>
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Lista dei Prodotti --------------------------------------------------------- --}}
            <div class="products-main" id="products-container">
                @if(!isset($products) || $products->count() === 0)
                    <p class="no-products">Nessun prodotto trovato.</p>
                @else
                    <div class="products-grid">
                        @foreach($products as $product)
                            <article class="product-card">

                                <div class="product-card-image">
                                    <img src="images/{{ $product->image }}" alt="{{ $product->name }}">
                                </div>

                                <div class="product-card-content">
                                    <h3 class="product-title">{{ $product->name }}</h3>

                                    <a href="{{ route('products.show', $product->id) }}" class="product-details-btn">
                                        Visualizza dettagli
                                    </a>
                                </div>

                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Bottone x resettare ricerca  ----------------------------------------------- --}}
            <div class="back-wrapper">
                <a href="{{ route('products.index') }}" class="btn-back">
                    Mostra tutti i prodotti
                </a>
            </div>
            {{-- ---------------------------------------------------------------------------- --}}
        </div>
    </section>
    @endsection
{{-- ---------------------------------------------------------------------------------------- --}}