@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-section">
        <div class="container">

            <h1 class="page-title">Gestione centri assistenza</h1>
            <a href="{{ route('admin.centers.create') }}" class="admin-btn-add">
                + Aggiungi centro
            </a>

            <div class="admin-grid">

                {{-- Lista dei Centri ------------------------------------------------------- --}}
                @foreach($centers as $center)
                    <div class="admin-card">

                        <h2 class="admin-card-title">
                            {{ $center->name }}
                        </h2>

                        {{-- Dettagli Centro ------------------------------------------------ --}}
                        <div class="admin-card-info">
                            <strong>Indirizzo:</strong>
                            {{ $center->address }}
                        </div>
                        {{-- ---------------------------------------------------------------- --}}

                        {{-- Azioni sul Centro ---------------------------------------------- --}}
                        <div class="admin-card-actions">
                            <a href="{{ route('admin.centers.edit', $center->id) }}" class="admin-btn-edit">
                                Modifica
                            </a>
                            <form action="{{ route('admin.centers.destroy', $center->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="admin-btn-delete">
                                    Elimina
                                </button>
                            </form>
                        </div>
                        {{-- ---------------------------------------------------------------- --}}
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}