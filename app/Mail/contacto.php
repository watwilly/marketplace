<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Voyager;

class contacto extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $email;
    public $detalle;


    public function __construct($nombre, $email, $detalle)
    {
       $this->nombre = $nombre;
       $this->email = $email;
       $this->detalle = $detalle;
    }

    public function build()
    {
        return $this->view('emails.contacto')
            ->from(Voyager::setting('site.from'))
            ->subject('Contacto ventastucuman.com.com enviado por '.$this->nombre);
    }
}
