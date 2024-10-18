@extends('mylayouts.app')

@section('titre')
{{ __('Carnet d\'adresse') }}
@endsection

@section('main')
<section class="section_page12">
    <div class="p-3 mb-3">
        <div class="d-flex justify-content-around mb-3">
            <div>
                <h1>{{ __('Ajouter une addresse au carnet') }}</h1>
            </div>
            <div class="add_btn">
                <a href="{{ route('carnet_adresses.index') }}" class=""><i class="fa-solid fa-arrow-left me-4"></i>{{ __('Retour à la liste') }}</a>
            </div>
        </div>

        <div class="container p-3">
            <form action="{{ route('carnet_adresses.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <label for="title">{{ __('Nom & prénom') }}</label>
                        <input type="text" name="person_name" class="form-control" required>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="title">{{ __('Localité') }} ({{ __('en souvenir') }})</label>
                            <input type="text" name="address_label" class="form-control" required>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="title">{{ __('Appartment, suit or notes') }}</label>
                    <input type="text" name="apartment_suite_note" class="form-control" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="has_google_address" name="has_google_address" value="1">
                    <label class="form-check-label" for="has_google_address">{{ __('Ajouter une adresse Google') }}</label>
                </div>

                <div class="form-group d-none" id="google_address_field">
                    <label for="google_address">{{ __('Adresse Google') }}</label>
                    <input type="text" name="google_address" class="form-control" id="google_address">
                </div>

                <button type="submit" class="btn float-end"
                    style="background-color: #0C97B5; color:white;">{{ __('Enregistrer') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {


        // Gérer l'affichage du champ "google_address" lorsque le checkbox est coché
        const googleAddressCheckbox = document.getElementById('has_google_address');
        const googleAddressField = document.getElementById('google_address_field');

        googleAddressCheckbox.addEventListener('change', function() {
            if (this.checked) {
                googleAddressField.classList.remove('d-none'); // Afficher le champ
            } else {
                googleAddressField.classList.add('d-none'); // Masquer le champ
                document.getElementById('google_address').value = ''; // Réinitialiser le champ
            }
        });
    });
</script>
@endsection
