@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-form-section">
        <div class="container">
            <div class="admin-form-card">
                <h1 class="admin-form-title">Aggiungi prodotto</h1>

                <p class="admin-form-subtitle">
                    Inserisci i dati del nuovo prodotto.
                </p>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="name">Nome prodotto</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Immagine ----------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="image">Immagine prodotto</label>
                        <input type="file" name="image" id="image" accept="image/*">
                        @error('image')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Descrizione -------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}
                    
                    {{-- Tecniche d'uso ----------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="usage_techniques">Tecniche d'uso</label>
                        <textarea name="usage_techniques" id="usage_techniques" rows="4">{{ old('usage_techniques') }}</textarea>
                        @error('usage_techniques')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Installazione ------------------------------------------------------ --}}
                    <div class="admin-form-group">
                        <label for="installation">Installazione</label>
                        <textarea name="installation" id="installation" rows="4">{{ old('installation') }}</textarea>
                        @error('installation')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni x Creazione ------------------------------------------------- --}}
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn-save">
                            Conferma
                        </button>
                        <a href="{{ route('admin.products') }}" class="admin-btn-cancel-link">
                            Annulla
                        </a>
                    </div>
                    {{-- -------------------------------------------------------------------- --}}
                </form>
            </div>
        </div>
    </section>
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}