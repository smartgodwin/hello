@extends('mylayouts.app')

@section('titre')
Notes
@endsection

@section('main')
<section class="section_page12">
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card border-end">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="card-title card-text">Mes notes</h1>
                                <div class="add_btn">
                                    <a href="{{ route('notes.create') }}" class="">Ajouter une note</a>
                                </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr class="text-bold">
                                        <th class="text-center">Note</th>
                                        <th class="text-center">Contenu</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                @if($notes->count() === 0)
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune note
                                            trouvée.</td>
                                    </tr>
                                </tbody>
                                @else
                                <tbody>
                                    @foreach($notes as $note)
                                    <tr>
                                        <td class="align text-center">{{ $note->title }} </td>
                                        <td class="align text-center">{{ Str::limit(strip_tags($note->contenu), 20) }} </td>
                                        <td class="align text-center">
                                            <a href="{{ route('notes.edit', $note->uuid) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('notes.destroy', $note->uuid) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                            <a href="{{ route('notes.show', $note->uuid) }}" class="btn btn-secondary"><i class="fa-regular fa-eye"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                                <tfoot>
                                    <tr class="text-bold">
                                        <th class="text-center">Note</th>
                                        <th class="text-center">Contenu</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <nav aria-label="Page navigation example">
                           
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
