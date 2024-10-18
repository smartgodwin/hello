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
    <section class="section_page13">
        <div class="page13_container">
            @if (isset($favories) && $favories->count() > 0)

                @foreach ($favories as $favorie)
                    @php
                        $address = $favorie->address;
                    @endphp
                    <a class="text-decoration-none" href="{{ route('address.show', $address->id) }}">
                        <div class="adresse-page13">
                            <div class="img_page13">
                                @if ($address->media && $address->media->photo1)
                                    <img class="w-100" src="{{ asset( $address->media->photo1) }}" alt="Address Image">
                                @else
                                    <img class="w-100" src="{{ asset('frontend/image/maison.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                            <div class="info_page13">
                                <h3>{{ $address->adressName }}</h3>
                                <p>{{ $address->city }}</p>
                                <p>{{ __('Ajouté depuis') }} {{ $address->created_at->format('d/m/Y') }}</p>
                            </div>
                            <form method="POST" action="{{ route('favories.destroy', $address->id) }}" onsubmit="return confirm('Are you sure you want to remove this address from your favorites?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-2" style="background: none; border: none;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </a>
                @endforeach

            @else
                <h3 class="text-secondary text-center">{{ __('vous n\'avez pas d\'adresse en favorie') }}</h3>
            @endif
        </div>
    </section>
@endsection
