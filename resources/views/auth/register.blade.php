@extends('mylayouts.app2')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@endsection
@section('main')
    <section class="login d-flex flex-column justify-content-center align-items-center">
        <h2 class="mb-4">{{ __('S\'enregistrer') }}</h2>

        <div class="div_form" style="width: 30%; border: 1px solid gray; padding: 2%; border-radius: 17px">
           <form id="login" action="{{ route('register') }}" method="POST" onsubmit="process(event)">
            @csrf
                {{-- action="{{ route('register') }}" --}}
                {{-- Name --}}
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Nom prenom') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" placeholder="ex: jean Marck" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- E-mail --}}
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone number --}}
                <div class="form-group">
                    <label for="phone_number" class="form-label">{{ __('Numéro de téléphone') }}</label><br>
                    
                    <input class="form-control" id="phone" type="tel" name="phone_number"/>
                    <input type="text" hidden id="full_phone_number" name="phone"  >
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">{{ __('Confirmez le mot de passe') }}</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                        placeholder="confirm password" required>
                </div>

                <div class="d-flex flex-column align-items-center justify-content-end mt-5">
                
                    <button class="mb-3" type="submit"
                        style="padding: 8px 20px; border-radius: 8px; width: fit-content; background: #0C97B5; color: #fff; border: none">
                        {{ __('S\'enregistrer') }}
                    </button>
                    
                    @if (Route::has('login'))
                        <p>{{ __('Vous avez un compte') }}? <a
                                class="link-secondary fw-bold link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                href="{{ route('login') }}">
                                {{ __('Se connecter') }}
                            </a></p>
                    @endif

                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
<script>
    const phoneInputField = document.querySelector("#phone");
       const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "",
        separateDialCode: true, 
         utilsScript:
           "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       });

       
    function process(event) {
        event.preventDefault();
        
        const phoneNumber = phoneInput.getNumber();
        const countryData = phoneInput.getSelectedCountryData();
        const countryCode = countryData.dialCode;
            
        const phoneNumberWithoutPlus = phoneNumber.replace("+", "");
        document.querySelector("#full_phone_number").value = phoneNumberWithoutPlus;
        console.log("Numéro sans le signe + : " + phoneNumberWithoutPlus);
        
        setTimeout(() => {
        event.target.submit();
        }, 500);
    }
</script>

    
@endsection
