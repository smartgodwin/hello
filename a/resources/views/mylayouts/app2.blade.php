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
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/intlTelInput.css') }}"> --}}

   <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @yield('stylesheets')
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
        min-height: 100vh;
        background-image: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url(../image/font3.jpg);
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

    {{-- le header --}}
    <header>
        <nav>
            <div class="menu">
                <h2 class="p-0 m-0 d-flex justify-content-start align-items-center">
                    <a href="{{ route('address.search') }}"><img
                                style="width: 39px; height: 39px" src="{{ asset('frontend/icons/Icone retour.png') }}"
                                alt=""></span></a> <a class="ms-4" href="/"
                        style="color: #ffff; text-decoration: none;">{{ ucfirst(last(explode('/', request()->path()))) }}</a>
                </h2>
            </div>

            <div class="notif">
                <p class="m-0" style="width: 39px; height: 39px">

                    <a href="/notification">
                        <span
                            style="
                        display: flex;
                        position: relative;
                        width: 100%;
                        ">
                            <img class="w-100" src="{{ asset('frontend/icons/icone-notification2.png') }}"
                                alt="">
                            @if (Auth::check())
                                @php
                                    $unreadCount = Auth::user()->unreadNotifications->count();
                                @endphp
                                @if ($unreadCount > 0)
                                    <span class="badge bg-danger"
                                        style="
                                    z-index: 2;
                                    height: fit-content;
                                    position: absolute;
                                    right: 0;
                                ">{{ $unreadCount }}</span>
                                @endif
                            @endif
                        </span>
                    </a>

                    {{-- <a href="/notification"><span ><img class="w-100" src="{{ asset('frontend/icons/icone-notification2.png') }}" alt=""></i></span></a> --}}
                </p>
                <p class="m-0 ms-5" style="width: 39px; height: 39px">
                    <a href="/info"><span><img class="w-100" src="{{ asset('frontend/icons/icone-info.png') }}"
                                alt=""></span>
                    </a>
                </p>
            </div>
        </nav>
    </header>

    <main>
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
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>

</html>
