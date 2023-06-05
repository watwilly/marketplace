<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Voyager;

class Plantilla extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $apellido;
    public $email;
    public $pTitulo;
    public $pImagen;
    public $pTexto;


    public function __construct($nombre, $apellido, $email, $pTitulo, $pImagen, $pTexto)
    {
       $this->nombre = $nombre;
       $this->apellido = $apellido;
       $this->email = $email;
       $this->pTitulo = $pTitulo;
       $this->pImagen = $pImagen;
       $this->pTexto = $pTexto;
    }

    public function build()
    {
        return $this->view('emails.plantilla')
            ->from(Voyager::setting('site.from'))
            ->subject($this->pTitulo);
    }
}
