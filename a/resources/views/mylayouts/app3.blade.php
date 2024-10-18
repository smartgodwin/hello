<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('frontend/image/sunofa-icone-blanc.png') }}" type="image/x-icon">


    {{-- le lien font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    {{-- les liens css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- @yield('css') --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responssive.css') }}">



    {{-- le tittre de la page --}}
    <title>@yield('titre')</title>

</head>
<style>
    header {
        position: fixed;
        width: 100%;
    }

    main {
        padding-top: 10vh;
        width: 100%;
        min-height: 90vh;
        background-image: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url(asset('frontend/image/font3.jpg'));
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    section {
        background: transparent
    }
</style>

<body>
    {{-- loading page --}}
    <div class="loader" id="loader">
        <div class="load">
        </div>
        <h2>loading<span class="dots ms-2"><span class="dot">.</span><span class="dot">.</span><span
                    class="dot">.</span></span></h2>
    </div>
    <header class="header-p d-flex align-items-center">
        <div class="" style="width: 50px; height: 50px">
            <a  href="{{ route('address.search') }}"><img class="w-100" src="{{ asset('frontend/icons/Icone retour 2.png') }}" alt=""></a>
        </div>
        <h2 class="text-white m-0">Profil</h2>
    </header>

    <main style="background-image: linear-gradient(rgba(255, 255, 255, 0.632), rgba(255, 255, 255, 0.632)), url('{{ asset('frontend/image/font3.jpg') }}');">
        @yield('main')
    </main>


    {{-- le footer --}}
    {{-- @include('mylayouts.footer') --}}
    {{-- les scripts --}}
    <div>
        @yield('script')
    </div>
    <script src="{{ asset('frontend/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // les messages toastes
        $(document).ready(function() {
            $('.toast').toast('show');
        });

        // loading page
        window.onload = function() {
            // Afficher le loader
            var loader = document.getElementById('loader');
            loader.style.visibility = 'visible';
            loader.style.opacity = '1';

            // Masquer le loader après 900ms
            setTimeout(function() {
                loader.style.opacity = '0';
                loader.style.visibility = 'hidden';
            }, 900);
        };
    </script>
</body>

</html>
