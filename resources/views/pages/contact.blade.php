@extends('mylayouts.app')

@section('titre')
    contactez-nous
@endsection

@section('main')
   
    <section class="d-flex justify-content-center align-items-center w-100" style="min-height: 100vh">
        <div class="card">
            <span class="title">{{ __('Laisser un commentaire') }}</span>
            <form class="form">
                <div class="group">
                <input placeholder="‎" type="text" required="">
                <label for="name">{{ __('Nom') }}</label>
                </div>
            <div class="group">
                <input placeholder="‎" type="email" id="email" name="email" required="">
                <label for="email">Email</label>
                </div>
            <div class="group">
                <textarea placeholder="‎" id="comment" name="comment" rows="5" required=""></textarea>
                <label for="comment">{{ __Commentaire('Commentaire') }}</label>
            </div>
                <button type="submit">{{ __('Soumettre') }}</button>
            </form>
            </div>
    </section>

@endsection

@section('css')
   
    .card {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    width: 350px;
    display: flex;
    flex-direction: column;
    }

    .title {
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    }

    .form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    }

    .group {
    position: relative;
    }

    .form .group label {
    font-size: 14px;
    color: rgb(99, 102, 102);
    position: absolute;
    top: -10px;
    left: 10px;
    background-color: #fff;
    transition: all .3s ease;
    }

    .form .group input,
    .form .group textarea {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    outline: 0;
    width: 100%;
    background-color: transparent;
    }

    .form .group input:placeholder-shown+ label, .form .group textarea:placeholder-shown +label {
    top: 10px;
    background-color: transparent;
    }

    .form .group input:focus,
    .form .group textarea:focus {
    border-color: #3366cc;
    }

    .form .group input:focus+ label, .form .group textarea:focus +label {
    top: -10px;
    left: 10px;
    background-color: #fff;
    color: #3366cc;
    font-weight: 600;
    font-size: 14px;
    }

    .form .group textarea {
    resize: none;
    height: 100px;
    }

    .form button {
    background-color: #3366cc;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    }

    .form button:hover {
    background-color: #27408b;
    }


@endsection