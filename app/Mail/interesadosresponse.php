<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Voyager;

class interesadosresponse extends Mailable
{
    use Queueable, SerializesModels;

    public $question;
    public $post;
    public $answer;

    public function __construct($question, $post,$answer)
    {
       $this->question = $question;
       $this->post = $post;
       $this->answer = $answer;
    }

    public function build()
    {
        return $this->from(Voyager::setting('site.from'))->markdown('emails.answer')
            ->subject('Respuesta de '. $this->post.' ventastucuman.com');
    }
}
