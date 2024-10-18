@extends('mylayouts.dashApp')

@section('title')
    Create users
@endsection

@section('content')
<div class="col-sm-12">
    <div class="white-box text-center">
        <h1 class="mb-5 fw-bold">Create Admins !</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <form action="{{ route('admin.store') }}" method="post">
                @csrf
                <div class="row mb-5">

                    <div class="col">
                        <input type="text" name="name" class="form-control" placeholder="Full name" >
                    </div>

                    <div class="col">
                        <input type="email" name="email" class="form-control" placeholder="Email" >
                    </div>
                </div>

                <div class="row mb-5">

                    <div class="col">
                        <input type="number" name="phone_number" class="form-control mb-5" placeholder="Phone number" >

                        <select name="role" class="form-select mb-5" aria-label="Default select example">
                            <option selected>Select Role</option>
                            @if ($roles)
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        <button class="btn btn-primary rounded-2 w-50" type="submit">Create ADMIN</button>
                    </div>


                    <div class="col">
                        <input type="password" name="password" class="form-control mb-5" placeholder="Password" >
                        <input type="password" class="form-control" placeholder="Confirm-Password" >
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection