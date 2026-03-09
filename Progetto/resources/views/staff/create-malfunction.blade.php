@extends('layouts.public')

@section('content')
<section class="staff-form-section">
    <div class="container">
        <div class="staff-form-card">
            <h1 class="staff-form-title">Aggiungi malfunzionamento</h1>
            <p class="staff-form-subtitle">
                Prodotto: <strong>{{ $product->name }}</strong>
            </p>

            <form action="{{ route('staff.malfunctions.store', $product->id) }}" method="POST">
                @csrf

                <div class="staff-form-group">
                    <label for="description">Malfunzionamento</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}">
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="staff-form-group">
                    <label for="solution">Soluzione</label>
                    <input type="text" name="solution" id="solution" value="{{ old('solution') }}">
                    @error('solution')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="staff-form-actions">
                    <button type="submit" class="btn-save">Conferma</button>
                    <a href="{{ route('staff.products') }}" class="btn-cancel-link">Annulla</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection