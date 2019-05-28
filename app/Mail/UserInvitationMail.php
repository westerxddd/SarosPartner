<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->subject = 'Saros - Rejestracja nowego konta użytkownika';
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = view('mails.invitation', [
            'user' => $this->user
        ]);

        return $this
            ->from($_ENV['MAIL_FROM'])
            ->view('mails.layout',['content'=>$content]);
    }
}
