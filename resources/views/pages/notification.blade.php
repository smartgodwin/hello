@extends('mylayouts.app2')

@section('titre')
    {{ __('notification') }}
@endsection

@section('main')
 
    <section class="section_page12">

        <div class="page12_container">

            @if (Auth::check() && Auth::user()->notifications->count() > 0)
                @foreach (Auth::user()->notifications as $notification)
                    <div class="page12_notif">
                        <p class="m-0">{{ $notification->created_at->format('d/m/Y H:i') }}</p>

                        @if ($notification->data['type'] == 'pin_request')
                            <div class="page12_message rounded">
                                <p>
                                    {{ __('Une demande de code PIN a été faite pour votre adresse') }} :
                                    {{ $notification->data['address']['adressName'] }}<br>
                                    Par : {{ $notification->data['reciver']['name'] ?? 'Inconnu' }}<br>
                                    {{-- Son mail est : <a href="mailto:{{ $notification->data['reciver']['email'] }}">{{ $notification->data['reciver']['email']</a> ?? 'Inconnu' }}  <br>
                                    Son numéro de téléphone :  <a href="tel:{{$notification->data['reciver']['phone_number']}}">{{ $notification->data['reciver']['phone_number']</a> ?? 'Inconnu' }}<br> --}}
                                    {{ __('Son mail est') }} :
                                    @if ($notification->data['reciver']['email'])
                                        <a href="mailto:{{ $notification->data['reciver']['email'] }}">{{ $notification->data['reciver']['email'] }}</a>
                                    @else
                                        {{ __('Inconnu') }}
                                    @endif
                                    <br>

                                    {{ __('Son numéro de téléphone ') }}:
                                    @if ($notification->data['reciver']['phone_number'])
                                        <a href="tel:+{{ $notification->data['reciver']['phone_number'] }}">{{ $notification->data['reciver']['phone_number'] }}</a>
                                    @else
                                        {{ __('Inconnu') }}
                                    @endif
                                    <br>
                                </p>
                                <hr>

                                <form action="{{ route('notifications.sendCodePin', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link link-underline-opacity-0 link-success"
                                        style="border: none;font-size: 20px; background: transparent;"
                                        {{ $notification->data['code_sent'] ?? false ? 'disabled' : '' }}>
                                        <span class="me-3"><i
                                                class="fa-solid fa-share-from-square"></i></span>{{ $notification->data['code_sent'] ?? false ? 'Code envoyé' : 'Envoyer le code' }}
                                    </button>
                                </form>
                            </div>

                            <div class="d-flex justify-content-between">
                                <form class="w-30" action="{{ route('notifications.markasread', $notification->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-link link-underline-opacity-0 link-secondary"
                                        style="cursor: pointer;">

                                        @if ($notification->read_at)
                                            <span><i class="fa-solid fa-check-double link-primary me-2"></i>{{ __('lu') }}</span>
                                        @else
                                            <span><i class="fa-solid fa-check-double link-secondary me-2"></i>{{ __('lire') }}</span>
                                        @endif
                                    </button>
                                </form>
                                <form class="w-30" action="{{ route('notifications.destroy', $notification->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link link-underline-opacity-0 link-danger"
                                        style="cursor: pointer; color:red;"><span><i class="fa-solid fa-trash"></i></span>
                                       {{__('supprimer')}}</button>
                                </form>
                            </div>
                        @elseif ($notification->data['type'] == 'pin_sent')
                            <p class="page12_message rounded">
                                {{ __('Le code PIN pour l\'adresse') }} : {{ $notification->data['address']['adressName'] }} {{__('a été envoyé')}}.<br>
                                {{ __('Voici le code pin') }} : <span
                                    class="fs-3 fw-bold">{{ $notification->data['codePin'] }}</span><br>
                                <a href="{{ route('address.show', ['id' => $notification->data['address']['id']]) }}">{{__('aller sur l\'address')}}</a>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('notifications.markasread', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-link link-underline-opacity-0 link-secondary"
                                        style="cursor: pointer;">

                                        @if ($notification->read_at)
                                            <span class="link-primary"><i
                                                    class="fa-solid fa-check-double me-2"></i>{{ __('Lu') }}</span>
                                        @else
                                            <span><i class="fa-solid fa-check-double me-2"></i>{{ __('lire') }}</span>
                                        @endif
                                    </button>
                                </form>
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link link-underline-opacity-0 link-danger"
                                        style="cursor: pointer;"><span><i class="fa-solid fa-trash"></i></span>
                                        {{ __('supprimer') }}</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <h3 class="text-secondary text-center">{{ __('vous n\'avez auccune de notification') }}</h3>
            @endif
        </div>
    </section>

@endsection
