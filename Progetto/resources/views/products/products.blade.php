@extends('layouts.public')

{{-- Livello 1-2 ---------------------------------------------------------------------------- --}}
    @section('content')
    <section class="section-products-page">
        <div class="container">
            <h2 class="products-page-title">Catalogo prodotti</h2>

            {{-- Barra di ricerca ----------------------------------------------------------- --}}
            <div class="products-search">
                <form action="{{ route('products.index') }}" method="GET" class="search-form">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cerca prodotto..." 
                        value="{{ request('search') }}"
                    >
                    <button type="submit">Cerca</button>
                </form>
            </div>

            @if(!empty($searchError))
                <p class="search-error">{{ $searchError }}</p>
            @endif
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Lista dei Prodotti --------------------------------------------------------- --}}
            <div class="products-main">
                @if(!isset($products) || $products->count() === 0)
                    <p class="no-products">Nessun prodotto disponibile al momento.</p>
                @else
                    <div class="products-grid">
                        @foreach($products as $product)
                            <article class="product-card">

                                <div class="product-card-image">
                                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
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
            <div class="reset-products-search">
                <a href="{{ route('products.index') }}" class="reset-products-btn">
                    Mostra tutti i prodotti
                </a>
            </div>
            {{-- ---------------------------------------------------------------------------- --}}
        </div>
    </section>
    @endsection
{{-- ---------------------------------------------------------------------------------------- --}}