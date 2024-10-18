@extends('mylayouts.app')

@section('titre')
Carnet d'adresse
@endsection

@section('main')
<section class="section_page12">

    <div class="p-3 mb-3">
        <div class="d-flex justify-content-around mb-3">
            <div class="ad_btn">
                <a href="{{ route('carnet_adresses.index') }}" class=""><i class="fa-solid fa-arrow-left me-4"></i>Retour</a>
            </div>
            <div>
                <h1>Adresse : {{$carnet_adresse->address_label}}</h1>
            </div>
        </div>

        <div class="container p-3">
            <div class="form-group">
                <label for="person_name">Nom & prénom</label>
                <input type="text" name="person_name" disabled value="{{ $carnet_adresse->person_name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address_label">Localité</label>
                <input type="text" name="address_label" disabled value="{{ $carnet_adresse->address_label }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apartment_suite_note">Appartment, suite ou note</label>
                <input type="text" name="apartment_suite_note" disabled value="{{ $carnet_adresse->apartment_suite_note }}" class="form-control">
            </div>
            @if ($carnet_adresse->has_google_address)
            <div class="form-group">
                <label for="google_address">Adresse Google</label>
                <input type="text" name="google_address" disabled value="{{ $carnet_adresse->google_address }}" class="form-control">
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow',
                readOnly: true // Mode lecture seule pour le show
            });

            var quillEditor = document.getElementById('quill-editor-area');

            // Remplir Quill Editor avec le contenu de l'adresse (si nécessaire)
            var noteContent = `{!! $carnet_adresse->apartment_suite_note !!}`; 
            editor.root.innerHTML = noteContent;
        }
    });
</script>
@endsection
