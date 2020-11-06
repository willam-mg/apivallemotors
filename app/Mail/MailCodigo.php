<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCodigo extends Mailable
{
    use Queueable, SerializesModels;
    private $codigo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codigo = null)
    {
        $this->codigo = $codigo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.codigo', [
            'codigo'=>$this->codigo
        ]);
    }
}
