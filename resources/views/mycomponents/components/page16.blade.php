@extends('mylayouts.app')

@section('titre')
    page16
@endsection

@section('main')
    <section class="section_page16">
    
        <h2 class="mb-4">Voulez-vous modifier votre <br>
             CODE PIN ?</h2>
        <div class="pin-form-container">
                    <form id="pin-change-form">
                        <div class="form-group">
                            <label for="old-pin">Ancien code PIN</label>
                            <input type="password" id="old-pin" placeholder="Saisissez votre ancien code PIN" required>
                        </div>
                        <div class="form-group">
                            <label for="new-pin">Nouveau code PIN</label>
                            <input type="password" id="new-pin" placeholder="Créez un nouveau code PIN" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-pin">Conformez le nouveau code PIN</label>
                            <input type="password" id="confirm-pin" placeholder="Conformez le nouveau code PIN" required>
                        </div>
                        <button type="submit">SOUMETTRE</button>
                    </form>
        </div>
        
    </section>
@endsection
