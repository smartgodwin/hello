
<div class="sid_bar">
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Sunofa Map</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <div class="offcanvas-body">
        <div class="side_add">
            <div class="ad_btn w-100">
                <a href="/address">{{ __('ajouter une adresse') }} <span><i class="ps-3 fa-solid fa-plus"></i></span></a>
            </div>
        </div>

        <hr>

        <div class="container mt-4" style="overflow-y: scroll; margin-bottom: 20px; padding-bottom:20px;">
            <div class="side_contener">
                <div class="side_option">
                    <a class="text-decoration-none" href="/info"><h5><span class="me-3"><i class="fa-regular fa-circle-question"></i></span>{{__(' A propos')}}</h5></a>
                </div>
                <div class="side_option disable">
                    
                    <a class="text-decoration-none" href="/favories"><h5><span class="me-3"><i class="fa-solid fa-book"></i></span>{{__(' Carnet d\'adresses')}}</h5></a>
                </div>
                <div class="side_option">
                    @auth
                    
                    <a class="text-decoration-none" href="{{route('user.addresses',Auth::user()->id)}}"><h5><span class="me-3"><i class="fa-solid fa-map-location-dot"></i></span> {{ ('Gestion adresses') }}</h5></a>
                    
                    @endauth
                </div>
                <div class="side_option hn">
                    @auth
                       <a class="text-decoration-none" href="/notification"><h5><span class="me-3"><i class="fa-solid fa-bell"></i></span>{{ __('Notification') }}
                        @if(Auth::check())
                        @php
                            $unreadCount = Auth::user()->unreadNotifications->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="badge bg-danger ms-2" style="
                            z-index: 2;
                            height: fit-content;
                            position: absolute;
                        ">{{ $unreadCount }}</span>
                        @endif
                    @endif
                    </h5></a>                 
                    @endauth
                </div>
                
                <div class="side_option">
                    <h4 class="d-flex align-items-center"><span class="me-3"><i class="fa-solid fa-language"></i></span>
                        <div class="btn-group">
                            <button class="btn lang dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            {{ __('langue') }}
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item option" href="/locale/fr">{{ __('français')}}</a></li>
                            <li><a class="dropdown-item option" href="/locale/en">{{ __('anglais')}}</a></li>
                            <li><a class="dropdown-item option" href="/locale/es">{{ __('espagnole') }}</a></li>
                            </ul>
                        </div>
                    </h4>
                </div>
                @if (Auth::user() && Auth::user()->hasAnyRole(['Admin', 'SuperAdmin']))
                    
                    <div class="side_option">
                        @auth
                        
                            <a class="text-decoration-none" href="{{route('dashboard')}}"><h5><span class="me-3"><i class="fa-solid fa-table-columns"></i></span> {{ __('Tableau de bord') }}</h5></a>
                        
                        @endauth
                    </div>

                @endif
                

                <!-- Menu déroulant Bootstrap -->
                <div class="dropdown profile d-flex justify-content-start align-items-center">

                    <span class="d-flex justify-content-center align-items-center me-2" style="width: 39px; height: 39px; font-size: 20px"><i class="fa-regular fa-user"></i></span>
                    @auth
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index', ['id' => Auth::user()->id]) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        {{ __('Se déconnecter') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" style="font-size: 20px" class="btn">{{ __('Se connecter') }}</a>
                    @endguest
                </div>

            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<nav>
   <div class="menu">
        <h2 class="p-0 m-0"><span data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="pe-3 fa-solid fa-bars"></i></span> <a href="/" style="color: #ffff; text-decoration: none;">Sunofa Map</a></h2>
    </div>

    <div class="notif">
        <p class="m-0 p-0" style="width: 39px; height: 39px">
           
            <a href="/notification">
                <span  style="
                display: flex;
                position: relative;
                width: 100%;
                ">
                    <img class="w-100" src="{{ asset('frontend/icons/icone-notification2.png') }}" alt="">
                    @if(Auth::check())
                        @php
                            $unreadCount = Auth::user()->unreadNotifications->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="badge bg-danger" style="
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
        <p class="m-0 p-0 ms-5" style="width: 39px; height: 39px"><a href="/info"><span ><img class="w-100" src="{{ asset('frontend/icons/icone-info.png') }}" alt=""></span></a></p>
        
        {{-- <div class="btn-group ms-5">
            <button class="btn lang dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
             langue
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item option" href="/locale/fr">{{ __('français')}}</a></li>
              <li><a class="dropdown-item option" href="/locale/en">{{ __('anglais')}}</a></li>
              <li><a class="dropdown-item option" href="/locale/es">{{ __('espagnole') }}</a></li>
            </ul>
        </div> --}}
    </div>
</nav>
