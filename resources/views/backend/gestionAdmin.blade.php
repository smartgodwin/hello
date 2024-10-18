@extends('mylayouts.dashApp')

@section('title')
    Gestion des Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">ADMIN Table</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Full Name</th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Roles</th>
                                <th class="border-top-0">Permissions</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($usersWithRoles as $user)
                                <tr class="align-items-center">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <div>
                                                <span class="badge bg-success">{{ $role->name }}</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="d-flex flex-wrap">
                                       
                                            @foreach($role->permissions as $permission)
                                                <li class="badge text-info d-flex w-100 flex-grow-1 mb-3" style="flex-basis: 25%; max-width: 25%;">{{ $permission->name }}</li>
                                            @endforeach
                                       
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
