@extends('mylayouts.app')

@section('titre')
   {{__(' validation')}}
@endsection

@section('main')

<section class="section_page9">
    <div class="page9_container">
        <h3 class="mb-3">{{ __('Adresse ajoutée !') }}</h3>
        <img class="mb-3" src="{{ asset('frontend/icons/Icone validé.png') }}" alt="">
        <p class="mb-3">{{ __('Verifiez le centre de notification ou') }} <br>{{ __('votre boite mail pour retrouver') }} <br>{{ __('votre code') }}</p>
        <a href="{{ route('address.search') }}"><button>OK</button></a>
    </div>
</section>


@endsection
