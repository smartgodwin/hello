@extends('mylayouts.app')

@section('titre')
Carnet d'adresse
@endsection

@section('main')
<section class="section_page12">
    <div class="p-3 mb-3">
        <div class="d-flex justify-content-around mb-3">
            <div>
                <h1>Modifier l'adresse du carnet</h1>
            </div>
            <div class="add_btn">
                <a href="{{ route('carnet_adresses.index') }}" class=""><i class="fa-solid fa-arrow-left me-4"></i>Retour à la liste</a>
            </div>
        </div>

        <div class="container p-3">
            <form action="{{ route('carnet_adresses.update', $carnet_adresse->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="person_name">Nom & prénom</label>
                            <input type="text" name="person_name" value="{{ $carnet_adresse->person_name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="address_label">Localité (en souvenir)</label>
                            <input type="text" name="address_label" value="{{ $carnet_adresse->address_label }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="apartment_suite_note">Appartement, suite ou notes</label>
                    <input type="text" name="apartment_suite_note" value="{{ $carnet_adresse->apartment_suite_note }}" class="form-control" required>
                </div>

                <input type="hidden" name="has_google_address" value="0">

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="has_google_address" name="has_google_address" value="1" {{ $carnet_adresse->has_google_address ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_google_address">Ajouter une adresse Google</label>
                </div>

                <div class="form-group {{ $carnet_adresse->has_google_address ? '' : 'd-none' }}" id="google_address_field">
                    <label for="google_address">Adresse Google</label>
                    <input type="text" name="google_address" value="{{ $carnet_adresse->google_address }}" class="form-control" id="google_address">
                </div>

                <button type="submit" class="btn float-end" style="background-color: #0C97B5; color:white;">Modification</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
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
