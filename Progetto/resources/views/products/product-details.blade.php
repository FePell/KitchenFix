@extends('layouts.public')

{{-- Livello 1 ------------------------------------------------------------------------------ --}}
    @section('content')
    <section class="product-details-section">
        <div class="container">

            <div class="product-details-card">
                <div class="product-details-image">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                </div>

                <div class="product-details-info">
                    <h1 class="product-details-title">{{ $product->name }}</h1>

                    <div class="product-detail-item">
                        <h3>Descrizione</h3>
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="product-detail-item">
                        <h3>Tecniche d'uso</h3>
                        <p>{{ $product->usage_techniques }}</p>
                    </div>

                    <div class="product-detail-item">
                        <h3>Installazione</h3>
                        <p>{{ $product->installation }}</p>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'technician')
                            <div class="product-tech-actions">
                                <a href="{{ route('products.malfunctions', $product->id) }}" class="product-malfunctions-btn">
                                    Visualizza malfunzionamenti e soluzioni
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="product-details-back">
                <a href="{{ route('products.index') }}" class="back-btn">
                    Torna al catalogo
                </a>
            </div>

        </div>
    </section>
    @endsection
{{-- ---------------------------------------------------------------------------------------- --}}
