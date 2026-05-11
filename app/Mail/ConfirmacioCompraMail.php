<?php

namespace App\Mail;

use App\Models\Comanda;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacioCompraMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Comanda $comanda) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Confirmació de la teva compra #' . $this->comanda->id);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.compra');
    }
}
