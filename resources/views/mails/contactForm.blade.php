
<h2>Wiadomość wysłana z formularza kontaktowego @if($copy) - kopia dla nadawcy @endif</h2>
<p>
    Nadawca: <strong>{{$user->name}}</strong><br>
    Adres email: <strong><a href="mailto:{{$mail->email}}">{{$mail->email}}</a></strong>
</p>

<p>
    Tytuł wiadomości: <strong>{{$mail->title}}</strong>
</p>
<p>
    Treść wiadomości:<br>
    {{$mail->text}}
</p>

<p><small>Wiadomość została wysłana: {{$mail->sended_at}}</small></p>
