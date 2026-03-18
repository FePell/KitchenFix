@extends('layouts.public')

{{-- Livello 4 ------------------------------------------------------------------------------ --}}
@section('content')
    <section class="form-section">
        <div class="container">
            <div class="form-card">
                <h1 class="form-title">
                    {{ isset($technician) 
                    ? 'Modifica' 
                    : 'Aggiungi' }} tecnico staff
                </h1>

                <form action="{{ isset($technician)
                        ? route('admin.technicians.staff-update', $technician->id)
                        : route('admin.technicians.staff-store') }}"
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

                    {{-- Prodotti ----------------------------------------------------------- --}}
                    <div class="form-group">
                        <label>Prodotti associati</label>
                        <div class="admin-checkbox-grid">
                            @php
                                $checkedProducts = old('products', isset($technician) 
                                ? $technician->products->pluck('id')->toArray() 
                                : []);
                            @endphp
                            @foreach($products as $product)
                                <label class="admin-checkbox-item">
                                    <input type="checkbox" name="products[]" value="{{ $product->id }}"
                                        {{ in_array($product->id, $checkedProducts) 
                                        ? 'checked' 
                                        : '' }}>
                                    {{ $product->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('products')
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

                        <a href="{{ route('admin.technicians', ['technicianType' => 'staff']) }}" class="btn-cancel">
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
