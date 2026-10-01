<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\TemplateBayar;
use App\Models\TahunAjaran;
use App\Models\ItemBayar;
use Illuminate\Support\Facades\DB;
use App\Models\Gelombang;
use App\Models\DetTempBayar;
use App\Models\Konfig;
use App\Models\Siswa;
use App\Models\LogModel;
use Illuminate\Http\Request;



class TemplatePendaftaranController extends Controller
{

    var $tahun, $smt;

    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_tahun;
        $this->smt = $konfig->smt;
    }
   public function index()
{
    $tahun = $this->tahun;

    $tahunAjaran = TahunAjaran::find($tahun);

    $gelombang = Gelombang::with([

        // Gelombang
        'templateBayar:id,id_tahun,id_jurusan,id_gelombang',

        // Detail template
        'templateBayar.detTemplateBayar:id,id_template,id_item,jml_bayar,ket_bayar',

        // Item pembayaran
        'templateBayar.detTemplateBayar.itemBayar:id,nama_item,id_kategori,id_kat_periode',

        // Kategori
        'templateBayar.detTemplateBayar.itemBayar.kategori:id,nama_kategori',

        // Periode
        'templateBayar.detTemplateBayar.itemBayar.periode:id,nama_periode',

    ])

    ->whereHas('templateBayar', function ($query) use ($tahun) {

        $query->where('id_tahun', $tahun);

    })

    ->whereHas('templateBayar.detTemplateBayar.itemBayar', function ($query) {

        $query->whereIn('id_kategori', [1, 2]);

    })

    ->orderByDesc('id')
    

    ->get();


    $items = collect();


    foreach ($gelombang as $gel) {

        foreach ($gel->templateBayar as $template) {

            foreach ($template->detTemplateBayar as $detail) {

                /*
                |--------------------------------------------------------------------------
                | Pastikan item ada
                |--------------------------------------------------------------------------
                */

                if (!$detail->itemBayar) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Hanya kategori 1 dan 2
                |--------------------------------------------------------------------------
                */

                if (!in_array(
                    $detail->itemBayar->id_kategori,
                    [1, 2]
                )) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Masukkan ke collection
                |--------------------------------------------------------------------------
                */

                $items->push([

                    'id' => $detail->id,

                    'id_template' => $template->id,

                    'id_tahun' => $template->id_tahun,

                    /*
                    |--------------------------------------------------------------------------
                    | DATA GELOMBANG
                    |--------------------------------------------------------------------------
                    */

                    'id_gelombang' => $gel->id,

                    'nama_gelombang' => $gel->nama_gelombang,

                    /*
                    |--------------------------------------------------------------------------
                    | DATA ITEM
                    |--------------------------------------------------------------------------
                    */

                    'id_item' => $detail->id_item,

                    'nama_item' =>
                        $detail->itemBayar->nama_item ?? '',

                    'kategori' =>
                        $detail->itemBayar->kategori->nama_kategori ?? '',

                    'periode' =>
                        $detail->itemBayar->periode->nama_periode ?? '',

                    'jml_bayar' =>
                        $detail->jml_bayar ?? 0,

                    'ket_bayar' =>
                        $detail->ket_bayar ?? '',
                ]);
            }
        }
    }

    $items = $items->groupBy([
    'id_gelombang',
    'id_item',
]);


    return view('pendaftaran.pembayaran.index', [

        'side' => 'template-bayar-pendaftaran',

        'data' => $items,

        'tahunAjaran' => $tahunAjaran,

    ]);
}

    public function data(Request $request)
    {
        return DetTempBayar::with([
            'itemBayar:id,nama_item,id_kategori,id_kat_periode',
            'itemBayar.kategori:id,nama_kategori',
            'itemBayar.periode:id,nama_periode'
        ])

            ->whereHas('itemBayar', function ($query) {
                $query->whereIn('id_kategori', [1, 2]);
            })
            ->limit(3)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($row) {
                return [
                    'id'        => $row->id,
                    'id_item'   => $row->id_item,
                    'nama_item' => $row->itemBayar->nama_item ?? '',
                    'kategori'  => $row->itemBayar->kategori->nama_kategori ?? '',
                    'periode'   => $row->itemBayar->periode->nama_periode ?? '',
                    'jml_bayar' => $row->jml_bayar,
                    'ket_bayar' => $row->ket_bayar,
                ];
            });
    }
}
