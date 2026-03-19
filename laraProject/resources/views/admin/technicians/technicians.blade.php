@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="admin-section">
        <div class="container">

            <h1 class="page-title">Gestione tecnici</h1>

            {{-- Bottoni di switch ---------------------------------------------------------- --}}
            <div class="admin-technicians-tabs">
                <a href="{{ route('admin.technicians', ['technicianType' => 'staff']) }}"
                   class="admin-btn-tab {{ $technicianType === 'staff' 
                   ? 'active' 
                   : '' }}">
                    Staff Aziendale
                </a>
                <a href="{{ route('admin.technicians', ['technicianType' => 'assistance']) }}"
                   class="admin-btn-tab {{ $technicianType === 'assistance' 
                   ? 'active' 
                   : '' }}">
                    Tecnici Assistenza
                </a>
            </div>
            {{-- ---------------------------------------------------------------------------- --}}

            {{-- Bottone Aggiungi ----------------------------------------------------------- --}}
            @if($technicianType === 'staff')
                <a href="{{ route('admin.technicians.staff-create', ['technicianType' => 'staff']) }}" class="admin-btn-add">
                    + Aggiungi staff
                </a>
            @else
                <a href="{{ route('admin.technicians.assistance-create', ['technicianType' => 'assistance']) }}" class="admin-btn-add">
                    + Aggiungi tecnico
                </a>
            @endif
            {{-- ---------------------------------------------------------------------------- --}}

            <div class="admin-grid">

                {{-- Lista Staff ------------------------------------------------------------ --}}
                @if($technicianType === 'staff')
                    @foreach($staffTechnician as $technician)
                        <div class="admin-card">
                            <h2 class="admin-card-title">
                                {{ $technician->first_name }} {{ $technician->last_name }}
                            </h2>

                            {{-- Prodotti associati ----------------------------------------- --}}
                            @if($technician->products->isNotEmpty())
                                <div class="admin-card-info">
                                    <strong>Prodotti:</strong>
                                    @foreach($technician->products as $product)
                                        <span>{{ $product->name }}{{ !$loop->last 
                                            ? ',' 
                                            : '' }}</span>
                                    @endforeach
                                </div>
                            @endif
                            {{-- ------------------------------------------------------------ --}}

                            {{-- Azioni ----------------------------------------------------- --}}
                            <div class="admin-card-actions">
                                <a href="{{ route('admin.technicians.staff-edit', $technician->id) }}"
                                   class="admin-btn-edit">
                                    Modifica
                                </a>
                                <form action="{{ route('admin.technicians.staff-destroy', $technician->id) }}"
                                      method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-delete">
                                        Elimina
                                    </button>
                                </form>
                            </div>
                            {{-- ------------------------------------------------------------ --}}
                        </div>
                    @endforeach

                {{-- Lista Assistenza ------------------------------------------------------- --}}
                @else
                    @foreach($assistanceTechnician as $technician)
                        <div class="admin-card">
                            <h2 class="admin-card-title">
                                {{ $technician->first_name }} {{ $technician->last_name }}
                            </h2>

                            <div class="admin-card-info">
                                <strong>Specializzazione:</strong>
                                {{ $technician->specialization }}
                            </div>
                            <div class="admin-card-info">
                                <strong>Data di nascita:</strong>
                                {{ $technician->birth_date }}
                            </div>
                            <div class="admin-card-info">
                                <strong>Indirizzo centro:</strong>
                                {{ $technician->assistanceCenter->address }}
                            </div>

                            {{-- Azioni ----------------------------------------------------- --}}
                            <div class="admin-card-actions">
                                <a href="{{ route('admin.technicians.assistance-edit', $technician->id) }}"
                                   class="admin-btn-edit">
                                    Modifica
                                </a>
                                <form action="{{ route('admin.technicians.assistance-destroy', $technician->id) }}"
                                      method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-delete">
                                        Elimina
                                    </button>
                                </form>
                            </div>
                            {{-- ------------------------------------------------------------ --}}
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}
