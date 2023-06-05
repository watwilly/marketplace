<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Voyager;

class Payment extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $title;
    public $subtitle;
    public $item;
    public $cardtitle;

    public function __construct($payment, $title, $subtitle, $cardtitle)
    {
        $this->payment = $payment;
        $this->title  = $title;
        $this->cardtitle = $cardtitle;
        $this->subtitle = $subtitle;

        $this->item = $payment->comprasId()->select("titulo","cantidad","precio")->first();
    }

 
    public function build()
    {
        return $this->from(Voyager::setting('site.from'))->markdown('emails.payment')
            ->subject($this->title);
    }
}
