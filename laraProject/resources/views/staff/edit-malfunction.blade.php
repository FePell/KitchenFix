@extends('layouts.public')

{{-- Livello 3 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">Modifica malfunzionamento</h1>

                <form action="{{ route('staff.malfunctions.update', $malfunction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Descrizione -------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="description">Malfunzionamento</label>
                        <input type="text" name="description" id="description"
                            value="{{ old('description', $malfunction->description) }}">
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Soluzione ---------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="solution">Soluzione</label>
                        <input type="text" name="solution" id="solution"
                            value="{{ old('solution', $malfunction->solution) }}">
                        @error('solution')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- -------------------------------------------------------------------- --}}

                    {{-- Azioni x Modifica -------------------------------------------------- --}}
                    <div class="form-actions">
                        <button type="submit" class="btn-save">Salva modifiche</button>
                        <a href="{{ route('staff.products') }}" class="btn-cancel">Annulla</a>
                    </div>
                    {{-- -------------------------------------------------------------------- --}}
                </form>
            </div>
        </div>
    </section>
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}