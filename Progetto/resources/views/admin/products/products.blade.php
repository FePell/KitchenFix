@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-products-section">
        <div class="container">
            
            <h1 class="admin-page-title">Gestione prodotti</h1>
                <a href="{{ route('admin.products.create') }}" class="admin-btn-add">
                    + Aggiungi prodotto
                </a>    

            {{-- Lista dei Prodotti --------------------------------------------------------- --}}
            @foreach($products as $product)
                <div class="admin-product-card">
                    <h2 class="admin-product-title">{{ $product->name }}</h2>
                    <div class="admin-product-body">
                        <div class="admin-product-left">

                            {{-- Dettagli Prodotto ------------------------------------------ --}}
                            <table class="admin-table">
                                <tbody>
                                    <tr>
                                        <th>Categoria</th>
                                        <td>{{ $product->category }}</td>
                                    </tr>
                                    <tr>
                                        <th>Descrizione</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Installazione</th>
                                        <td>{{ $product->installation }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- ------------------------------------------------------------ --}}

                            {{-- Azioni sul Prodotto ---------------------------------------- --}}
                            <div class="admin-actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="admin-btn-edit">
                                    Modifica
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="admin-btn-delete"
                                        onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?')">
                                        Elimina
                                    </button>
                                </form>
                            </div>
                            {{-- ------------------------------------------------------------ --}}

                        </div>

                        <div class="admin-product-right">
                            <img 
                                src="{{ asset('images/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="admin-product-image"
                            >
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- ---------------------------------------------------------------------------- --}}
        </div>
    </section>
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}