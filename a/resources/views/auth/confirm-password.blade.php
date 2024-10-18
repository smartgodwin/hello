@extends('mylayouts.app2')

@section('titre')
    Confirm Password
@endsection

@section('main')
<section class="login d-flex flex-column justify-content-center align-items-center" style="height: 90vh">
    <h2 class="mb-4">{{ __('Confirmez le mot de passe') }}</h2>

    <div class="div_form" style="width: 30%; border: 1px solid gray; padding: 2%; border-radius: 17px">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

      

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

                <button class="ms-3" type="submit" style="padding: 8px; border-radius: 8px; background: #0C97B5; color: #fff; border: none">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
</section>
@endsection





{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
