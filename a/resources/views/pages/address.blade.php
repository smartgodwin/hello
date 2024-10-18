@extends('mylayouts.app')

@section('titre')
    address
@endsection

@section('main')
    <section class="section_page5">
        <div class="page5_contener w-80">
            <div class="back">
                <a href="{{ route('address.search') }}"><img src="{{ asset('frontend/icons/Icone retour 2.png') }}" alt=""></a>
            </div>

            <form method="POST" action="{{ route('address.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="div_form_contener ">

                        <div class="div_form">

                            @if ($errors->any())
                           
                                    <ul class="alert alert-danger d-flex flex-column justify-content-center">
                                        @foreach ($errors->all() as $error)
                                            <li class="list-unstyled">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                
                            @endif

                            {{--  --}}
                            <div class="form-group">
                                <label for="pseudo" class="form-label">{{ __('Créer un identifiant') }} <span class="required"><i class="fa-solid fa-asterisk"></i></span></label>
                                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Identifiant de votre adresse">
                                @error('pseudo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{--  --}}
                            <div class="form-group">
                                <label for="adresse" class="form-label">{{ __('Nom de l’adresse') }} <span class="required"><i class="fa-solid fa-asterisk"></i></span></label>
                                <input type="text" class="form-control" name="adressName" id="adresse" placeholder="Maison IDAH">
                            </div>
                            {{--  --}}
                            <div class="form-group">
                                <label for="localisation" class="form-label">{{ __('Pays, ville, quartier ou rue') }} <span class="required"><i class="fa-solid fa-asterisk"></i></span></label>
                                <input type="text" class="form-control" name="city" id="localisation" placeholder="Contry, Town, City">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="useCurrentPosition">{{ __('Utiliser ma position actuelle') }}/{{ __('Votre adresse Google') }}</label>
                                <input type="text" id="googleAddress" class="form-control" name="googleAddress" placeholder="Street, city, state/region, Zip code, Country">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" id="useCurrentPosition">
                                <label class="form-check-label" for="useCurrentPosition">{{ __('Utiliser ma position actuelle') }}</label>

                            </div>
                            <div class="form-group">
                                <input type="text" style="display: none" name="latitude" id="latitude">
                            </div>
                            <div class="form-group">
                                <input type="text" style="display: none" name="longitude" id="longitude">
                            </div>



                            {{--  --}}
                            <div class="form-group form-check checkbox-container">
                                <input type="checkbox" class="form-check-input" id="protectAddress">
                                <label class="form-check-label" for="protectAddress">{{ __('Je veux protéger mon adresse') }}</label>
                            </div>
                                <div id="pinFields" style="display: none;">
                                    <div class="form-group">
                                        <label for="codePin" class="form-label">{{ __('Créez un CODE PIN') }} </label>
                                        <input type="password" class="form-control" name="codePin" id="codePin"  placeholder="code pin">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" id="confirmCodePin"  placeholder="Confirmez le code pin">
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="infoAddress" class="form-label">{{ __('Info adresse') }}</label>
                                <textarea class="form-control" id="infoAddress" name="info" rows="3" placeholder="Longez tout droit vers ..."></textarea>
                                @error('info')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                    </div>

                    <div class="div_media">


                            {{--  --}}
                            <div class="form-group">
                                <label for="img1" class="form-label fs-4">{{ __('Ajoutez images de la localité') }} </label>
                                <div class="img_upload">
                                    <label for="photo1" class="imglabel">
                                        <span><img src="{{ asset('frontend/icons/Icone photo add.png') }}" alt=""></span>{{ __('Sélectionnez une image') }}
                                        <img id="preview1" src="#" alt="Preview" style="display:none; width: 100%;position: absolute; height: 100%;"/>
                                    </label>
                                    <input class="input" name="photo1" id="photo1" type="file" accept="image/jpeg, image/png, image/jpg, image/gif, image/jfif, image/avif, image/webp"/>
                            
                                    <label for="photo2" class="imglabel">
                                        <span><img src="{{ asset('frontend/icons/Icone photo add.png') }}" alt=""></span>{{ __('Sélectionnez une image') }}
                                        <img id="preview2" src="#" alt="Preview" style="display:none; width: 100%; position: absolute; height: 100%;"/>
                                    </label>
                                    <input class="input" name="photo2" id="photo2" type="file" accept="image/jpeg, image/png, image/jpg, image/gif, image/jfif, image/avif, image/webp"/>
                                </div>
                            </div>
                            
                            
                            {{--  --}}
                            <div class="form-group mt-3">
                                <label for="aud" class="form-label fs-4">{{ __('Audio de référencement') }} </label>
                                <div class="aud_select_btn">
                                    <p class="d-inline-flex gap-4">
                                        <a class="btn btn-g" id="recordButton" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">{{ __('enregistrer vocal') }}</a>
                                        <button class="btn btn-g" id="importButton" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">{{ __('importer vocal') }}</button>
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="w-100">
                                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                                            <div class="card card-body">
                                                {{--record  --}}
                                                <div class="aud_record" id="aud_record">
                                                    <div class="recod" id="recod">
                                                        <img src="{{ asset('frontend/icons/Icone record.png') }}" alt="record icone" id="recordBtn">
                                                    </div>
                                                    <div class="aud">
                                                        <div class="form-group">
                                                            <label for="lng_off" class="form-label">{{ __('langue officiel') }} </label>
                                                        </div>
                                                    <div class=" aud_label">
                                                        <audio controls class="hidden" name="audio1" id="audio1Preview"></audio>
                                                        <input type="hidden" name="audio1" id="hiddenAudio1">
                                                        <span  onclick="deleteAudio(1)"><i class="fa-regular fa-trash-can" style="color: red"></i></span>
                                                    </div>

                                                        <div class="form-group">
                                                            <label for="lng_off" class="form-label">{{ __('langue standar ') }}</label>
                                                            <input type="text" class="form-control" id="lng_off" placeholder="langue standar">
                                                        </div>
                                                    <div class=" aud_label">
                                                        <audio controls class="hidden" name="audio2" id="audio2Preview"></audio>
                                                        <input type="hidden" name="audio2" id="hiddenAudio2">
                                                        <span onclick="deleteAudio(2)"><i class="fa-regular fa-trash-can" style="color: red"></i></span>
                                                    </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                                            <div class="card card-body">
                                            {{-- import --}}
                                            <div class="aud_upload" id="aud_upload">
                                                <label for="audio1" class="audlabel"><span><img src="{{ asset('frontend/icons/Icone start record.png') }}" alt=""></span>{{ __('Importer vos audio') }}</label>
                                                    <input class="input" name="audio1" id="audio1" type="file" accept="audio/*"/>

                                                {{--  --}}
                                                <label for="audio2" class="audlabel"><span><img src="{{ asset('frontend/icons/Icone start record.png') }}" alt=""></span>{{ __('Importer vos audio') }}</label>
                                                    <input class="input" name="audio2" id="audio2" type="file" accept="audio/*"/>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            {{-- record video --}}
                            <div class="form-group">
                                <label for="video" class="form-label fs-4">{{ __('Vidéo de référencement') }}  </label>
                                <div class="video_upload">
                                    <label for="video1" class="videolabel"><span><img width="40" height="40" src="{{ asset('frontend/icons/Icone Rec video.png') }}" alt=""></span>{{ __('Sélectionnez une video') }}</label>
                                    <input class="input" name="video1" id="video1" type="file" accept="video/*"/>

                                    {{--  --}}
                                    <label for="video2" class="videolabel"><span><img width="40" height="40" src="{{ asset('frontend/icons/Icone Rec video.png') }}" alt=""></span>{{ __('Sélectionnez une video') }}</label>
                                    <input class="input" name="video2" id="video2" type="file" accept="video/*"/>
                                </div>
                            </div>

                            {{-- codition d'utilisateur --}}
                            <div class="form-group mt-3">

                                <div class="form-group form-check checkbox-container">
                                    <input type="checkbox" class="form-check-input" id="acceptTerms">
                                    <label class="form-check-label" for="acceptTerms">{{ __('J\'accepte') }}</label>
                                </div>
                                <div class="form-group">
                                    <p>{{ __('En cliquant sur "J\'accepte", vous acceptez les') }} <a href="#">{{ __('Politiques de confidentialité') }}</a>{{__(' et les')}} <a href="#">{{ __('Conditions d\'utilisation') }}</a>{{__(' de Sunofa carte')}}.</p>
                                </div>
                                <div class="form-group w-100 d-flex justify-content-between">
                                    <button type="button" class="btn btn-A" style="padding: 10px; width:40%">{{ __('Annuler') }}</button>
                                    <button type="submit" id="submitButton" class="btn btn-v" style="padding: 10px; width:40%" disabled>{{ __('Soumettre') }}</button>
                                </div>
                            </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection










@section('script')
    <script>
        // alert('Pour votre adresse veillé choisir soit la position actuel ou le google adress')
        // pour protect adress
document.getElementById('protectAddress').addEventListener('change', function() {
    const pinFields = document.getElementById('pinFields');
    if (this.checked) {
        pinFields.style.display = 'block';
    } else {
        pinFields.style.display = 'none';
    }
});

// pour recupere la position
document.addEventListener('DOMContentLoaded', function () {
    const useCurrentPositionCheckbox = document.getElementById('useCurrentPosition');

    const latitude = document.getElementById('latitude');
    const longitude = document.getElementById('longitude');

    useCurrentPositionCheckbox.addEventListener('change', function () {
        if (this.checked) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const Platitude = position.coords.latitude;
                    const Plongitude = position.coords.longitude;


                    latitude.value = Platitude;
                    longitude.value = Plongitude;
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
        }
    });
});

// pour le boutton soumettre et le checkbox
        document.addEventListener('DOMContentLoaded', (event) => {
        const checkbox = document.querySelector('#acceptTerms');
        const submitButton = document.querySelector('#submitButton');

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'disabled');
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




