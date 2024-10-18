<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    // Ajoute une propriété pour stocker le token
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     */
    public function __construct($token)
    {
        // Assigner le token à la propriété
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Password reset request')
            ->greeting('Hi!')
            ->line('You have requested to reset your password.')
            // Utilise la route correcte pour générer le lien de réinitialisation
            ->action('Reset Password', route('password.reset', $this->token))
            ->line('If you did not request a reset, no action is required.')
            ->salutation('Sincerely, Sunofa');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            // Si tu souhaites ajouter des informations dans la notification sous forme de tableau
        ];
    }
}
