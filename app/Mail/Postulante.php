<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Voyager;

class Postulante extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $oferta;

    public function __construct($user, $oferta)
    {
        $this->user = $user;
        $this->oferta = $oferta;
    }

    public function build()
    {
        return $this->view('emails.postulante')
            ->from(Voyager::setting('site.from'))
            ->subject('Se han postulado a tu oferta laboral '. $this->oferta->titulo);
    }
}
