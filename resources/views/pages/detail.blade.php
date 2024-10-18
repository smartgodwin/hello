@extends('mylayouts.app2')

@section('titre')
    {{ __('detail adress') }}
@endsection

@section('main')
    <section class="section_page5">
        <div class="page5_contener w-70">
            

           
        @if (isset($address) && $address)    
            <div class="div_form_contener flex-column">
                <div class="detail d-flex">
                    <div class="div_form">
                        <div class="detail_title d-flex align-items-center mb-5">
                        @if ($address->media && $address->media->photo1)
                            <img class="w-40" src="{{ asset( $address->media->photo1) }}" alt="Address Image">
                        @else
                            <img class="w-40" src="{{ asset('frontend/image/maison.jpg') }}" alt="Default Image">
                        @endif
                            <div class="detail_title_text ms-3">
                                <h2 class="m-0 p-0 fw-bold"> {{ $address->pseudo }}</h2>
                                <h3 class="m-0 p-0">{{ $address->adressName }}</h3>
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
                                @if ($address->media && $address->media->audio1 && $address->media->audio2)
                                    <audio src="{{ asset($address->media->audio1) }}" controls class="" name="audio1" ></audio>
                                    <audio src="{{ asset($address->media->audio2) }}" controls class="ms-2" name="audio2" ></audio>
                                @else
                                    <audio controls class="" name="audio1" ></audio>
                                    <audio controls class="ms-2" name="audio2" ></audio>
                                @endif
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
                                        {{ __('Votre navigateur ne supporte pas la balise ') }}
                                </video>
                                <video class="w-40 ms-4" height="100%" controls>
                                    <source src="{{ asset( $address->media->video2) }}" >
                                        {{ __('Votre navigateur ne supporte pas la balise') }} 
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
                    @if ($address->googleAddress)
                        <a class="btn btn-v p-3 w-40" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($address->googleAddress) }}" target="_blank">Itinéraire</a>
                        {{-- <a class="btn btn-v p-3 w-40" href="https://www.google.com/maps/search/?api=1&query={{ $address->latitude }},{{ $address->longitude }}" target="_blank">Itinéraire</a> --}}
                    @else
                        <a class="btn btn-v p-3 w-40" href="https://www.google.com/maps/search/?api=1&query={{ $address->latitude }},{{ $address->longitude }}" target="_blank">Itinéraire</a>
                    @endif
                </div>
                    
            </div>
        @endif  
           
        </div>
    </section>
@endsection
