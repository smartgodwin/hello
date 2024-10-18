@extends('mylayouts.app2')

@section('titre')
    Forgot-password
@endsection

@section('main')
<section class="login d-flex flex-column justify-content-center align-items-center" style="height: 90vh">
    
    <div class="div_form_login" style="width: 30%; border: 1px solid gray; padding: 2%; border-radius: 17px">
        <div class="mb-4 text-sm text-gray">
            <h3> {{ __('Mot de passe oublié ') }}?</h3>
            <p>{{ __('Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous votre adresse électronique et nous vous enverrons un lien de réinitialisation du mot de passe qui vous permettra d\'en choisir un nouveau.') }}</p>
        </div>
        {{-- le message de success --}}
        @if (session('success'))
           
            <p class="text-success">{{ session('succès') }}</p>
                
        @endif


        <form method="POST" action="{{ route('password.email') }}">
            @csrf
    
            {{-- E-mail --}}
            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <button type="submit" style="padding: 8px; border-radius: 8px; background: #0C97B5; color: #fff; border: none">
                {{ __('Réinitialiser le mot de passe') }}
            </button>
        </form>
    </div>
</section>
@endsection











{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

      
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
