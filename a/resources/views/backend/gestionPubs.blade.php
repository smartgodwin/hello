@extends('mylayouts.dashApp')

@section('title')
    Gestion des Pubs
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Add's Table</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Products name</th>
                                <th class="border-top-0">compagny information</th>
                                <th class="border-top-0">Create at</th>
                                <th class="border-top-0">expire at</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Coca cola</td>
                                <td>Prohaska jfjkf fksnc slnfskf </td>
                                <td><input type="date" name="" id=""></td>
                                <td><input type="date" name="" id=""></td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection