@extends('mylayouts.app')

@section('titre')
Carnet d'Adresses
@endsection

@section('main')
<section class="section_page12">
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card border-end">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="card-title card-text">Mon carnet d'addresse</h1>
                            <div class="add_btn">
                                <a href="{{ route('carnet_adresses.create') }}" class="">Ajouter une adresse au carnet</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr class="text-bold">
                                        <th class="text-center">Nom</th>
                                        <th class="text-center">Adresse Google</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                @if($carnetAdresses->isEmpty())
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune adresse trouvée.</td>
                                    </tr>
                                </tbody>
                                @else
                                <tbody>
                                    @foreach($carnetAdresses as $adresse)
                                    <tr>
                                        <td class="align text-center">{{ $adresse->person_name }} ({{ $adresse->address_label }}) </td>
                                        <td class="align text-center">
                                            @if($adresse->has_google_address)
                                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($adresse->google_address) }}"
                                                target="_blank">
                                               Itineraire sur Google Maps <i class="fas fa-location-dot ms-2"></i>
                                            </a>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td class="align text-center">
                                            <a href="{{ route('carnet_adresses.edit', $adresse->uuid) }}"
                                                class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('carnet_adresses.destroy', $adresse->uuid) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                            <a href="{{ route('carnet_adresses.show', $adresse->uuid) }}"
                                                class="btn btn-secondary"><i class="fa-regular fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                                <tfoot>
                                    <tr class="text-bold">
                                        <th class="text-center">Nom</th>
                                        <th class="text-center">Adresse Google</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <nav aria-label="Page navigation example">
                            {{ $carnetAdresses->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
