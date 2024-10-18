@extends('mylayouts.app')

@section('titre')
    page 2
@endsection

@section('main')
    <section class=" section_page2">
        <div class="head_page2">
            <div class="head">
                <div class="ad_btn">
                    <a href="#">ajouter une address <span><i class="ps-3 fa-solid fa-plus"></i></span></a>
                </div>

                <div class="search">
                    <input type="search" name="search" id="search" placeholder="search...">
                    <button type="submit"><span><i class="fa-solid fa-magnifying-glass"></i></span></button>
                </div>
            </div>
            
            <div class="page3_message">
                <p class="m-0">aucun addess trouver</p>
            </div>
        </div>
    </section>
@endsection
