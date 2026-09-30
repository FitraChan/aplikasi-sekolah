<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BroadcastEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $nama;
    public string $judul;
    public string $isi;

    public function __construct(
        string $nama,
        string $judul,
        string $isi
    ) {
        $this->nama = $nama;
        $this->judul = $judul;
        $this->isi = $isi;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->judul,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.broadcast',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}