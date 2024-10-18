<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PinSentNotification extends Notification
{
    use Queueable;

    public $address;
    public $codePin;

    public function __construct($address, $codePin)
    {
        $this->address = $address;
        $this->codePin = $codePin;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'address' => [
                'id' => $this->address->id,
                'adressName' => $this->address->adressName,
            ],
            'codePin' => $this->codePin,
            'type' => 'pin_sent'
        ];
    }

}
