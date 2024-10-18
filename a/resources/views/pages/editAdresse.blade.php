@extends('mylayouts.app2')

@section('titre')
    {{ __('Edit Adresse') }}
@endsection

@section('main')
@if (session('sucess'))
    <div class="toast align-items-center position-absolute text-bg-info float-end" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
            {{ session('sucess') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
  @endif
    <section class="section_page5">
        <div class="page5_contener w-70">
           

           
        @if (isset($address) && $address)    
            <div class="div_form_contener flex-column">
                <div class="detail d-flex">
                    <div class="div_form">
                        <div class="detail_title d-flex align-items-center mb-5">
                        @if ($address->media && $address->media->photo1)
                            <img class="w-40" src="{{ asset($address->media->photo1) }}" alt="Address Image">
                        @else
                            <img class="w-40" src="{{ asset('frontend/image/maison.jpg') }}" alt="Default Image">
                        @endif
                            <div class="detail_title_text ms-3">
                                <h2 class="m-0 p-0">{{ $address->adressName }}</h2>
                                <p class="m-0 p-0"> {{ $address->city }}</p>
                                <p class="m-0 p-0">{{ __('Adresse de') }}: {{ $address->user->name }}</p>
                            </div>
                        </div>


                        <div class="detail_info text-wrap w-70 mb-4 p-3 rounded border border-secondary-subtle">
                            <p class="w-100">
                                {{ $address->info }}
                            </p>
                        </div>

                        <div class="detail_audio mt-5">
                            <h2>{{ __('Vocaux de référence') }}</h2>
                            <div class="d-flex w-70 ">
                                <audio controls class="" name="audio1" ></audio>
                                <audio controls class="ms-2" name="audio2" ></audio>
                            </div>
                        </div>
                    </div>

                    <div class="div_media">
                        <div class="detail_image">
                            <h2>{{ __('Images d’adresse') }}</h2>
                            <div class="image d-flex w-70">
                                @if ($address->media && $address->media->photo1 && $address->media->photo2)
                                    <img class="w-40" src="{{ asset( $address->media->photo1) }}" alt="Address Image">
                                    <img class="w-40 ms-4" src="{{ asset( $address->media->photo2) }}" alt="Address Image">
                                @else
                                    <img class="w-40" src="{{ asset('frontend/icons/SourcesMedia_Jeff/Images/imageMaisonCapTown.jpeg') }}" alt="">
                                    <img class="w-40 ms-4" src="{{ asset('frontend/icons/SourcesMedia_Jeff/Images/imageRue_d_AfriqueGarage.jpeg') }}" alt="">
                                @endif
                            </div>
                        </div>

                        <div class="detail_video mt-5">
                            <h2>{{ __('Vidéos de référence') }}</h2>
                            <div class="video d-flex w-70">
                                @if ($address->media && $address->media->video1 && $address->media->video2)
                                <video class="w-40" height="100%" controls>
                                    <source src="{{ asset( $address->media->video1) }}" >
                                       {{__(' Votre navigateur ne supporte pas la balise ')}}
                                </video>
                                <video class="w-40 ms-4" height="100%" controls>
                                    <source src="{{ asset( $address->media->video2) }}" >
                                      {{__('  Votre navigateur ne supporte pas la balise ')}}
                                </video>
                                @else
                                    <img class="w-40" src="{{ asset('frontend/icons/SourcesMedia_Jeff/Images/imageMaisonCapTown.jpeg') }}" alt="">
                                    <img class="w-40 ms-4" src="{{ asset('frontend/icons/SourcesMedia_Jeff/Images/imageRue_d_AfriqueGarage.jpeg') }}" alt="">
                                @endif
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 border-top pt-5 pb-5 d-flex justify-content-around align-items-center">
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-v p-3 w-40" href="#">{{ __('Modifier') }}</a>
                    <form class="w-40" action="{{ route('address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette adresse ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger p-3 w-100">{{ __('Supprimer') }}</button>
                    </form>
                </div>
            </div>
        @endif  
           

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Mettre à jour l\'adresse') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="page5_contener w-100">
                            <form class="w-100" method="POST" action="{{ route('address.update', $address->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="div_form_contener">
                                    <div class="div_form">
                                        @if ($errors->any())
                                            <ul class="alert alert-danger d-flex flex-column justify-content-center">
                                                @foreach ($errors->all() as $error)
                                                    <li class="list-unstyled">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
        
                                        <!-- Identifiant -->
                                        <div class="form-group">
                                            <label for="pseudo" class="form-label">{{ __('Identifiant') }}</label>
                                            <input type="text" class="form-control @error('pseudo') is-invalid @enderror" name="pseudo" id="pseudo" value="{{ old('pseudo', $address->pseudo) }}" placeholder="Identifiant de votre adresse">
                                            @error('pseudo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
        
                                        <!-- Adresse -->
                                        <div class="form-group">
                                            <label for="adresse" class="form-label">{{ __('Nom de l’adresse') }}</label>
                                            <input type="text" class="form-control" name="adressName" id="adresse" value="{{ old('adressName', $address->adressName) }}" placeholder="Maison IDAH">
                                        </div>
        
                                        <!-- Pays, ville, quartier ou rue -->
                                        <div class="form-group">
                                            <label for="localisation" class="form-label">{{ __('Pays, ville, quartier ou rue') }}</label>
                                            <input type="text" class="form-control" name="city" id="localisation" value="{{ old('city', $address->city) }}" placeholder="Country, Town, City">
                                        </div>
        
                                        <!-- Google Address -->
                                        <div class="form-group">
                                            <label class="form-label" for="googleAddress">{{ __('Utiliser ma position actuelle') }}/Your Google Address</label>
                                            <input type="text" id="googleAddress" class="form-control" name="googleAddress" value="{{ old('googleAddress', $address->googleAddress) }}" placeholder="Street, city, state/region, Zip code, Country">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="checkbox" class="form-check-input" id="useCurrentPosition">
                                            <label class="form-check-label" for="useCurrentPosition">{{ __('Utiliser ma position actuelle') }}</label>
                                        </div>
                                        {{-- la latitude  et la longitude actuel --}}
                                        <div class="form-group ">
                                            <input type="text" class="form-control" value="{{ old('latitude', $address->latitude) }}, {{ old('longitude', $address->longitude) }}" id="location">
                                        </div>
                                        <!-- Latitude & Longitude -->
                                        <input type="hidden" name="latitude" value="{{ old('latitude', $address->latitude) }}" id="latitude">
                                        <input type="hidden" name="longitude" value="{{ old('longitude', $address->longitude) }}" id="longitude">
        
                                        <!-- Code PIN -->
                                        <div class="form-group">
                                            <label for="codePin" class="form-label">{{ __('Créez un CODE PIN') }}</label>
                                            <input type="password" class="form-control" name="codePin" id="codePin" value="{{ old('codePin', $address->codePin) }}" placeholder="code pin">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="confirmCodePin" placeholder="Confirmez le code pin">
                                        </div>
        
                                        <!-- Info adresse -->
                                        <div class="form-group">
                                            <label for="infoAddress" class="form-label">{{ __('Info adresse') }}</label>
                                            <textarea class="form-control @error('info') is-invalid @enderror" id="infoAddress" name="info" rows="3" placeholder="Longez tout droit vers ...">{{ old('info', $address->info) }}</textarea>
                                            @error('info')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="div_media">
                                        <!-- Images -->
                                        <div class="form-group">
                                            <label for="photo1" class="form-label fs-4">{{ __('Ajoutez images de la localité') }}</label>
                                            <div class="img_upload">
                                                <label for="photo1" class="imglabel">
                                                    <span><img src="{{ asset('frontend/icons/Icone photo add.png') }}" alt=""></span>{{ __('Sélectionnez une image') }}
                                                    <img id="preview1" src="{{ old('photo1', asset( $address->media->photo1)) }}" alt="Preview" style="display:block; position:absolute; width: 100%; height: auto;"/>
                                                </label>
                                                <input class="input" name="photo1" id="photo1" type="file" accept="image/jpeg, image/png, image/jpg, image/gif"/>
                                                <label for="photo2" class="imglabel">
                                                    <span><img src="{{ asset('frontend/icons/Icone photo add.png') }}" alt=""></span>{{ __('Sélectionnez une image') }}
                                                    <img id="preview2" src="{{ old('photo2', asset( $address->media->photo2)) }}" alt="Preview" style="display:block; position:absolute; width: 100%; height: auto;"/>
                                                </label>
                                                <input class="input" name="photo2" id="photo2" type="file" accept="image/jpeg, image/png, image/jpg, image/gif"/>
                                            </div>
                                        </div>
        
                                        <!-- Audio & Video (commenté pour l'instant) -->
                                        <!-- Vous pouvez décommenter cette section pour gérer les fichiers audio et vidéo -->
                                        
                                        <!-- Vidéo -->
                                        <div class="form-group">
                                            <label for="video1" class="form-label fs-4">{{ __('Vidéo de référencement') }}</label>
                                            <div class="video_upload">
                                                <label for="video1" class="videolabel"><span><img width="40" height="40" src="{{ asset('frontend/icons/Icone Rec video.png') }}" alt=""></span>{{ __('Sélectionnez une vidéo') }}</label>
                                                <input class="input" name="video1" id="video1" type="file" accept="video/*"/>
                                                <label for="video2" class="videolabel"><span><img width="40" height="40" src="{{ asset('frontend/icons/Icone Rec video.png') }}" alt=""></span>{{ __('Sélectionnez une vidéo') }}</label>
                                                <input class="input" name="video2" id="video2" type="file" accept="video/*"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </section>
@endsection

@section('script')
    <script>
        // alert('Pour votre adresse veillé choisir soit la position actuel ou le google adress')
        // pour protect adress


// pour recupere la position
document.addEventListener('DOMContentLoaded', function () {
    const useCurrentPositionCheckbox = document.getElementById('useCurrentPosition');

    const latitude = document.getElementById('latitude');
    const longitude = document.getElementById('longitude');
    const location = document.getElementById('location');

    useCurrentPositionCheckbox.addEventListener('change', function () {
        if (this.checked) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const Platitude = position.coords.latitude;
                    const Plongitude = position.coords.longitude;

                    latitude.value = Platitude;
                    longitude.value = Plongitude;
                    location.value = `longitude: ${Plongitude}, latitude: ${Platitude}`; // correction ici
                }, function (error) {
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            alert('User denied the request for Geolocation.');
                            break;
                        case error.POSITION_UNAVAILABLE:
                            alert('Location information is unavailable.');
                            break;
                        case error.TIMEOUT:
                            alert('The request to get user location timed out.');
                            break;
                        case error.UNKNOWN_ERROR:
                            alert('An unknown error occurred.');
                            break;
                    }
                    console.error('Error obtaining location:', error);
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000, // 10 seconds
                    maximumAge: 0
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        } else {
            latitude.value = '';
            longitude.value = '';
            location.value = '';
        }
    });
});




// pour les enregistrement audio
    let mediaRecorder;
let audioChunks = [];
let recordingStep = 1;
let audioBlobs = [null, null];

navigator.mediaDevices.getUserMedia({ audio: true })
    .then(stream => {
        mediaRecorder = new MediaRecorder(stream);

        mediaRecorder.ondataavailable = event => {
            audioChunks.push(event.data);
        };

        mediaRecorder.onstop = () => {
            const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
            audioBlobs[recordingStep - 1] = audioBlob;

            const audioUrl = URL.createObjectURL(audioBlob);
            if (recordingStep === 1) {
                document.querySelector('#audio1Preview').src = audioUrl;
                document.querySelector('#audio1Preview').classList.remove('hidden');
                recordingStep = 2;
            } else {
                document.querySelector('#audio2Preview').src = audioUrl;
                document.querySelector('#audio2Preview').classList.remove('hidden');
                recordingStep = 1;
            }

            audioChunks = [];
        };
    })
    .catch(error => {
        console.error('Error accessing microphone:', error);
    });

document.querySelector('#recordBtn').addEventListener('click', () => {
    const recordBtn = document.querySelector('#recordBtn');
    if (mediaRecorder.state === 'recording') {
        mediaRecorder.stop();
        recordBtn.classList.remove('recording');
    } else {
        mediaRecorder.start();
        recordBtn.classList.add('recording');
    }
});

function deleteAudio(step) {
    if (step === 1) {
        document.querySelector('#audio1Preview').src = '';
        document.querySelector('#audio1Preview').classList.add('hidden');
        audioBlobs[0] = null;
    } else if (step === 2) {
        document.querySelector('#audio2Preview').src = '';
        document.querySelector('#audio2Preview').classList.add('hidden');
        audioBlobs[1] = null;
    }
}

document.querySelector('form').addEventListener('submit', function(event) {
    const formData = new FormData(this);

    if (audioBlobs[0]) {
        formData.append('audio1', audioBlobs[0], 'audio1.wav');
    }
    if (audioBlobs[1]) {
        formData.append('audio2', audioBlobs[1], 'audio2.wav');
    }

    fetch(this.action, {
        method: this.method,
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            console.error('Error:', data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    event.preventDefault();
});


// pour gerer l'action des btn import er record
document.getElementById('recordButton').addEventListener('click', () => {
    const importCollapse = document.getElementById('multiCollapseExample2');
    if (importCollapse.classList.contains('show')) {
        new bootstrap.Collapse(importCollapse, {
            toggle: true
        });
    }
});

document.getElementById('importButton').addEventListener('click', () => {
    const recordCollapse = document.getElementById('multiCollapseExample1');
    if (recordCollapse.classList.contains('show')) {
        new bootstrap.Collapse(recordCollapse, {
            toggle: true
        });
    }
});


// scripte pour afficher l'image uplaod


document.getElementById('photo1').addEventListener('change', function(event) {
    const preview = document.getElementById('preview1');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});

document.getElementById('photo2').addEventListener('change', function(event) {
    const preview = document.getElementById('preview2');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    document.getElementById('photo1').addEventListener('change', function(event) {
        displayImage(event, 'imagePreview1');
    });

    document.getElementById('photo2').addEventListener('change', function(event) {
        displayImage(event, 'imagePreview2');
    });

    function displayImage(event, previewId) {
        const input = event.target;
        const previewContainer = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                previewContainer.innerHTML = '';
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    if (file) {
                reader.readAsDataURL(file);
            }
        });

    </script>

@endsection