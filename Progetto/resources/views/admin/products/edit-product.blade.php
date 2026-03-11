@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-form-section">
        <div class="container">
            <div class="admin-form-card">

                <h1 class="admin-form-title">Modifica prodotto</h1>
                <p class="admin-form-subtitle">Aggiorna le informazioni del prodotto.</p>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="name">Nome prodotto</label>
                        <input type="text" name="name" id="name"
                            value="{{ old('name', $product->name) }}">
                        @error('name')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Immagine ----------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label>Immagine attuale</label>
                        <div class="admin-image-preview">
                            <img src="{{ asset('images/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="admin-image-preview-img">
                        </div>
                    </div>

                    <div class="admin-form-group">
                        <label for="image">Nuova immagine</label>
                        <input type="file" name="image" id="image">
                        @error('image')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                        <p class="admin-form-help">
                            Lascia vuoto se non vuoi cambiare l'immagine.
                        </p>
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Descrizione -------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Tecniche d'uso ----------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="usage_techniques">Tecniche d'uso</label>
                        <textarea name="usage_techniques" id="usage_techniques" rows="4">{{ old('usage_techniques', $product->usage_techniques) }}</textarea>
                        @error('usage_techniques')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Installazione ------------------------------------------------------ --}}
                    <div class="admin-form-group">
                        <label for="installation">Installazione</label>
                        <textarea name="installation" id="installation" rows="4">{{ old('installation', $product->installation) }}</textarea>
                        @error('installation')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni x Modifica -------------------------------------------------- --}}
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn-save">
                            Salva modifiche
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