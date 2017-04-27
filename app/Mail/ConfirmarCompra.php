<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmarCompra extends Mailable
{
    use Queueable, SerializesModels;
    
    public $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($total)
    {
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.compra')
				        ->cc('electronicapcolombia@gmail.com')
				        ->from('gunsnjrc@gmail.com', 'Softecol')
				        ->subject('Nueva compra registrada Softecol')
				        ->attach('pdf/'.$this->total['refcod'].'.pdf', ['as' => 'DetalleCompraSoftecol.pdf','mime' => 'application/pdf',]);
        			
    }
}
