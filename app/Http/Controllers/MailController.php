<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendTestMail()
    {
        $details = [
            'title' => 'Mail from Laravel',
            'body' => 'This is a test mail sent from Laravel.'
        ];

        Mail::to('riftgofen@gmail.com')->send(new TestMail($details));

        return "Email Sent!";
    }
}
