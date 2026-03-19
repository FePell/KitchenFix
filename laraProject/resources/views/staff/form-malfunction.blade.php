@extends('layouts.public')

{{-- Livello 3 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">
                    {{ isset($malfunction) 
                    ? 'Modifica' 
                    : 'Aggiungi' }} malfunzionamento
                </h1>

                <form action="{{ isset($malfunction)
                        ? route('staff.malfunctions.update', $malfunction->id)
                        : route('staff.malfunctions.store', $product->id) }}"
                      method="POST">
                    @csrf
                    @if(isset($malfunction))
                        @method('PUT')
                    @endif

                    {{-- Descrizione -------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="description">Malfunzionamento</label>
                        <input type="text" name="description" id="description" 
                               value="{{ old('description', $malfunction->description ?? '') }}">
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Soluzione ---------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="solution">Soluzione</label>
                        <input type="text" name="solution" id="solution" 
                               value="{{ old('solution', $malfunction->solution ?? '') }}">
                        @error('solution')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni ------------------------------------------------------------- --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            {{ isset($malfunction) 
                            ? 'Salva modifiche' 
                            : 'Conferma' }}
                        </button>
                        <a href="{{ route('staff.products') }}" class="btn-cancel">
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
