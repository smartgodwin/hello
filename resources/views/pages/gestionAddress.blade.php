@extends('mylayouts.app2')

@section('titre')
    {{ __('Gestion_address') }}
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
@if (session('error'))
    <div class="toast align-items-center position-absolute text-bg-danger float-end" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif
    <section class="section_page13">
        <div class="page13_container">
            @if (isset($addresses) && $addresses && $addresses->count() > 0)

                @foreach ($addresses as $address)

                    <a class="text-decoration-none" href="{{ route('address.edit', $address->id) }}">

                        <div class="adresse-page13">
                            <div class="img_page13">

                                @if ($address->media && $address->media->photo1)
                                        <img class="w-100" src="{{ asset($address->media->photo1) }}" alt="Address Image">
                                    @else
                                        <img class="w-100" src="{{ asset('frontend/image/maison.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                            <div class="info_page13">
                                <h3>{{ $address->adressName }}</h3>
                                <p>{{ $address->city }}</p>
                                <p>{{ __('Ajouté depuis') }} {{ $address->created_at }}</p>
                            </div>
                        </div>

                    </a>
      
                @endforeach
            @else
               <div class="justify-content-center d-flex flex-column align-items-center">
                    <h3 class="text-secondary text-center mb-3">{{ __('vous n\'avez pas d\'addresse enregistrer') }}</h3>
                    <div class="ad_btn" style="        justify-content: center !important;
                                                        display: flex !important;">
                        <a href="/address">{{ __('ajouter') }} <span><i class="ps-3 fa-solid fa-plus"></i></span></a>
                    </div>
               </div>
            @endif
            
            </div>
        </div>

    </section>
@endsection