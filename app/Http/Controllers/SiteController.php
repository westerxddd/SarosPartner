<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function contactForm(){
        return view('sites.contactForm');
    }

    public function sendMsg(Request $request){

        $mail = new \stdClass();
        $mail->title = $request->title;
        $mail->email = $request->email;
        $mail->text = $request->text;
        $mail->sended_at = now()->format('d.m.Y H:i:s');

        Mail::to(env('MAIL_TO'))->send(new ContactFormMail($mail));
        Mail::to(auth()->user()->email)->send(new ContactFormMail($mail,true));

        return redirect()->back()->with('success','Wiadomość została pomyślnie wysłana!');
    }
}
