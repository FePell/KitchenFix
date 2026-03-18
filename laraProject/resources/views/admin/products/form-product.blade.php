@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">
                    {{ isset($product) 
                    ? 'Modifica' 
                    : 'Aggiungi' }} prodotto
                </h1>

                <p class="form-subtitle">
                    {{ isset($product) 
                    ? 'Aggiorna le informazioni del prodotto.' 
                    : 'Inserisci i dati del nuovo prodotto.' }}
                </p>

                <form action="{{ isset($product)
                        ? route('admin.products.update', $product->id)
                        : route('admin.products.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="name">Nome prodotto</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $product->name ?? '') }}">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Immagine ----------------------------------------------------------- --}}
                    @if(isset($product) && $product->image)
                        <div class="form-group">
                            <label>Immagine attuale</label>
                            <div class="form-image-preview">
                                <img src="{{ asset('images/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="form-image-preview-img">
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="image">
                            {{ isset($product) 
                            ? 'Nuova immagine' 
                            : 'Immagine prodotto' }}
                        </label>
                        <input type="file" name="image" id="image" accept="image/*">
                        @error('image')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        @if(isset($product))
                            <p class="form-help">
                                Lascia vuoto se non vuoi cambiare l'immagine.
                            </p>
                        @endif
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Descrizione -------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" id="description" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Tecniche d'uso ----------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="usage_techniques">Tecniche d'uso</label>
                        <textarea name="usage_techniques" id="usage_techniques" rows="4">{{ old('usage_techniques', $product->usage_techniques ?? '') }}</textarea>
                        @error('usage_techniques')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Installazione ------------------------------------------------------ --}}
                    <div class="form-group">
                        <label for="installation">Installazione</label>
                        <textarea name="installation" id="installation" rows="4">{{ old('installation', $product->installation ?? '') }}</textarea>
                        @error('installation')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni ------------------------------------------------------------- --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            {{ isset($product) 
                            ? 'Salva modifiche' 
                            : 'Conferma' }}
                        </button>
                        <a href="{{ route('admin.products') }}" class="btn-cancel">
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
