<?php

namespace App\Http\Controllers;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class SmtpTestController extends Controller
{
    public function test()
    {
        $smtpHost = 'sandbox.smtp.mailtrap.io';
        $smtpPort = 2525;
        $smtpUsername = 'ce9026f22eaa27';
        $smtpPassword = 'votre_mot_de_passe'; // Remplacez par votre mot de passe Mailtrap

        // Crée une instance de Swift_SmtpTransport
        $transport = (new Swift_SmtpTransport($smtpHost, $smtpPort))
            ->setUsername($smtpUsername)
            ->setPassword($smtpPassword);

        // Crée une instance de Swift_Mailer
        $mailer = new Swift_Mailer($transport);

        // Crée un message
        $message = (new Swift_Message('Test de connexion SMTP'))
            ->setFrom(['your@example.com' => 'Your Name'])
            ->setTo(['recipient@example.com'])
            ->setBody('Test de connexion SMTP avec Laravel.');

        // Envoie le message
        $result = $mailer->send($message);

        if ($result) {
            return "Le test de connexion SMTP a réussi!";
        } else {
            return "Échec du test de connexion SMTP.";
        }
    }
}
