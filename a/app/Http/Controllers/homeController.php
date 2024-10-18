<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */


// AddressController.php
    public function index($id)
    {
        $user = User::findOrFail($id);

        $addresses = $user->addresses; 
        return view('pages.gestionAddress', compact('addresses'));
       
    }

     public function search()
    {
        return view('pages.seach');
    }
    public function doSearch(Request $request)
{
    // Validation de la requête
    $request->validate([
        'pseudo' => 'required|string|max:255',
    ]);

    $pseudo = $request->pseudo;
    $addresses = Address::where('pseudo', 'like', '%' . $pseudo . '%')->with('media', 'user')->get();

    if ($addresses->isEmpty()) {
        return redirect()->back()->with('error', 'Adresse non trouvée');
    } else {
        // Vérifie si l'utilisateur est authentifié avant d'appeler favories()
        if (auth()->check()) {
            foreach ($addresses as $address) {
                $address->isFavorited = auth()->user()->favories()->where('address_id', $address->id)->exists();
            }
        } else {
            // Si l'utilisateur n'est pas authentifié, toutes les adresses ne sont pas favorisées
            foreach ($addresses as $address) {
                $address->isFavorited = false;
            }
        }

        return view('pages.seach', compact('addresses'));
    }
}
    
    public function getUnreadNotificationsCount()
    {
        // Compter les notifications non lues pour l'utilisateur authentifié
        return Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
