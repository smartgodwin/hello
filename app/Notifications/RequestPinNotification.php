<?php

namespace App\Notifications;

use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestPinNotification extends Notification
{
    use Queueable;

    public $reciver;
    public $address;

    public function __construct($reciver, $address)
    {
        $this->reciver = $reciver;
        $this->address = $address;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line('Une demande de code PIN a été faite pour votre adresse : ' . $this->address->adressName)
        ->action('Voir l\'adresse', url('/'))
        ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'address' =>   $this->address,
            'reciver' =>   $this->reciver,
            'type' => 'pin_request'
        ];
    }
}
