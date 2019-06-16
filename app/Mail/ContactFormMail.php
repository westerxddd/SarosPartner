<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $copy = false)
    {
        $this->subject = $copy? 'Saros - Formularz kontaktowy - kopia dla nadawcy' : 'Saros - Formularz kontaktowy';
        $this->user = auth()->user();
        $this->mail = $mail;
        $this->copy = $copy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = view('mails.contactForm', [
            'user' => $this->user,
            'mail' => $this->mail,
            'copy' => $this->copy
        ]);

        return $this
            ->from(auth()->user()->email)
            ->view('mails.layout',['content'=>$content]);
    }
}
