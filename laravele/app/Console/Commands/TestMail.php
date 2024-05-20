<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'test:mail';

    protected $description = 'Send a test email';

    public function handle()
    {
        $to_email = 'bahnashajar@gmail.com';
        $subject = 'Test Email';
        $message = 'This is a test email from Laravel.';

        Mail::raw($message, function ($mail) use ($to_email, $subject) {
            $mail->to($to_email)->subject($subject);
        });

        $this->info('Test email sent successfully.');
    }
}
