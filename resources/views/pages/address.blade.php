@extends('mylayouts.app')

@section('titre')
    address
@endsection

@section('main')
    <section class="section_page5">
        <div class="page5_contener w-80">
            <div class="back">
                <a href="{{ route('address.search') }}"><img src="{{ asset('frontend/icons/Icone retour 2.png') }}"
                        alt=""></a>
            </div>

            <form id="createAddress" enctype="multipart/form-data">
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
                            <label for="pseudo" class="form-label">{{ __('Créer un identifiant') }} <span
                                    class="required"><i class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" class="form-control" name="pseudo" id="pseudo"
                                placeholder="ex: KGB2" value="{{ old('pseudo') }}">
                            @error('pseudo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--  --}}
                        <div class="form-group">
                            <label for="adresse" class="form-label">{{ __('Nom de l’adresse') }} /APT/{{ __('suite') }} <span class="required"><i
                                        class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" class="form-control" name="adressName" id="adresse"
                                placeholder="Maison IDAH" value="{{ old('adressName') }}">
                        </div>
                        {{--  --}}
                        <div class="form-group">
                            <label for="localisation" class="form-label">{{ __('Pays, ville, quartier ou rue') }} <span
                                    class="required"><i class="fa-solid fa-asterisk"></i></span></label>
                            <input type="text" class="form-control" name="city" id="localisation"
                                placeholder="Contry, Town, City" value="{{ old('city') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="useCurrentPosition">{{ __('Utiliser ma position actuelle') }}/{{ __('Votre adresse Google') }}</label>
                            {{-- checkbox --}}
                            <div class="form-group form-check checkbox-container">
                                <input type="checkbox" class="form-check-input" id="googleCheck">
                                <label class="form-check-label" for="googleCheck">{{ __('Votre adresse Google') }}</label>
                            </div>
                            <input type="text" id="googleAddress" class="form-control" name="googleAddress"
                                placeholder="Street, city, state/region, Zip code, Country" style="display: none;">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input" id="useCurrentPosition">
                            <label class="form-check-label"
                                for="useCurrentPosition">{{ __('Utiliser ma position actuelle') }}</label>

                        </div>
                        <div class="form-group">
                            <input type="text" style="display: none" name="latitude" id="latitude">
                        </div>
                        <div class="form-group">
                            <input type="text" style="display: none" name="longitude" id="longitude">
                        </div>



                        {{--  --}}
                        <div class="form-group">
                         <label class="form-check-label fw-bold" for="form-check-label">{{ __('Rendez votre adresse privée en utilisant une Pin') }}</label>
                            <div class="form-group form-check checkbox-container">
                                <input type="checkbox" class="form-check-input" id="protectAddress">
                                <label class="form-check-label"
                                    for="protectAddress">{{ __('Je veux protéger mon adresse') }}</label>
                            </div>
                        </div>
                        <div id="pinFields" style="display: none;">
                            <div class="form-group">
                                <label for="codePin" class="form-label">{{ __('Créez un CODE PIN') }} </label>
                                <input type="password" class="form-control" name="codePin" id="codePin"
                                    placeholder="code pin" value="{{ old('codePin') }}" >
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" id="confirmCodePin"
                                    placeholder="Confirmez le code pin" >
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
                            <label for="img1" class="form-label fs-4">{{ __('Ajoutez images de la localité') }}
                            </label>
                            <div class="img_upload">
                                <label for="photo1" class="imglabel">
                                    <span><img src="{{ asset('frontend/icons/Icone photo add.png') }}"
                                            alt=""></span>{{ __('Sélectionnez une image') }}
                                    <img id="preview1" src="#" alt="Preview"
                                        style="display:none; width: 100%;position: absolute; height: 100%;" />
                                </label>
                                <input class="input" name="photo1" id="photo1" type="file"
                                    accept="image/jpeg, image/png, image/jpg, image/gif, image/jfif, image/avif, image/webp" />

                                <label for="photo2" class="imglabel">
                                    <span><img src="{{ asset('frontend/icons/Icone photo add.png') }}"
                                            alt=""></span>{{ __('Sélectionnez une image') }}
                                    <img id="preview2" src="#" alt="Preview"
                                        style="display:none; width: 100%; position: absolute; height: 100%;" />
                                </label>
                                <input class="input" name="photo2" id="photo2" type="file"
                                    accept="image/jpeg, image/png, image/jpg, image/gif, image/jfif, image/avif, image/webp" />
                            </div>
                        </div>


                        {{-- record audio  --}}
                        <div class="form-group mt-3">
                            <label for="aud" class="form-label fs-4">{{ __('Audio de référencement') }} </label>

                            <div class="row">
                                <div class="w-100">
                                    
                                        <div class="card card-body">
                                            {{-- record  --}}
                                            <div class="aud_record" id="aud_record">

                                                <div class="aud w-100">
                                                    <div class="form-group">
                                                        <label for="lng_off"
                                                            class="form-label">{{ __('langue officiel') }} </label>
                                                    </div>
                                                    <div class=" aud_label">
                                                        <button class="btn " id="startRecording1" type="button"><i
                                                                class="fa-solid fa-microphone"></i></button>
                                                        <button class="btn " id="stopRecording1" type="button" disabled><i
                                                                class="fa-solid fa-circle-stop"></i></button>
                                                        <audio id="audioPlayback1" controls></audio>
                                                        <input type="hidden" name="audio1" id="hiddenAudio1">
                                                        <span onclick="deleteAudio(1)"><i class="fa-regular fa-trash-can"
                                                                style="color: red"></i></span>
                                                    </div>
                                                    {{-- deuxieme --}}
                                                    <div class="form-group">
                                                        <label for="lng_off"
                                                            class="form-label">{{ __('langue standar ') }}</label>
                                                    </div>
                                                    <div class=" aud_label">
                                                        <button class="btn " id="startRecording2" type="button"><i
                                                                class="fa-solid fa-microphone"></i></button>
                                                        <button class="btn " id="stopRecording2" type="button" disabled><i
                                                                class="fa-solid fa-circle-stop"></i></button>
                                                        <audio id="audioPlayback2" controls></audio>
                                                        <input type="hidden" name="audio2" id="hiddenAudio2">
                                                        <span onclick="deleteAudio(2)"><i class="fa-regular fa-trash-can"
                                                                style="color: red"></i></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                               
                            </div>


                        </div>

                        {{-- record video --}}
                        <div class="form-group">
                            <label for="video" class="form-label fs-4">{{ __('Vidéo de référencement') }} </label>
                            <div class="video_upload">
                                <label for="video1" class="videolabel"><span><img width="40" height="40"
                                            src="{{ asset('frontend/icons/Icone Rec video.png') }}"
                                            alt=""></span>{{ __('Sélectionnez une video') }}</label>
                                <input class="input" name="video1" id="video1" type="file" accept="video/*" />
                                <video id="videoPreview1" width="120" height="80" controls
                                    style="display:none;"></video>

                                <label for="video2" class="videolabel"><span><img width="40" height="40"
                                            src="{{ asset('frontend/icons/Icone Rec video.png') }}"
                                            alt=""></span>{{ __('Sélectionnez une video') }}</label>
                                <input class="input" name="video2" id="video2" type="file" accept="video/*" />
                                <video id="videoPreview2" width="120" height="80" controls
                                    style="display:none;"></video>
                            </div>
                        </div>

                        {{-- codition d'utilisateur --}}
                        <div class="form-group mt-3">

                            <div class="form-group form-check checkbox-container">
                                <input type="checkbox" class="form-check-input" id="acceptTerms">
                                <label class="form-check-label" for="acceptTerms">{{ __('J\'accepte') }}</label>
                            </div>
                            <div class="form-group">
                                <p>{{ __('En cliquant sur "J\'accepte", vous acceptez les') }} <a
                                        href="#">{{ __('Politiques de confidentialité') }}</a>{{ __('et les') }}
                                    <a
                                        href="#">{{ __('Conditions d\'utilisation') }}</a> {{ __('de SunofaMap') }}.
                                </p>
                            </div>
                            <div class="form-group w-100 d-flex justify-content-between">
                                <button type="button" class="btn btn-A"
                                    style="padding: 10px; width:40%">{{ __('Annuler') }}</button>
                                <button type="submit" id="submitButton" class="btn btn-v"
                                    style="padding: 10px; width:40%" disabled>{{ __('Soumettre') }}</button>
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
        let mediaRecorder1, mediaRecorder2;
        let audioChunks1 = [],
            audioChunks2 = [];
        let audioBlob1, audioBlob2;
        let isRecording1 = false,
        isRecording2 = false;

        // Gérer l'enregistrement du premier audio
        document.getElementById('startRecording1').addEventListener('click', () => {
            navigator.mediaDevices.getUserMedia({
                audio: true
            }).then(stream => {
                mediaRecorder1 = new MediaRecorder(stream);
                mediaRecorder1.start();

                document.getElementById('startRecording1').disabled = true;
                document.getElementById('stopRecording1').disabled = false;

                mediaRecorder1.addEventListener('dataavailable', event => {
                    audioChunks1.push(event.data);
                });

                mediaRecorder1.addEventListener('stop', () => {
                    audioBlob1 = new Blob(audioChunks1);
                    const audioUrl1 = URL.createObjectURL(audioBlob1);
                    const audio1 = document.getElementById('audioPlayback1');
                    audio1.src = audioUrl1;
                    const hiddenAudio1 = document.getElementById('hiddenAudio1');
                    hiddenAudio1.value = audioBlob1;
                });
            });
        });

        document.getElementById('stopRecording1').addEventListener('click', () => {
            mediaRecorder1.stop();
            document.getElementById('startRecording1').disabled = false;
            document.getElementById('stopRecording1').disabled = true;
        });

        document.getElementById('startRecording2').addEventListener('click', () => {
            navigator.mediaDevices.getUserMedia({
                audio: true
            }).then(stream => {
                mediaRecorder2 = new MediaRecorder(stream);
                mediaRecorder2.start();

                document.getElementById('startRecording2').disabled = true;
                document.getElementById('stopRecording2').disabled = false;

                mediaRecorder2.addEventListener('dataavailable', event => {
                    audioChunks2.push(event.data);
                });

                mediaRecorder2.addEventListener('stop', () => {
                    audioBlob2 = new Blob(audioChunks2);
                    const audioUrl2 = URL.createObjectURL(audioBlob2);
                    const audio2 = document.getElementById('audioPlayback2');
                    audio2.src = audioUrl2;
                    const hiddenAudio2 = document.getElementById('hiddenAudio2');
                    hiddenAudio2.value = audioBlob2;
                });
            });
        });

        document.getElementById('stopRecording2').addEventListener('click', () => {
            mediaRecorder2.stop();
            document.getElementById('startRecording2').disabled = false;
            document.getElementById('stopRecording2').disabled = true;
        });

//protect address
        document.getElementById('protectAddress').addEventListener('change', function() {
            const pinFields = document.getElementById('pinFields');
            pinFields.style.display = this.checked ? 'block' : 'none';
        });
//script de google adress
document.getElementById('googleCheck').addEventListener('change', function() {
        var googleAddress = document.getElementById('googleAddress');
        if (this.checked) {
            googleAddress.style.display = 'block';
        } else {
            googleAddress.style.display = 'none';
        }
    });
    
//get position        
        let latitude = document.getElementById('latitude');
        let longitude = document.getElementById('longitude');

        document.addEventListener('DOMContentLoaded', function() {
            const useCurrentPositionCheckbox = document.getElementById('useCurrentPosition');

            useCurrentPositionCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            const Platitude = position.coords.latitude;
                            const Plongitude = position.coords.longitude;

                            latitude.value = Platitude;
                            longitude.value = Plongitude;
                        }, function(error) {
                            switch (error.code) {
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
                    if (latitude) latitude.value = null;
                    if (longitude) longitude.value = null;
                }
            });
        });


//accept terms to submit
        document.addEventListener('DOMContentLoaded', (event) => {
            const checkbox = document.querySelector('#acceptTerms');
            const submitButton = document.querySelector('#submitButton');
            checkbox.addEventListener('change', () => {
                submitButton.disabled = !checkbox.checked;
            });
        });

//afficher les images aploader
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

            if (file) {
                reader.readAsDataURL(file);
            }
        });


