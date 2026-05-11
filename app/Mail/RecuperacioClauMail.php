<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperacioClauMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public string $novaClau) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Recuperació de clau — Tenda Gourmet');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.recuperacio');
    }
}
