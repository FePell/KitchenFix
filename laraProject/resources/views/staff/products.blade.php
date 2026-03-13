@extends('layouts.public')

{{-- Livello 3 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="staff-products-section">
        <div class="container">
            <h1 class="staff-page-title">Prodotti assegnati</h1>
            
            {{-- Lista dei Prodotti --------------------------------------------------------- --}}
            @foreach($products as $product)
                <div class="staff-product-card">
                    <h2 class="staff-product-title">{{ $product->name }}</h2>
                    <div class="staff-product-body">
                        <div class="staff-product-left">

                            {{-- Dettagli Prodotto ------------------------------------------ --}}
                            <table class="staff-table">
                                <thead>
                                    <tr>
                                        <th>Malfunzionamento</th>
                                        <th>Soluzione</th>
                                        <th>Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->malfunctions as $malfunction)
                                        <tr>
                                            <td>{{ $malfunction->description }}</td>
                                            <td>{{ $malfunction->solution }}</td>

                                            {{-- Azioni sul Prodotto ------------------------ --}}
                                            <td>
                                                <div class="staff-actions">
                                                    <a href="{{ route('staff.malfunctions.edit', $malfunction->id) }}" class="btn-edit">
                                                        Modifica
                                                    </a>
                                                    <form action="{{ route('staff.malfunctions.destroy', $malfunction->id) }}" 
                                                    method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-delete">
                                                            Elimina
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            {{-- -------------------------------------------- --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Nessun malfunzionamento presente.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- ------------------------------------------------------------ --}}

                            <a href="{{ route('staff.malfunctions.create', $product->id) }}" class="btn-add-malfunction">
                                + Aggiungi malfunzionamento
                            </a>
                        </div>

                        <div class="staff-product-right">
                            <img 
                                src="{{ asset('images/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="staff-product-image"
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
