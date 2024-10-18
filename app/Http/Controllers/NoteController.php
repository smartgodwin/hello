<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->orderBy('created_at', 'desc')->get();
        return view('pages.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('pages.notes.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        try {
            Note::create([
                'title' => $request->title,
                'contenu' => $request->contenu,
                'user_id' => Auth::id(),
            ]);

            Toastr::success('Note ajoutée avec succès', 'Note', ["positionClass" => "toast-top-right"]);
            return redirect()->route('notes.index');
        } catch (\Exception $e) {
            Toastr::error('Une erreur est survenue lors de l\'ajout de la note.', 'Erreur', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    public function show(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('pages.notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('pages.notes.edit', compact('note'));
    }

    // Mettre à jour une note existante
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'contenu' => 'nullable|string',
        ]);

        try {
            if ($note->user_id !== Auth::id()) {
                abort(403, 'Accès non autorisé');
            }

            $note->update($request->all());

            Toastr::success('Note mise à jour avec succès', 'Note', ["positionClass" => "toast-top-right"]);
            return redirect()->route('notes.index');
        } catch (\Exception $e) {
            Toastr::error('Une erreur est survenue lors de la mise à jour de la note.', 'Erreur', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Note $note)
    {
        try {
            if ($note->user_id !== Auth::id()) {
                abort(403, 'Accès non autorisé');
            }

            $note->delete();

            Toastr::success('Note supprimée avec succès', 'Note', ["positionClass" => "toast-top-right"]);
            return redirect()->route('notes.index');
        } catch (\Exception $e) {
            Toastr::error('Une erreur est survenue lors de la suppression de la note.', 'Erreur', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
