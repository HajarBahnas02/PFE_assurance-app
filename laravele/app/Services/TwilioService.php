<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $this->client = new Client($sid, $token);
    }

    public function sendWhatsAppMessage($to, $message)
    {
        $whatsappNumber = env('TWILIO_WHATSAPP_NUMBER');
        return $this->client->messages->create("whatsapp:$to", [
            'from' => "whatsapp:$whatsappNumber",
            'body' => $message,
        ]);
    }
}
