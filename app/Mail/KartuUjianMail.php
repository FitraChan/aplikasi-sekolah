<?php

namespace App\Mail;

use App\Models\CalonSiswa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KartuUjianMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CalonSiswa $calonSiswa,
        public string $linkKartuUjian
    ) {
    }

    public function build()
    {
        return $this
            ->subject('Kartu Ujian Calon Siswa')
            ->view('emails.kartu-ujian');
    }
}