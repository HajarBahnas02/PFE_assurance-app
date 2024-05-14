<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    // Le token de réinitialisation de mot de passe
    public $token;

    /**
     * Crée une nouvelle instance de la notification.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Obtenez le canal de notification pour l'envoi de la notification.
     *
     * @param  mixed  $notifiable
     * @return string|array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtenir le mail représentation de la notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
            ->action('Réinitialiser le mot de passe', 'http://localhost:5173/' . $this->token)
            ->line('Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.');
    }

    /**
     * Obtenir la représentation de l'aray pour JSON.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
