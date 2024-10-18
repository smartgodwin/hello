<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
 
    <title>Demande de code PIN</title>
</head>
<style>
    /* le style du maill de code pin */
    .body{
        font-family: sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
.section_mail{
    font-family: sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 90vh;
    background-image: linear-gradient(rgba(255, 255, 255, 0.76),rgba(255, 255, 255, 0.76)),url({{asset('frontend/image/logo_sunofa_map.jpg')}});
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}
.mail_contener{
    font-family: sans-serif;
    width: 80%;
    height: fit-content;
    padding: 10% 5%;
    text-align: center;
    background: transparent;
    backdrop-filter: blur(1px);
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 20px;
}
.foot{
    font-family: sans-serif;
    position: absolute;
    bottom: 0;
    margin-bottom: 15px;  
}
</style>
<body>
    <section class="section_mail">
        <div class="mail_contener">
            <h1>{{ __('Demande de code PIN') }}</h1>
            <p>{{ __('Une demande de code PIN a été faite pour votre adresse') }} : {{ $address->adressName }}</p>
            <p>{{ __('La demande  a été faite par') }} : {{ $reciver->name }}</p>
            <p>{{ __('L\'email du demandeur de code pin est') }}  : {{ $reciver->email }}</p>
            <p>{{ __('Le numéro de téléphone du demandeur est ') }} : {{ $reciver->phone_number }}</p>
            <a href="{{ route('notifications.index') }}" class="btn btn-primary mb-3">{{ __('Voir la notification') }}</a>
            <p class="foot">{{ __('Merci d\'utiliser notre application') }}!</p>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
