<?php

namespace App\Jobs;

use App\Mail\BroadcastEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Throwable;

class KirimBroadcastEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $timeout = 120;

    public function __construct(
        public string $email,
        public string $nama,
        public string $judul,
        public string $isi
    ) {
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(
            new BroadcastEmail(
                $this->nama,
                $this->judul,
                $this->isi
            )
        );
    }

    public function backoff(): array
    {
        return [60, 180, 300];
    }

    public function failed(Throwable $exception): void
    {
        logger()->error('Broadcast email gagal', [
            'email' => $this->email,
            'error' => $exception->getMessage(),
        ]);
    }
}