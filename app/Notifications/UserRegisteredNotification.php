<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegisteredNotification extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue sur notre site')
            ->greeting('Bonjour ' . $this->user->first_name . '!')
            ->line('Merci de vous être inscrit sur notre site.')
            ->action('Se connecter', url('/login'))
            ->line('Si vous avez des questions, n\'hésitez pas à nous contacter.')
            ->salutation('Cordialement');
    }

    public function toArray($notifiable)
    {
        return [
            // Ajoutez les informations de l'utilisateur que vous souhaitez inclure
            'user_id' => $this->user->id,
            'name' => $this->user->first_name,
            // ...
        ];
    }
}
