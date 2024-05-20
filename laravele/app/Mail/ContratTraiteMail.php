<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContratTraiteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $baseUrl;
    public $clientId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($baseUrl, $clientId)
    {
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.offre')
                    ->subject('Votre offre personnalisée')
                    ->to($this->clientId) // Définir l'adresse e-mail du destinataire
                    ->with([
                        'baseUrl' => $this->baseUrl,
                        'clientId' => $this->clientId,
                    ]);
    }
}