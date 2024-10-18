@extends('mylayouts.dashApp')

@section('title')
    Create Role Permission
@endsection

@section('content')
<div class="col-sm-12">
    <div class="white-box text-center">
        <h1 class="mb-5 fw-bold">Create Permission !</h1>

        <div class="container">
            <form action="{{ route('permission.store') }}" method="post">
                @csrf
                <div class="row mb-2">

                    <div class="col">
                        <input type="text" name="name" class="form-control" placeholder="permission name" aria-label="First name">

                        <div class="mt-4 float-start">
                            <button type="submit" class="btn btn-primary">create</button>
                        </div>
                    </div>

                    <div class="col">
                       {{-- les PERMISSION --}}
                       <div class="justify-between items-center">
                            <label for="" class="fw-bold fs-4">les permisions disponible</label>
                            <div class="d-flex flex-wrap">
                                @foreach ($roles as $role)

                                    <div class="d-flex w-100 flex-grow-1" style="flex-basis: 25%; max-width: 25%;">
                                        <input class="form-check-input me-2" name="role[{{ $role->id }}]" type="checkbox" value="{{ $role->id }}" id="flexCheckChecked" >
                                        <label class="form-check-label" for="flexCheckChecked"  >
                                            {{ $role->name }}
                                        </label>
                                    </div>

                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

    {{-- create Role --}}
    <div class="white-box text-center">
        <h1 class="mb-5 fw-bold">Create Role !</h1>

        <div class="container">
            <form action="{{ route('role.store') }}" method="post">
                @csrf
                <div class="row mb-2">
                    
                    <div class="col">
                        <input type="text" name="name" class="form-control" placeholder="Role name" aria-label="First name">
                       
                        <div class="mt-4 float-start">
                            <button type="submit" class="btn btn-primary">create</button>
                        </div>
                    </div>

                    <div class="col">
                       {{-- les Roles --}}
                       <div class="justify-between items-center">
                        <label for="" class="fw-bold fs-4">les Roles disponible</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($permissions as $permission)

                                <div class="d-flex w-100 flex-grow-1" style="flex-basis: 25%; max-width: 25%;">
                                    <input class="form-check-input me-2" name="permission[{{ $permission->id }}]" type="checkbox" value="{{ $permission->id }}" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked"  >
                                        {{ $permission->name }}
                                    </label>
                                </div>

                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection