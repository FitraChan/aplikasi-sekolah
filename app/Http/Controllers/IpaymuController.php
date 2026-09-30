<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IpaymuController extends Controller
{
    /**
     * Halaman setelah pengguna kembali dari pembayaran iPaymu.
     *
     * Halaman ini tidak langsung menetapkan transaksi lunas.
     * Status pembayaran tetap mengikuti callback notifyPembayaran.
     */
    public function success(Request $request)
    {              

        return view('keuangan.ipaymu-success', []);
    }

    /**
     * Halaman ketika pengguna membatalkan pembayaran.
     *
     * Pembatalan halaman checkout tidak selalu berarti transaksi
     * harus dihapus. Data tetap disimpan agar dapat dibayar ulang.
     */
    public function cancel(Request $request)
    {
        
        return view('keuangan.ipaymu-cancel', []);
    }

   

    
}