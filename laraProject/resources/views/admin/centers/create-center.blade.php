@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-form-section">
        <div class="container">
            <div class="admin-form-card">
                <h1 class="admin-form-title">Aggiungi centro di assistenza</h1>

                <p class="admin-form-subtitle">
                    Inserisci i dati del nuovo centro di assistenza.
                </p>

                <form action="{{ route('admin.centers.store') }}" method="POST">
                    @csrf

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="name">Nome centro</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Indirizzo ---------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="address">Indirizzo</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}">
                        @error('address')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni x Creazione ------------------------------------------------- --}}
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn-save">
                            Conferma
                        </button>

                        <a href="{{ route('admin.centers') }}" class="admin-btn-cancel-link">
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