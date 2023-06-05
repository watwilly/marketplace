<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class interesados extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $mensaje;
    public $post;

    public function __construct($email, $mensaje, $post)
    {
       $this->email = $email;
       $this->mensaje = $mensaje;
       $this->post = $post;
    }

    public function build()
    {
        return $this->from(setting('site.from'))->markdown('emails.interesados')
            ->subject('Su publicacion '. $this->post->title. ' Tiene una nueva consulta');
    }
}
