<?php

namespace App\Http\Controllers;

use App\Models\CarnetAdresse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CarnetAdresseController extends Controller
{
    public function index()
    {
        $carnetAdresses = Auth::user()
                          ->carnetAdresses()
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
        return view('pages.carnet_adresses.index', compact('carnetAdresses'));
    }

    // Afficher le formulaire de création d'une adresse
    public function create()
    {
        return view('pages.carnet_adresses.create');
    }

    // Enregistrer une nouvelle adresse
    public function store(Request $request)
    {

        $request->validate([
            'person_name' => 'required|string|max:255',
            'address_label' => 'required|string|max:255',
            'apartment_suite_note' => 'nullable|string',
            'has_google_address' => 'nullable|boolean',
            'google_address' => 'nullable|string',
        ]);
        // dd($request->all());

        try {
            $carnetAdresse = CarnetAdresse::create([
                'person_name' => $request->person_name,
                'address_label' => $request->address_label,
                'apartment_suite_note' => $request->apartment_suite_note,
                'has_google_address' => $request->has('has_google_address') ? true : false,
                'google_address' => $request->google_address,
                'user_id' => Auth::id(),
            ]);

            // dd($carnetAdresse);

            Toastr::success('Adresse ajoutée au carnet avec succès', 'Carnet d\'adresses', ["positionClass" => "toast-top-right"]);
            return redirect()->route('carnet_adresses.index');
        } catch (\Exception $e) {
            Toastr::error('Une erreur est survenue lors de l\'ajout de l\'adresse au carnet.', 'Erreur', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    // Afficher une adresse spécifique
    public function show(CarnetAdresse $carnet_adresse)
    {
        if ($carnet_adresse->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('pages.carnet_adresses.show', compact('carnet_adresse'));
    }

    // Afficher le formulaire d'édition d'une adresse
    public function edit(CarnetAdresse $carnet_adresse)
    {
        if ($carnet_adresse->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('pages.carnet_adresses.edit', compact('carnet_adresse'));
    }
    public function update(Request $request, CarnetAdresse $carnet_adresse)
    {
        $request->validate([
            'person_name' => 'nullable|string|max:255',
            'address_label' => 'nullable|string|max:255',
            'apartment_suite_note' => 'nullable|string',
            'has_google_address' => 'nullable|boolean',
            'google_address' => 'nullable|string',
        ]);

        try {
            if ($carnet_adresse->user_id !== Auth::id()) {
                abort(403, 'Accès non autorisé');
            }

            $carnet_adresse->update($request->all());

            Toastr::success('Adresse mise à jour dans carnet avec succès', 'Carnet d\'adresses', ["positionClass" => "toast-top-right"]);
            return redirect()->route('carnet_adresses.index');
        } catch (\Exception $e) {
            Toastr::error('Une erreur est survenue lors de la mise à jour de l\'adresse du carnet.', 'Erreur', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    // Supprimer une adresse
    public function destroy(CarnetAdresse $carnet_adresse)
    {
        try {
            if ($carnet_adresse->user_id !== Auth::id()) {
                abort(403, 'Accès non autorisé');
            }

            $carnet_adresse->delete();

            Toastr::success('Adresse supprimée du carnet avec succès', 'Carnet d\'adresses', ["positionClass" => "toast-top-right"]);
            return redirect()->route('carnet_adresses.index');
        } catch (\Exception $e) {
            Toastr::error('Une erreur est survenue lors de la suppression de l\'adresse.', 'Erreur', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

}
