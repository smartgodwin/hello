<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Address;
use App\Jobs\RequestPinJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestPinMail;
use App\Notifications\RequestPinNotification;
use Brian2694\Toastr\Facades\Toastr;



class addressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.address');
    }

    public function uploadAudio(Request $request)
    {
        // dd($request->all());
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'audio1' => 'nullable|mimes:mp3,wav,ogg,webm|max:10240', // Maximum 10MB
            'audio2' => 'nullable|mimes:mp3,wav,ogg,webm|max:10240',
        ]);

        // Stocker les fichiers audio
        $audio1Path = null;
        $audio2Path = null;

        if ($request->hasFile('audio1')) {
            $audio1Path = $request->file('audio1')->store('audios', 'public');
        }
        if ($request->hasFile('audio2')) {
            $audio2Path = $request->file('audio2')->store('audios', 'public');
        }

        // Sauvegarder les autres données dans la base de données (si nécessaire)
        $data = [
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'audio1' => $audio1Path,
            'audio2' => $audio2Path,
        ];

        // Insérer dans la base de données si besoin
        // Example: AudioModel::create($data);

        return response()->json([
            'message' => 'Fichiers audio et données enregistrés avec succès!',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les champs du formulaire
        $request->validate([
            'pseudo' => 'required|string|max:255|unique:addresses,pseudo',
            'adressName' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'info' => 'nullable|string',
            'codePin' => 'nullable|numeric',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'audio1' => 'nullable|mimes:audio/mpeg,mpga,mp3,m4a,wav,webm|max:20480',
            'audio2' => 'nullable|mimes:audio/mpeg,mpga,mp3,m4a,wav,webm|max:20480',
            'video1' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            'video2' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
        ]);

        try {
            // Vérifier si les champs requis pour la création de l'adresse sont remplis
            // dd($request->all());

            if ($request->latitude && $request->longitude || $request->googleAddress) {

                // Créer l'adresse
                $address = Address::create([
                    'pseudo' => $request->pseudo,
                    'adressName' => $request->adressName,
                    'city' => $request->city,
                    'info' => $request->info,
                    'googleAddress' => $request->googleAddress,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'codePin' => $request->codePin,
                    'user_id' => auth()->id(),
                ]);
                // Créer une nouvelle instance de Media
                $media = new Media();
                $media->address_id = $address->id;

                // Gestion des fichiers uploadés et enregistrement direct dans le dossier public
                if ($request->hasFile('photo1')) {
                    $fileName = time().'_'.$request->file('photo1')->getClientOriginalName();
                    $request->file('photo1')->move(public_path('photos'), $fileName);
                    $media->photo1 = 'photos/' . $fileName;
                }

                if ($request->hasFile('photo2')) {
                    $fileName = time().'_'.$request->file('photo2')->getClientOriginalName();
                    $request->file('photo2')->move(public_path('photos'), $fileName);
                    $media->photo2 = 'photos/' . $fileName;
                }

                if ($request->hasFile('audio1')) {
                    $fileName = time().'_'.$request->file('audio1')->getClientOriginalName();
                    $request->file('audio1')->move(public_path('audios'), $fileName);
                    $media->audio1 = 'audios/' . $fileName;
                }

                if ($request->hasFile('audio2')) {
                    $fileName = time().'_'.$request->file('audio2')->getClientOriginalName();
                    $request->file('audio2')->move(public_path('audios'), $fileName);
                    $media->audio2 = 'audios/' . $fileName;
                }

                if ($request->hasFile('video1')) {
                    $fileName = time().'_'.$request->file('video1')->getClientOriginalName();
                    $request->file('video1')->move(public_path('videos'), $fileName);
                    $media->video1 = 'videos/' . $fileName;
                }

                if ($request->hasFile('video2')) {
                    $fileName = time().'_'.$request->file('video2')->getClientOriginalName();
                    $request->file('video2')->move(public_path('videos'), $fileName);
                    $media->video2 = 'videos/' . $fileName;
                }

                // Sauvegarder les médias associés à l'adresse
                $media->save();

                return response()->json(['success' => true, 'message' => 'Address and media uploaded successfull.']);

                // return redirect()->route('validation')->with('success', 'Address and media uploaded successfully.');
            } else {

                return response()->json(['error' => true, 'message' => 'Latitude/Longitude or Google Address is required.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $address = Address::with('media', 'user')->find($id);


        return view('pages.detail', compact('address'));

    }

    public function requestPin(Request $request, $addressId)
{
    try {
        // Trouver l'adresse et récupérer l'utilisateur associé
        $address = Address::with('user')->findOrFail($addressId);
        $reciver = Auth::user();

        // l'envoye par whatsapp

         $user = $address->user;
        // l'envoye par whatsapp
            $number = $user->phone_number;
            $siteUrl = url('/'); // Cela génère l'URL de base de ton application
            $addressUrl = url('/notification');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.ikookoservices.com/api/whatsapp/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "number": "'.$number.'",
               "message": "Salut '.$user->name .', vous avez une demande de code PIN  sur '. config('app.name').' de '. $reciver->name .' pour votre adresse '. $address->adressName .'.\n\n' .'Pour plus de détails, consultez ce lien : ' . $addressUrl . '",
                "sms_type": "plain"
                }
                ',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Api-key: cd593a1e-5499-4555-af59-93d482fbd91b'
                ),
            ));

            $response = curl_exec($curl);



        // Envoyer l'email directement
        Mail::to($address->user->email)->send(new RequestPinMail($address, $reciver));

        // Envoyer la notification directement
        $address->user->notify(new RequestPinNotification($reciver, $address));
            Toastr::success('Demande de code PIN envoyée avec succès', 'Demande de code pin', ["positionClass" => "toast-top-right"]);

        return redirect()->back()->with('success', 'Demande de code PIN envoyée avec succès');
    } catch (\Exception $e) {
        // Gérer les exceptions et retourner une réponse appropriée
        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de la demande de code PIN. Veuillez réessayer.');
    }
}

    public function validatePin(Request $request, $addressId)
    {
        $address = Address::findOrFail($addressId);
        // dd($address);
        $inputPin = $request->input('full_pin');
        //  dd($inputPin);
        $inputPin = intval($inputPin);
        if ($address->codePin === $inputPin) {
            return redirect()->route('address.show', $addressId)->with('status', 'Code PIN valide. Vous pouvez accéder à l\'adresse.');
        } else {
            return redirect()->back()->with('error', 'Code PIN incorrect. Veuillez réessayer.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = Address::with('media', 'user')->find($id);


        if (!$address) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        return view('pages.editAdresse', compact('address'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Valider les champs du formulaire
    $request->validate([
        'pseudo' => 'nullable|string|max:255|unique:addresses,pseudo,' . $id,
        'adressName' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'info' => 'nullable|string',
        'codePin' => 'nullable|numeric',
        'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'audio1' => 'nullable|mimes:audio/mpeg,mpga,mp3,m4a,wav|max:20480',
        'audio2' => 'nullable|mimes:audio/mpeg,mpga,mp3,m4a,wav|max:20480',
        'video1' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
        'video2' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
    ]);

    try {
        // Trouver l'adresse existante
        $address = Address::with('media')->findOrFail($id);

        // Mettre à jour les informations de l'adresse
        $address->update([
            'pseudo' => $request->pseudo,
            'adressName' => $request->adressName,
            'city' => $request->city,
            'info' => $request->info,
            'googleAddress' => $request->googleAddress,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'codePin' => $request->codePin,
        ]);

        // Gestion des fichiers uploadés et mise à jour des médias
        if ($address->media) {
            // Suppression des anciens fichiers et mise à jour des nouveaux
            if ($request->hasFile('photo1')) {
                $oldPhoto1 = $address->media->photo1;
                if ($oldPhoto1 && file_exists(public_path($oldPhoto1))) {
                    unlink(public_path($oldPhoto1));
                }
                $fileName = time().'_'.$request->file('photo1')->getClientOriginalName();
                $request->file('photo1')->move(public_path('photos'), $fileName);
                $address->media->photo1 = 'photos/' . $fileName;
            }

            if ($request->hasFile('photo2')) {
                $oldPhoto2 = $address->media->photo2;
                if ($oldPhoto2 && file_exists(public_path($oldPhoto2))) {
                    unlink(public_path($oldPhoto2));
                }
                $fileName = time().'_'.$request->file('photo2')->getClientOriginalName();
                $request->file('photo2')->move(public_path('photos'), $fileName);
                $address->media->photo2 = 'photos/' . $fileName;
            }

            if ($request->hasFile('audio1')) {
                $oldAudio1 = $address->media->audio1;
                if ($oldAudio1 && file_exists(public_path($oldAudio1))) {
                    unlink(public_path($oldAudio1));
                }
                $fileName = time().'_'.$request->file('audio1')->getClientOriginalName();
                $request->file('audio1')->move(public_path('audios'), $fileName);
                $address->media->audio1 = 'audios/' . $fileName;
            }

            if ($request->hasFile('audio2')) {
                $oldAudio2 = $address->media->audio2;
                if ($oldAudio2 && file_exists(public_path($oldAudio2))) {
                    unlink(public_path($oldAudio2));
                }
                $fileName = time().'_'.$request->file('audio2')->getClientOriginalName();
                $request->file('audio2')->move(public_path('audios'), $fileName);
                $address->media->audio2 = 'audios/' . $fileName;
            }

            if ($request->hasFile('video1')) {
                $oldVideo1 = $address->media->video1;
                if ($oldVideo1 && file_exists(public_path($oldVideo1))) {
                    unlink(public_path($oldVideo1));
                }
                $fileName = time().'_'.$request->file('video1')->getClientOriginalName();
                $request->file('video1')->move(public_path('videos'), $fileName);
                $address->media->video1 = 'videos/' . $fileName;
            }

            if ($request->hasFile('video2')) {
                $oldVideo2 = $address->media->video2;
                if ($oldVideo2 && file_exists(public_path($oldVideo2))) {
                    unlink(public_path($oldVideo2));
                }
                $fileName = time().'_'.$request->file('video2')->getClientOriginalName();
                $request->file('video2')->move(public_path('videos'), $fileName);
                $address->media->video2 = 'videos/' . $fileName;
            }

            // Sauvegarder les modifications des médias
            $address->media->save();
        } else {
            // Si aucun média n'existe encore, créer un nouveau média
            $media = new Media();
            $media->address_id = $address->id;

            if ($request->hasFile('photo1')) {
                $fileName = time().'_'.$request->file('photo1')->getClientOriginalName();
                $request->file('photo1')->move(public_path('photos'), $fileName);
                $media->photo1 = 'photos/' . $fileName;
            }

            if ($request->hasFile('photo2')) {
                $fileName = time().'_'.$request->file('photo2')->getClientOriginalName();
                $request->file('photo2')->move(public_path('photos'), $fileName);
                $media->photo2 = 'photos/' . $fileName;
            }

            if ($request->hasFile('audio1')) {
                $fileName = time().'_'.$request->file('audio1')->getClientOriginalName();
                $request->file('audio1')->move(public_path('audios'), $fileName);
                $media->audio1 = 'audios/' . $fileName;
            }

            if ($request->hasFile('audio2')) {
                $fileName = time().'_'.$request->file('audio2')->getClientOriginalName();
                $request->file('audio2')->move(public_path('audios'), $fileName);
                $media->audio2 = 'audios/' . $fileName;
            }

            if ($request->hasFile('video1')) {
                $fileName = time().'_'.$request->file('video1')->getClientOriginalName();
                $request->file('video1')->move(public_path('videos'), $fileName);
                $media->video1 = 'videos/' . $fileName;
            }

            if ($request->hasFile('video2')) {
                $fileName = time().'_'.$request->file('video2')->getClientOriginalName();
                $request->file('video2')->move(public_path('videos'), $fileName);
                $media->video2 = 'videos/' . $fileName;
            }

            // Sauvegarder le nouveau média
            $media->save();
        }

        return redirect()->back()->with('success', 'Address updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating the address: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = Auth::user()->id; // Initialiser l'ID de l'utilisateur

        try {
            // Trouver l'adresse avec les médias associés
            $address = Address::with('media')->findOrFail($id);

            // Supprimer les fichiers médias associés à l'adresse
            if ($address->media) {
                // Suppression des photos
                if ($address->media->photo1 && file_exists(public_path($address->media->photo1))) {
                    unlink(public_path($address->media->photo1));
                }
                if ($address->media->photo2 && file_exists(public_path($address->media->photo2))) {
                    unlink(public_path($address->media->photo2));
                }

                // Suppression des audios
                if ($address->media->audio1 && file_exists(public_path($address->media->audio1))) {
                    unlink(public_path($address->media->audio1));
                }
                if ($address->media->audio2 && file_exists(public_path($address->media->audio2))) {
                    unlink(public_path($address->media->audio2));
                }

                // Suppression des vidéos
                if ($address->media->video1 && file_exists(public_path($address->media->video1))) {
                    unlink(public_path($address->media->video1));
                }
                if ($address->media->video2 && file_exists(public_path($address->media->video2))) {
                    unlink(public_path($address->media->video2));
                }

                // Supprimer l'enregistrement des médias
                $address->media->delete();
            }

            // Supprimer l'adresse
            $address->delete();

            // Rediriger vers la route avec l'ID de l'utilisateur
            return redirect()->route('user.addresses', ['id' => $userId])->with('success', 'Address and associated media deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.addresses', ['id' => $userId])->with('error', 'An error occurred while deleting the address: ' . $e->getMessage());
        }
    }


}
