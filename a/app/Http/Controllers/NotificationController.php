<?php

namespace App\Http\Controllers;

use App\Mail\RequestPinMail;
use App\Mail\SendCodePinMail;
use App\Models\Address;
use App\Models\User;
use App\Notifications\PinSentNotification;
use App\Notifications\RequestPinNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;


class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->paginate(5);
        return view("pages.notification", compact("notifications"));
    }

    public function markAsRead($id)
    {
        try {
            $notification = Auth::user()->notifications()->findOrFail($id);
            $notification->markAsRead();
            return redirect()->back()->with('success', 'Notification marquée comme lue avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la lecture de la notification. Veuillez réessayer.');
        }
    }

    public function sendCodePin($id)
    {
        try {
            $notification = Auth::user()->notifications()->findOrFail($id);
            $address = Address::find($notification->data['address']['id']);
            $reciver = User::find($notification->data['reciver']['id']);

            if ($address && $reciver) {
                // Envoyer l'email directement
                Mail::to($reciver->email)->send(new SendCodePinMail($address, $reciver));

                // Envoyer la notification directement
                $reciver->notify(new PinSentNotification($address, $address->codePin));

                // Marquer la notification comme lue
                $notification->markAsRead();

                Toastr::success('Code PIN envoyé avec succès', 'Code pin', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'Adresse ou utilisateur non trouvé.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi du code PIN. Veuillez réessayer.');
        }
    }

    public function requestPin($id)
    {
        try {
            $notification = Auth::user()->notifications()->findOrFail($id);
            $address = Address::find($notification->data['address']['id']);
            $reciver = User::find($notification->data['reciver']['id']);

            if ($address && $reciver) {
                // Envoyer l'email directement
                Mail::to($address->user->email)->send(new RequestPinMail($address, $reciver));

                // Envoyer la notification directement
                $address->user->notify(new RequestPinNotification($reciver, $address));
                Toastr::success('Demande de code PIN envoyée avec succès', 'Code pin',["positionClass" => "toast-top-right"]
                );
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'Adresse ou utilisateur non trouvé.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de la demande de code PIN. Veuillez réessayer.');
        }
    }

    public function destroy($id)
    {
        try {
            $notification = Auth::user()->notifications()->findOrFail($id);
            $notification->delete();

            Toastr::success('notification supprimé', 'Code pin', ["positionClass" => "toast-top-right"]);
            return redirect()->back()->with('success', 'Notification supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de la notification. Veuillez réessayer.');
        }
    }
}
