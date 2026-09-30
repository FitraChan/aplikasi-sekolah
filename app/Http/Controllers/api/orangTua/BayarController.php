<?php

namespace App\Http\Controllers\api\orangTua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\Bayar;
use App\Models\DetBayar;
use App\Models\Gelombang;
use App\Models\ItemBayar;
use Illuminate\Support\Facades\DB;
use App\Models\DetTempBayar;
use App\Models\Kelas;
use App\Models\LogModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class BayarController extends Controller
{
    //
    public function index()
    {
        
          $auth = auth()->id();

          $sis = Siswa::with('tahunAjaran')->where('id_user', $auth)->first();

          $hasil = DB::table('tb_bayar')
                    ->join('tb_det_bayar', 'tb_bayar.id', '=', 'tb_det_bayar.id_bayar')
                    ->join('tb_itembayar', 'tb_det_bayar.id_item', '=', 'tb_itembayar.id')
                    ->select(
                        'tb_bayar.id_siswa',
                        'tb_det_bayar.id_item',
                        'tb_itembayar.nama_item',
                        DB::raw('SUM(tb_det_bayar.jml_bayar) as dibayar'),
                        DB::raw('SUM(tb_det_bayar.kwajiban_bayar) as kewajiban'),
                        DB::raw('SUM(tb_det_bayar.potongan) as potongan')
                    )
                    ->where('tb_bayar.id_siswa', $sis->nipd)
                    ->groupBy(
                        'tb_bayar.id_siswa',
                        'tb_det_bayar.id_item',
                        'tb_itembayar.nama_item'
                    )
                    ->orderBy('tb_det_bayar.id_item')
                    ->get();

             

                return response()->json([
                    'success' => true,
                    'data' => [
                        'siswa' => [
                            'nipd' => $sis->nipd,
                            'nama_lengkap' => $sis->nama_lengkap,
                            'kelas' => $sis->kelas->nama_kelas ?? '-',
                            'jurusan' => $sis->jurusan->nama_jurusan ?? '-',
                            'thn_ajaran' => $sis->tahunAjaran->thn_ajaran ?? '-',
                        ],
                        'pembayaran' => $hasil->map(function ($item) {
                            return [
                                'id_item' => $item->id_item,
                                'nama_item' => $item->nama_item,
                                'kewajiban' => (double) $item->kewajiban,
                                'potongan' => (double) $item->potongan,
                                'dibayar' => (double) $item->dibayar,
                                'sisa' => (double) (
                                    $item->kewajiban -
                                    $item->potongan -
                                    $item->dibayar
                                ),
                            ];
                        })->values(),
                    ],
                ]);


    }
    
    public function itemBayar(){
        
        $data = ItemBayar::select('id', 'nama_item')
        ->orderBy('nama_item')
        ->get();

    return response()->json([
        'success' => true,
        'message' => 'Data item pembayaran berhasil diambil',
        'data' => $data,
    ]);
        
        
    }
    
   

    public function simpanIpaymu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_trans' => ['nullable', 'date'],
            'item'      => ['required', 'integer', 'exists:tb_itembayar,id'],
            'nominal'   => ['required'],
            'comments'  => ['nullable', 'string', 'max:500'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak valid.',
                'errors'  => $validator->errors(),
            ], 422);
        }
    
        $user = $request->user();
        
    $auth = auth()->id();

    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna belum login.',
            ], 401);
        }
    
        $siswa = Siswa::where('id_user',  $auth)->first();
    
        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data calon siswa tidak ditemukan.',
            ], 404);
        }
    
        $itemBayar = ItemBayar::find($request->item);
    
        if (!$itemBayar) {
            return response()->json([
                'success' => false,
                'message' => 'Item pembayaran tidak ditemukan.',
            ], 404);
        }
    
        $nominal = (int) preg_replace(
            '/[^0-9]/',
            '',
            (string) $request->nominal
        );
    
        if ($nominal <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Nominal pembayaran harus lebih dari 0.',
            ], 422);
        }
    
        $apiKey = 'SANDBOX18AEF286-79CD-44C6-8764-2C89B94C7872';
        $va      = '0000007864357063';
        $url    = 'https://sandbox.ipaymu.com/api/v2/payment';
    
        if (!$apiKey || !$va || !$url) {
            return response()->json([
                'success' => false,
                'message' => 'Konfigurasi iPaymu belum lengkap.',
            ], 500);
        }
    
        DB::beginTransaction();
    
        try {
            $referenceId = 'INV-' . now()->format('YmdHis') . '-' .
                Str::upper(Str::random(6));
    
            $orderId = DB::table('tb_ipaymu_bayar')->insertGetId([
                'id_calon_siswa' => $siswa->nipd,
                'id_tahun'       => now()->format('Y'),
                'id_bulan'       => now()->format('m'),
                'tgl_bayar'      => $request->tgl_trans ?? now(),
                'id_kasir'       => $user->id,
                'via'            => 4,
                'sts_bayar'      => 2,
                'no_kwitansi'    => $referenceId,
                'keterangan'     => $request->comments,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
    
            DB::table('tb_ipaymu_det_bayar')->insert([
                'id_bayar'  => $orderId,
                'nama_item' => $itemBayar->nama_item,
                'id_item'   => $itemBayar->id,
                'jml_bayar' => $nominal,
                'id_user'   => $user->id,
            ]);
    
            $data = [
                'buyerName'  => $siswa->nama_lengkap,
                'buyerPhone' => $siswa->no_hp,
                'buyerEmail' => $siswa->email,
                'amount'     => $nominal,
                'referenceId'=> $referenceId,
                'product'    => [$itemBayar->nama_item],
                'qty'        => [1],
                'price'      => [$nominal],
    
                'notifyUrl' => route('notifyPembayaranSiswa'),
    
                // Bisa diarahkan ke halaman web milik Anda.
                'returnUrl' => url(
                    '/successPembayaranIpaymu'
                ),
    
                'cancelUrl' => url(
                    '/cancelPembayaranIpaymu'
                ),
            ];
    
            $timestamp   = now()->setTimezone('Asia/Jakarta')->format('YmdHis');

    
            $body = json_encode(
                $data,
                JSON_UNESCAPED_SLASHES
            );
    
            $bodyHash = strtolower(
                hash('sha256', $body)
            );
    
            $stringToSign = "POST:{$va}:{$bodyHash}:{$apiKey}";
    
            $signature = hash_hmac(
                'sha256',
                $stringToSign,
                $apiKey
            );
    
            $response = Http::timeout(30)
                ->acceptJson()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'signature'    => $signature,
                    'va'           => $va,
                    'timestamp'    => $timestamp,
                ])
                ->post($url, $data);
    
            $responseData = $response->json();
    
            if (
                !$response->successful() ||
                empty($responseData['Data']['Url'])
            ) {
                throw new \RuntimeException(
                    $responseData['Message']
                        ?? 'Gagal membuat transaksi iPaymu.'
                );
            }
    
            $paymentUrl = $responseData['Data']['Url'];
            $sessionId  = $responseData['Data']['SessionID'] ?? null;
    
            DB::table('tb_ipaymu_transaction')->insert([
                'id_bayar'        => $orderId,
                'ipaymu_ref'      => $referenceId,
                'amount'          => $nominal,
                'payment_url'     => $paymentUrl,
                'session_id'      => $sessionId,
                'ipaymu_response' => json_encode(
                    $responseData['Data']
                ),
                'status'          => 'pending',
                'signature'       => $signature,
                'created_at'      => now(),
            ]);
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat.',
                'data'    => [
                    'id_bayar'     => $orderId,
                    'reference_id' => $referenceId,
                    'session_id'   => $sessionId,
                    'payment_url'  => $paymentUrl,
                    'amount'       => $nominal,
                    'status'       => 'pending',
                ],
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
    
            report($e);
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function notifyPembayaranSiswa(Request $request)
    {
        // =========================
        // AMBIL DATA WAJIB
        // =========================
        $referenceId = $request->input('reference_id');


        if (!$referenceId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        DB::beginTransaction();

        // =========================
        // CARI TRANSAKSI (LOCK)
        // =========================
        $trx = DB::table('tb_ipaymu_transaction')
            ->where('ipaymu_ref', $referenceId)
            ->lockForUpdate()
            ->first();

        if (!$trx) {
            DB::rollBack();
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        // =========================
        // IDEMPOTENCY CHECK
        // =========================
        if ($trx->status === 'success') {
            DB::commit();
            return response()->json(['message' => 'Already processed'], 200);
        }

        // =========================
        // VALIDASI SETTLED
        // =========================
        // if ($statusCode !== 1 || $settlement !== 'settled') {
        //     DB::commit();
        //     return response()->json(['message' => 'Payment not settled'], 200);
        // }

        // =========================
        // UPDATE TRANSAKSI
        // =========================
        DB::table('tb_ipaymu_transaction')
            ->where('id', $trx->id)
            ->update([
                'status'          => 'success',
                'payment_method' => $request->input('via'),      // contoh: va
                'payment_channel' => $request->input('channel'),  // contoh: danamon
                'paid_at'        => $request->input('paid_at') ?? now(),
                'ipaymu_response' => json_encode($request->all()),
                'updated_at'     => now(),
            ]);

        $ipaymuBayar = DB::table('tb_ipaymu_bayar')
            ->where('id', $trx->id_bayar)
            ->first();

        $ipaymuDetBayar = DB::table('tb_ipaymu_det_bayar')
            ->where('id_bayar', $trx->id_bayar)
            ->first();

        $bayar = Bayar::create([
            'id_tahun'    => date('Y'),
            'id_bulan'    => date('m'),
            'id_siswa'    => $ipaymuBayar->id_calon_siswa,
            'no_kwitansi' => $request->no_kwitansi,
            'tgl_bayar'   => now(),
        //    'id_kasir'    => auth()->user()->id,
            'keterangan'  => $request->keterangan ?? 'Pembayaran iPaymu',
        ]);

        $idBayar = $bayar->id;

        DetBayar::create([
            'id_bayar'   => $idBayar,
            'id_item'    => $ipaymuDetBayar->id_item,
            'jml_bayar'  => $ipaymuDetBayar->jml_bayar,
            'id_cicilan' => $request->cicilan,
        ]);


        Bayar::updateBayar($idBayar);
        Bayar::updateKewajiban($idBayar);

        DB::commit();

        return response()->json(['message' => 'Notifikasi diterima'], 200);
    }

    
    
}