//send of to create addresse        
 document.getElementById('createAddress').addEventListener('submit', function(event) {
            event.preventDefault();
            let pseudo = document.getElementById('pseudo')?.value;
            let adresse = document.getElementById('adresse')?.value;
            let city = document.getElementById('localisation')?.value;
            let googleAddress = document.getElementById('googleAddress')?.value;
            let codePin = document.getElementById('codePin')?.value;
            let infoAddress = document.getElementById('infoAddress')?.value;
            let photo1 = document.getElementById('photo1') ? document.getElementById('photo1').files[0] || null :
                null;
            let photo2 = document.getElementById('photo2') ? document.getElementById('photo2').files[0] || null :
                null;
            let video1 = document.getElementById('video1') ? document.getElementById('video1').files[0] || null :
                null;
            let video2 = document.getElementById('video2') ? document.getElementById('video2').files[0] || null :
                null;


            let formData = new FormData();

            formData.append('pseudo', pseudo);
            formData.append('adressName', adresse);
            formData.append('city', city);
            formData.append('googleAddress', googleAddress);
            formData.append('longitude', longitude.value);
            formData.append('latitude', latitude.value);
            formData.append('codePin', codePin);
            formData.append('infoAddress', infoAddress);

            if (typeof audioBlob1 !== 'undefined' && audioBlob1) {
                formData.append('audio1', audioBlob1, 'audio1.webm');
            } else if (document.getElementById('audio1Upload')?.files[0]) {
                formData.append('audio1', document.getElementById('audio1Upload').files[0]);
            }

            if (typeof audioBlob2 !== 'undefined' && audioBlob2) {
                formData.append('audio2', audioBlob2, 'audio2.webm');
            } else if (document.getElementById('audio2Upload')?.files[0]) {
                formData.append('audio2', document.getElementById('audio2Upload').files[0]);
            }

            if (photo1?.size > 0) {
                formData.append('photo1', photo1);
            }
            if (photo2?.size > 0) {
                formData.append('photo2', photo2);
            }
            if (video1?.size > 0) {
                formData.append('video1', video1);
            }
            if (video2?.size > 0) {
                formData.append('video2', video2);
            }


            fetch('/address', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.href = '/validation'; // Remplacez par l'URL de redirection
                    } else {
                        console.error('Erreur:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
