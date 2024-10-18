@extends('mylayouts.app3')

@section('titre')
    Profil
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
    <section class="section_profil">
        
        <div class="page-content page-container" id="page-content">
            
                <div class="row d-flex justify-content-center p-0">
                    <div class="col-xl-6 col-md-12 p-0">
                        <div class="card user-card-full p-0">
                            <div class="row m-l-0 m-r-0 p-0" style="
                                                                    justify-content: center;
                                                                    align-items: center;">
                                <div class="col-sm-4 bg-c-lite-green user-profile p-0">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-2">
                                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                                alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600">{{ $user->name }}</h6>
                                        <i class="fa-regular fa-pen-to-square"></i>                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">{{ __('Information') }}</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400">{{ $user->email }}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone</p>
                                                <h6 class="text-muted f-w-400">{{ $user->phone_number }}</h6>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>

        {{-- change information --}}
        <div class="white-box">
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('patch')
        
                <div class="container p-0">
                    <div class="row justify-content-center">
                        <div class="col-md-6 p-0">
                            <div class="card bg-white text-black">
                                <div class="card-body">
                                    <h4 class="card-title">{{ __('Informations sur le profil') }}</h4>
                                    <p class="card-text">{{ __('Mettez à jour les informations de profil et l’adresse e-mail de votre compte') }}.</p>
                                    
                                    {{-- Name --}}
                                    <div class="form-group">
                                        <label for="name" class="form-label">{{ __('Nom') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               name="name" id="name" placeholder="Nom" 
                                               required value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
        
                                    {{-- E-mail --}}
                                    <div class="form-group">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" id="email" placeholder="E-mail" 
                                               required value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    {{-- Phone number --}}
                                    <div class="form-group">
                                        <label for="phone_number" class="form-label">{{ __('Numéro de téléphon') }}e</label>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                               name="phone_number" id="phone_number" placeholder="Numéro de téléphone" 
                                               required value="{{ old('phone_number', $user->phone_number) }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
        
                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                        <div class="alert alert-warning mt-3">
                                            {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}
                                            <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                                                @csrf
                                                <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">{{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}</button>
                                            </form>
        
                                            @if (session('status') === 'verification-link-sent')
                                                <div class="alert alert-success mt-2">
                                                    {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <button type="submit" class="btn btn-outline-dark mt-3">{{ __('Sauvegarder') }}</button>
        
                                    @if (session('status') === 'profile-updated')
                                        <p class="mt-3 text-success">
                                            {{ __('Profil mis à jour avec succès.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        
        {{-- change password --}}
        <div class="white-box">
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                @method('put')
                <div class="container p-0">
                    <div class="row justify-content-center">
                        <div class="col-md-6 p-0">
                            <div class="card bg-white text-black">
                                <div class="card-body">
                                    <h4 class="card-title">{{ __('Mettre à jour le mot de passe') }}</h4>
                                    <p class="card-text">{{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité') }}.</p>
        
                                    {{-- Current Password --}}
                                    <div class="form-group">
                                        <label for="current_password" class="form-label">{{ __('Mot de passe actuel') }}</label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" placeholder="Current Password" required autocomplete="current-password">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
        
                                    {{-- New Password --}}
                                    <div class="form-group">
                                        <label for="password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="New Password" required autocomplete="new-password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
        
                                    {{-- Confirm New Password --}}
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">{{ __('Confirmer le nouveau mot de passe') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password" required autocomplete="new-password">
                                    </div>
        
                                    <button type="submit" class="btn btn-outline-dark">{{ __('Sauvegarder') }}</button>
        
                                    @if (session('status') === 'password-updated')
                                        <p class="mt-2 text-sm text-success">
                                            {{ __('Saved.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        

        {{-- delete acount --}}
        <div class="white-box card card-body">
            <section class="space-y-6 container justify-content-center ">
             
                    <h2 class="text-lg font-medium text-dark">
                        {{ __('Supprimer le compte') }}
                    </h2>
            
                    <p class="mt-1 text-sm text-muted">
                        {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
                    </p>
            
            
                <!-- Delete Account Button -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                    {{ __('Delete Account') }}
                </button>
            
                <!-- Modal -->
                <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')
            
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                                        {{ __('Êtes-vous sûr de vouloir supprimer votre compte?') }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
            
                                <div class="modal-body">
                                    <p class="text-muted">
                                        {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
                                    </p>
            
                                    <div class="mb-3">
                                        <label for="password" class="form-label sr-only">
                                            {{ __('Password') }}
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}">
                                        @if($errors->userDeletion->get('password'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->userDeletion->get('password')[0] }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger ms-3">
                                        {{ __('Supprimer le compte') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>

    </section>
@endsection

@section('script')
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
@endsection