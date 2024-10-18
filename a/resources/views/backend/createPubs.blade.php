@extends('mylayouts.dashApp')

@section('title')
    Create Pubs
@endsection

@section('content')
    
    <div class="col-sm-12">
        <div class="white-box text-center">
            <h1 class="mb-5 fw-bold">Create Adds !</h1>

            <div class="container">
                <form action="" method="post">
                    <div class="row mb-5">

                        <div class="col">
                        <input type="text" class="form-control" placeholder="Product name" aria-label="First name">
                        </div>

                        <div class="col">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select catégorie</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">

                        <div class="col">
                        <textarea type="text" class="form-control" placeholder="Product description" aria-label="Last name"></textarea>
                        </div>
                        
                        <div class="col">
                        <textarea type="text" class="form-control" placeholder="description" aria-label="Last name"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
















