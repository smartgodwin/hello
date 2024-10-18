@extends('mylayouts.app')
@section('titre')
    {{ __('recherche') }}
@endsection
@section('main')
    <section class="section_page2">
        <div class="head_page2">
            <div class="head">
                <div class="ad_btn">
                    <a href="/address">{{ __('ajouter une adresse') }} <span><i class="ps-3 fa-solid fa-plus"></i></span></a>
                </div>
                <form method="POST" action="{{ route('address.doSearch') }}" style="width: 100%">
                    @csrf
                    <div class="search">
                        <input type="search" name="pseudo" id="search" placeholder="search...">
                        <button type="submit"><span><i class="fa-solid fa-magnifying-glass"></i></span></button>
                    </div>
                </form>
            </div>
        </div>

        @if (isset($addresses) && $addresses)
            <div class="page4_contener">
                @foreach ($addresses as $address)
                    <div class="seach_result mb-3">
                        <div class="result_img">
                            @if (isset($address->media) && $address->media->photo1)
                                <img src="{{ asset($address->media->photo1) }}" alt="Address Image">
                            @else
                                <img src="{{ asset('frontend/image/maison.jpg') }}" alt="Default Image">
                            @endif
                        </div>
                        <div class="resut_descrip">
                            <div class="result_info">
                                <h3 class="m-0">Adresse de {{ $address->user->name }}</h3>
                                <p class="m-0">{{ $address->adressName }}</p>
                            </div>

                            <div class="resut_btn d-flex justify-content-between align-items-center" style="width: 20%">
                                <!-- Formulaire pour ajouter aux favoris -->
                                <form id="add-favorie-form-{{ $address->id }}" action="{{ route('favories.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="address_id" value="{{ $address->id }}">
                                    <button type="button" class="btn" onclick="addFavorie({{ $address->id }})" style="background: none; border: none;">
                                        <span class="text-secondary">
                                            <i class="fa-solid fa-bookmark {{ $address->isFavorited ? 'text-primary' : 'text-muted' }}"></i>
                                        </span>
                                    </button>
                                </form>

                                <!-- Vérification du code PIN si nécessaire -->
                                @if ($address->codePin != null)
                                    <!-- Bouton pour ouvrir le modal -->
                                    <button type="button" class="btn btn-v" data-bs-target="#exampleModalToggle"
                                    data-bs-toggle="modal">
                                        {{ __('afficher') }}
                                    </button>
                                @else
                                    <a class="btn btn-v" href="{{ route('address.show', $address->id) }}">{{ __('afficher') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal pour vérifier le code PIN -->
                    {{-- le modal de verification de code pin --}}
                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                            tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal_contener">
                                    {{-- <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">notification</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> --}}

                                    <div class="modal-body moda_body">
                                        {{ __('Cette adresse est privée,') }}
                                    {{__(' saisissez le code pin ou envoyez une demande d\'accès')}}
                                    </div>
                                    @if (isset($address) && $address)
                                        <div class="modal-footer modal_btn">
                                            <button class="btn btn-v" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">{{ __('j\'ai le code pin') }}</button>
                                            <form class="w-100 display-contents" method="POST"
                                                action="{{ route('address.requestPin', $address->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-o">{{ __('demander un pin') }}</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal_contener">

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (isset($address) && $address)
                                    <form class="w-100" action="{{ route('address.validatePin', $address->id) }}" method="post">
                                        <div class="modal-body moda_body">
                                            <div class="pin_form">
                                                <div class="pin_form">
                                                    @csrf
                                                    <input type="number" name="full_pin" id="full_pin"  >
                                                </div>
                                            </div>
                                            <div class="modal-footer modal_btn">
                                                <button class="btn btn-v" data-bs-target="#exampleModalToggle"
                                                    data-bs-toggle="modal">retour</button>
                                                <button type="submit" class=" btn-o">{{ __('valider') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="page3_message">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        @endif
    </section>

    <script>
        // Fonction pour ajouter l'adresse aux favoris
        function addFavorie(addressId) {
            let form = document.getElementById('add-favorie-form-' + addressId);
            let formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Changer la couleur de l'icône de favori
                    let bookmarkIcon = form.querySelector('i.fa-bookmark');
                    bookmarkIcon.classList.remove('text-muted');
                    bookmarkIcon.classList.add('text-primary');
                    alert('Adresse ajoutée aux favoris avec succès!');
                } else {
                    alert('Échec de l\'ajout de l\'adresse aux favoris.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue.');
            });
        }

        // Fonction pour valider le code PIN via AJAX
        document.getElementById('pinForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const pinInputs = document.querySelectorAll('input[name="pin[]"]');
            let fullPin = '';
            pinInputs.forEach(input => {
                fullPin += input.value;
            });
            document.getElementById('full_pin').value = fullPin;
            this.submit();
        });
    </script>
    </script>

@endsection
