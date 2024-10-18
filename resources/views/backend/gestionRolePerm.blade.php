@extends('mylayouts.dashApp')

@section('title')
    Gestion Role Permission
@endsection

@section('content')
<div class="col-sm-12">
    {{-- Listes des Roles et leurs permissions --}}
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Roles & Permission Table</h3>
            <div class="table-responsive">
                @if ($roles && $permissions)
                    
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Roles</th>
                            <th class="border-top-0">Permissions</th>
                            <th class="border-top-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge badge-secondary" style="color: #444;">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>Aucun rôle ou permission n'a été trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
