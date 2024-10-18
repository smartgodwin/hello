@extends('mylayouts.app')

@section('titre')
    Reset Password
@endsection

@section('main')
<section class="login d-flex flex-column justify-content-center align-items-center" style="height: 90vh">
    <h2 class="mb-4">{{ __('Réinitialiser le mot de passe') }}</h2>

    <div class="div_form" style="width: 30%; border: 1px solid gray; padding: 2%; border-radius: 17px">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- E-mail --}}
            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            {{-- Password --}}
            <div class="form-group">
                <label for="password" class="form-label"> {{ __('mot de passe') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label for="password_confirmation" class="form-label">{{ __('Confirmez le mot de passe') }}</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="confirm password" required>
            </div>

                <button type="submit" style="padding: 8px; border-radius: 8px; background: #0C97B5; color: #fff; border: none">
                    {{ __('Réinitialiser le mot de passe') }}
                </button>
            </div>
        </form>
    </div>
</section>
@endsection









{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

     Password Reset Token 
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

         Email Address 
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         Password 
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

         Confirm Password 
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
