<?php

namespace App\Http\Controllers;

use App\Models\Favory;
use Illuminate\Http\Request;

class FavoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->id;
        $favories = Favory::where('user_id', $user)->with('address')->get();
        return view('pages.favory', compact('favories'));
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
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        // Vérifiez si l'adresse est déjà dans les favoris
        $existingFavorie = Favory::where('user_id', auth()->id())
                                ->where('address_id', $request->address_id)
                                ->first();

        if ($existingFavorie) {
            return response()->json(['success' => false, 'message' => 'Address already in favorites']);
        }

        // Ajouter l'adresse aux favoris
        Favory::create([
            'user_id' => auth()->id(),
            'address_id' => $request->address_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Address added to favorites']);
    }

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
    public function destroy($addressId)
    {
        $user = auth()->user();
        
        // Trouver le favori à supprimer
        $user->favories()->detach($addressId);
        
        return redirect()->back()->with('status', 'Address removed from favorites successfully!');
    }
}
