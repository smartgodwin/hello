<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('frontend/image/sunofa-icone.png') }}" type="image/x-icon">


     {{-- le lien font --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
     {{-- les liens css --}}
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     {{-- @yield('css') --}}
     <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
     <link rel="stylesheet" href="{{ asset('frontend/css/responssive.css') }}">
    


    <title>{{ __('page d\'accueil') }}</title>
</head>
<body>

    <section class="section_page0">
        {{-- CAROUSEL --}}
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators justify-content-center align-items-center" style="height: 10%">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
            <div class="carousel-inner bg_blue">
              <div class="carousel-item active">
                <img src="{{ asset('frontend/image/sunofa-slider-image1.png') }}" class="d-block w-100" alt="...">
                {{-- <div class="overlay"></div> --}}
              </div>
              <div class="carousel-item">
                <img src="{{ asset('frontend/image/sunofa-slider-image2.png') }}" class="d-block w-100" alt="...">
                {{-- <div class="overlay"></div> --}}
              </div>
              <div class="carousel-item">
                <img src="{{ asset('frontend/image/sunofa-slider-image3.png') }}" class="d-block w-100" alt="...">
                {{-- <div class="overlay"></div> --}}
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
              {{-- <span class="carousel-control-prev-icon c_btn" aria-hidden="true"></span> --}}
              <span aria-hidden="true"><img width="50%" src="{{ asset('frontend/icons/Icone scrolle gauche.png') }}" alt=""></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
              {{-- <span class="carousel-control-next-icon c_btn" aria-hidden="true"></span> --}}
              <span aria-hidden="true"><img width="50%" src="{{ asset('frontend/icons/Icone scroll droit.png') }}" alt=""></span>
              <span class="visually-hidden">{{ __('Suivant') }}</span>
            </button>
        </div>

        {{-- CONTENU --}}
        <div class="page0_contener">
                <div class="text">
                    <h2>{{ __('Bienvenue sur') }}</h2>
                    <h1>Sunofa Map</h1>
                </div>
                <div class="flex_btn">
                    <a href="/address">{{ __('Ajouter une') }} <br> {{ __('adresse') }} <span><img width="22px" height="28px" src="{{ asset('frontend/icons/Localisation.png') }}" alt=""></span></a>
                    <a href="{{ route('address.search') }}">{{ __('Joindre une') }} <br> {{ __('adresse') }} <span><i class="fa-solid fa-map-location-dot"></i></span></a>
                </div>
                <div class="explor">
                    <a href="{{ route('login') }}">{{ __('Connexion') }}</a>
                </div>
        </div>
    </section>



    <script src="{{ asset('frontend/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

