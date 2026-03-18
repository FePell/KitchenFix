@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">
                    {{ isset($technician) ? 'Modifica' : 'Aggiungi' }} tecnico assistenza
                </h1>

                <form action="{{ isset($technician)
                        ? route('admin.technicians.assistance-update', $technician->id)
                        : route('admin.technicians.assistance-store') }}"
                      method="POST">
                    @csrf
                    @if(isset($technician))
                        @method('PUT')
                    @endif

                    {{-- Nome --------------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="first_name">Nome</label>
                        <input type="text" name="first_name" id="first_name"
                               value="{{ old('first_name', $technician->first_name ?? '') }}">
                        @error('first_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Cognome ------------------------------------------------------------ --}}
                    <div class="form-group">
                        <label for="last_name">Cognome</label>
                        <input type="text" name="last_name" id="last_name"
                               value="{{ old('last_name', $technician->last_name ?? '') }}">
                        @error('last_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Data di nascita ---------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="birth_date">Data di nascita</label>
                        <input type="date" name="birth_date" id="birth_date"
                               value="{{ old('birth_date', $technician->birth_date ?? '') }}">
                        @error('birth_date')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Specializzazione --------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="specialization">Specializzazione</label>
                        <input type="text" name="specialization" id="specialization"
                               value="{{ old('specialization', $technician->specialization ?? '') }}">
                        @error('specialization')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Indirizzo di Assistenza -------------------------------------------- --}}
                    <div class="form-group">
                        <label for="assistance_center_id">Centro di assistenza</label>
                        <select name="assistance_center_id" id="assistance_center_id">
                            <option value="">Seleziona indirizzo centro</option>
                            @foreach($centers as $center)
                                <option value="{{ $center->id }}"
                                    {{ old('assistance_center_id', $technician->assistance_center_id ?? '') == $center->id 
                                    ? 'selected' 
                                    : '' }}>
                                    {{ $center->address }}
                                </option>
                            @endforeach
                        </select>
                        @error('assistance_center_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Username ----------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                               value="{{ old('username', $technician->user->username ?? '') }}">
                        @error('username')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Password ----------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="password">
                            Password {{ isset($technician) 
                            ? '(lascia vuoto per non modificare)' 
                            : '' }}
                        </label>
                        <input type="password" name="password" id="password">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni ------------------------------------------------------------- --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            {{ isset($technician) 
                            ? 'Salva modifiche' 
                            : 'Conferma' }}
                        </button>

                        <a href="{{ route('admin.technicians', ['technicianType' => 'assistance']) }}" class="btn-cancel">
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
