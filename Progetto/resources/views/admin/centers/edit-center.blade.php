@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-form-section">
        <div class="container">
            <div class="admin-form-card">

                <h1 class="admin-form-title">Modifica centro assistenza</h1>
                <p class="admin-form-subtitle">Aggiorna le informazioni del centro assistenza.</p>

                <form action="{{ route('admin.centers.update', $center->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="name">Nome centro</label>
                        <input type="text" name="name" id="name"
                            value="{{ old('name', $center->name) }}">
                        @error('name')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Indirizzo ---------------------------------------------------------- --}}
                    <div class="admin-form-group">
                        <label for="address">Indirizzo</label>
                        <input type="text" name="address" id="address"
                            value="{{ old('address', $center->address) }}">
                        @error('address')
                            <p class="admin-form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni x Modifica -------------------------------------------------- --}}
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn-save">
                            Salva modifiche
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