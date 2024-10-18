@extends('mylayouts.app')

@section('titre')
    page 15
@endsection

@section('main')
    {{-- content of my code --}}
    <div class="container_page15">
        <!-- Input text, images, videos and buton 's section -->
        
        <!-- Form's div -->
        <div class="info-section_page15">
            <!-- I choose method "post" by default -->
            <form action="" method="post">
                <div class="information_page15">
                    <div class="left-side_page15">
                        <!-- text field section -->
                        <div class="text_field-section_page15">
                            <label for="Pseudo"><h3 class="label-L_size_page15">Pseudo / identifiant</h3></label><br>
                            <input class="input-noBorder_page15" type="text" name="Pseudo" id="Pseudo" placeholder="Sadath01" size="40" maxlength="50" autofocus required><br>

                            <label for="Nom_de_l_adresse"><h3 class="label-L_size_page15">Nom de l'adresse</h3></label><br>
                            <input class="input-noBorder_page15" type="text" name="Nom_de_l_adresse" id="Nom_de_l_adresse" placeholder="Maison IDAH" size="40" maxlength="50" required><br>

                            <label for="Pays_ville_quartier_rue"><h3 class="label-L_size_page15">Pays, ville, quartier ou rue</h3></label><br>
                            <input class="input-noBorder_page15" type="text" name="Pays_ville_quartier_rue" id="Pays_ville_quartier_rue" placeholder="Togo, Lomé, Entreprise de l'Union," size="40" maxlength="50" required><br>
                            
                            <label for="E-mail"><h3 class="label-L_size_page15">E-mail</h3></label><br>
                            <input class="input-noBorder_page15" type="email" name="E-mail" id="E-mail" placeholder="monmail@email.com" size="40" maxlength="50" required><br>

                            <label for="Telephone"><h3 class="label-L_size_page15">Téléphone</h3></label><br>
                            <input class="input-noBorder_page15" type="tel" name="Telephone" id="Telephone" placeholder="+22890000000" size="40" maxlength="50" required><br>

                            <label for="Info_adresse"><h3 class="label-L_size_page15">Info adresse</h3></label><br>
                            <textarea class="input-border_page15" name="Info_adresse" id="Info_adresse" rows="4" cols="50" placeholder="Donnez une description de votre adresse ici..."></textarea>
                        </div>
                        <!-- audios field section -->
                        <div class="audio_controls-section_page15">
                            <div class="media-title_page15">
                                <h3 class="label-S_size_page15">Audios</h3>
                            </div>
                            <div class="audio-message_page15">
                                <audio controls>
                                    <source class="source-audio_page15" src="https://www.w3schools.com/html/horse.mp3" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>

                                <audio controls>
                                    <source class="source-audio_page15" src="https://www.w3schools.com/html/horse.mp3" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                
                    <div class="right-side_page15">
                        <!-- Images and videos 's field section -->
                        <div class="image_video-section_page15">
                            <!-- Images section -->
                            <div class="image-section_page15">
                                <!-- Images title -->
                                <div class="media-title_page15">
                                    <h3 class="label-L_size_page15">Images</h3>
                                </div>
                                <!-- Images content -->
                                <div class="images-content_page15">
                                    <div>
                                        <img class="picture_page15" src="{{ asset('frontend/icons/SourcesMedia_Jeff/Images/imageMaisonCapTown.jpeg')}}" alt="Image de Maison à CapTown">
                                    </div>
                                    <div>
                                        <img class="picture_page15" src="{{ asset('frontend/icons/SourcesMedia_Jeff/Images/imageRue_d_AfriqueGarage.jpeg')}}" alt="Image de Rue d'Afrique Garage">
                                    </div>
                                </div>
                            </div>

                            <!-- Videos section -->
                            <div class="video-section_page15">
                                <!-- Videos title -->
                                <div class="media-title_page15">
                                    <div>
                                        <h3 class="label-L_size_page15">Vidéos</h3>
                                    </div>
                                </div>
                                {{-- videos content --}}
                                <div class="videos-content_page15">
                                    <video controls>
                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <video controls>
                                        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Button's section -->
                <div class="button-container_page15">
                    <button class="button_page15"><h3>SOUMETTRE</h3></button>
                </div>
            </form>
        </div>    
    </div>

@endsection
