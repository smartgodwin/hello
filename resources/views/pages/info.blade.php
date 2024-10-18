@extends('mylayouts.app2')

@section('titre')
    {{ __('info') }}
@endsection

@section('main')
    <section class="section_page11">
        <div class="page11_container">
            <div class="page11_logo">
                <img src="{{ asset('frontend/image/logo_sunofa_map.jpg') }}" alt="">
            </div>
            <div class="page11_info">
                <p>{{ __('À propos de') }} Sunofa Map

                    {{ __('p1') }}

                    {{ __('Faciliter la Localisation Personnelle et Collective') }}

                  {{ __('p2') }}

                    {{ __('Enregistrement et Gestion des Adresses Importantes') }}

                    {{ __('p3') }}

                    {{ __('Protection et Confidentialité des Données') }}

                   {{ __('p4') }}.

                    {{ __('Une Innovation au Service de la Communauté') }}

                    {{ __('p5') }}
                    {{ __('Une Expérience Utilisateur Intuitive et Engageante') }}

                   {{ __('p6') }}

                    

                    {{ __('p7') }}

                    {{ __('p8') }}
                    .</p>
            </div>


        </div>



    </section>
@endsection
