@extends('mylayouts.app')

@section('titre')
   {{__(' validation')}}
@endsection

@section('main')

<section class="section_page9">
    <div class="page9_container">
        <h3 class="mb-3">{{ __('Adresse ajoutée !') }}</h3>
        <span class="text-success fs-3"><i class="fa-regular fa-circle-check"></i></span>
        <p class="mb-3">{{ __('Votre adresse a été enregistrer') }} <br>{{ __('verifiez mes adresses') }} <br>{{ __('pour le voir') }}</p>
        <a href="{{ route('address.search') }}"><button>OK</button></a>
    </div>
</section>


@endsection
