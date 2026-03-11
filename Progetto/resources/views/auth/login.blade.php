@extends('layouts.public')

{{-- ---------------------------------------------------------------------------------------- --}}
@section('content')
    <div class="auth-page">
        <div class="auth-card-simple">

            <h2>Accedi</h2>
            <p class="auth-subtitle">Inserisci le tue credenziali</p>

            {{-- Errori login --}}
            @if ($errors->any())
                <div style="color:red; margin-bottom:10px;">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" class="auth-form-inner">
                @csrf

                {{-- Inserimento dati ----------------------------------------------------------- --}}
                <label class="auth-label" for="username">Username</label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    class="auth-input"
                />

                <label class="auth-label" for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="auth-input"
                />
                {{-- ---------------------------------------------------------------------------- --}}

                <button type="submit" class="auth-btn">
                    Accedi
                </button>

            </form>
        </div>
    </div>
@endsection
{{-- ---------------------------------------------------------------------------------------- --}}