@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">
                    {{ isset($center) 
                    ? 'Modifica' 
                    : 'Aggiungi' }} centro di assistenza
                </h1>

                <p class="form-subtitle">
                    {{ isset($center) 
                    ? 'Aggiorna le informazioni del centro assistenza.' 
                    : 'Inserisci i dati del nuovo centro di assistenza.' }}
                </p>

                <form action="{{ isset($center)
                        ? route('admin.centers.update', $center->id)
                        : route('admin.centers.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($center))
                        @method('PUT')
                    @endif

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="name">Nome centro</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $center->name ?? '') }}">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Indirizzo ---------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="address">Indirizzo</label>
                        <input type="text" name="address" id="address"
                               value="{{ old('address', $center->address ?? '') }}">
                        @error('address')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni ------------------------------------------------------------- --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            {{ isset($center) 
                            ? 'Salva modifiche' 
                            : 'Conferma' }}
                        </button>

                        <a href="{{ route('admin.centers') }}" class="btn-cancel">
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
