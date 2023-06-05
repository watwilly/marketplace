<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Voyager;

class reportes extends Mailable
{
    use Queueable, SerializesModels;

    public $post_id;
    public $user_id;
    public $detalle_reporte;

    public function __construct($post_id, $user_id, $detalle_reporte)
    {
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->detalle_reporte = $detalle_reporte;
    }

    public function build()
    {
        return $this->view('emails.reportes')
            ->from(Voyager::setting('site.from'))
            ->subject('Se ha recibido un nuevo reporte de publicacion');
    }
}
