@extends('layouts.public')

@section('content')
<section class="section-products-page">
    <div class="container">
        <h2 class="products-page-title">I nostri prodotti</h2>

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
        {{-- ---------------------------------------------------------------------------- --}}

        <div class="products-layout">
            {{-- Catalogo --------------------------------------------------------------- --}}
            <aside class="products-sidebar">
                <h4>Catalogo</h4>
                <ul class="categories-list">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="{{ !request('category') ? 'active' : '' }}">
                            Tutti i prodotti
                        </a>
                    </li>

                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category]) }}"
                               class="{{ request('category') == $category ? 'active' : '' }}">
                                {{ $category }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Lista dei Prodotti --------------------------------------------------------- --}}
            <div class="products-main">
                @if(!isset($products) || $products->count() === 0)
                    <p class="no-products">Nessun prodotto disponibile al momento.</p>
                @else
                    <div class="products-grid">
                        @foreach($products as $product)
                            <article class="product-card">

                                <div class="product-main">
                                    <div class="product-card-image">
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                                    </div>

                                    <div class="product-card-content">
                                        <h3 class="product-title">{{ $product->name }}</h3>

                                        <p class="product-description">
                                            <strong>Descrizione:</strong> {{ $product->description }}
                                        </p>

                                        <p class="product-installation">
                                            <strong>Installazione:</strong> {{ $product->installation }}
                                        </p>
                                    </div>
                                </div>

                                @auth
                                    @if(auth()->user()->role === 'technician')
                                        <div class="product-malfunctions">
                                            <h4>Malfunzionamenti</h4>

                                            @if($product->malfunctions && $product->malfunctions->count() > 0)
                                                <div class="malfunctions-list">
                                                    @foreach($product->malfunctions as $malfunction)
                                                        <div class="malfunction-item">
                                                            <p><strong>Descrizione:</strong> {{ $malfunction->description }}</p>
                                                            <p><strong>Soluzione:</strong> {{ $malfunction->solution }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="malfunction-item empty-malfunction">
                                                    Nessun malfunzionamento segnalato.
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endauth

                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
            {{-- ---------------------------------------------------------------------------- --}}
        </div>
    </div>
</section>
@endsection