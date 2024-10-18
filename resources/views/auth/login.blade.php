@extends('mylayouts.app2')

@section('main')
    <section class="login d-flex flex-column justify-content-center align-items-center" style="height: 90vh">

        
        <div class="div_form div_form_login" style="width: 30%; border: 1px solid gray; padding: 2%; border-radius: 17px">
           
        <h2 class="mb-4">{{ __('se connecter') }}</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if (Route::has('password.request'))

                        <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    @endif

                <div class="d-flex flex-column align-items-center justify-content-end mt-5">
                
                    <button class="mb-3" type="submit" style="padding: 8px 20px; border-radius: 8px; width: fit-content; background: #0C97B5; color: #fff; border: none">
                        {{ __('Se connecter') }}
                    </button>
                    @if (Route::has('password.request'))
                    <p>{{ __('vous n\'avez pas de compte ') }}?<a class="link-secondary fw-bold link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('register') }}">
                            {{ __('s\'enregistrer') }}
                        </a></p>
                    @endif

                </div>
            </form>
        </div>
    </section>


@endsection

