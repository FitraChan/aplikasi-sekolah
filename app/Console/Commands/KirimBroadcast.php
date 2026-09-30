<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class KirimBroadcast extends Command
{
    protected $signature = 'broadcast:kirim';

    protected $description = 'Kirim broadcast email';
    public function handle()
{
    Log::info('Cron broadcast berjalan');

    $data = DB::table('tb_antrian_email')
        ->where('status', 0)
        ->limit(10)
        ->get();

    foreach($data as $row)
    {
        try {

            Mail::send([], [], function ($message) use ($row) {

                $message->to($row->email)
                        ->subject($row->judul)
                        ->html($row->pesan);

            });

            DB::table('tb_antrian_email')
                ->where('id', $row->id)
                ->update([
                    'status' => 1
                ]);

            Log::info('Email berhasil dikirim ke: ' . $row->email);

        } catch (\Exception $e) {

            DB::table('tb_antrian_email')
                ->where('id', $row->id)
                ->update([
                    'status' => 2
                ]);

            Log::error('Gagal kirim email: ' . $e->getMessage());
        }
    }

    $this->info('Broadcast selesai');
}
}
