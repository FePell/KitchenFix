@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-centers-section">
        <div class="container">

            <h1 class="admin-page-title">Gestione centri assistenza</h1>
            <a href="{{ route('admin.centers.create') }}" class="admin-btn-add">
                + Aggiungi centro
            </a>

            <div class="admin-centers-grid">

                {{-- Lista dei Centri ------------------------------------------------------- --}}
                @foreach($centers as $center)
                    <div class="admin-center-card">

                        <h2 class="admin-center-title">
                            {{ $center->name }}
                        </h2>

                        {{-- Dettagli Centro ------------------------------------------------ --}}
                        <div class="admin-center-info">
                            <strong>Indirizzo:</strong>
                            {{ $center->address }}
                        </div>
                        {{-- ---------------------------------------------------------------- --}}

                        {{-- Azioni sul Centro ---------------------------------------------- --}}
                        <div class="admin-center-actions">
                            <a href="{{ route('admin.centers.edit', $center->id) }}"
                            class="admin-btn-edit">
                                Modifica
                            </a>
                            <form action="{{ route('admin.centers.destroy', $center->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="admin-btn-delete"
                                        onclick="return confirm('Sei sicuro di voler eliminare questo centro?')">
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