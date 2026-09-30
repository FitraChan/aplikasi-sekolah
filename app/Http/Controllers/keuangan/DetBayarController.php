<?php

namespace App\Http\Controllers\keuangan;
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

class DetBayarController extends Controller
{
    //

    public function store(Request $request)
    {
      

        try {

            $detail = DetBayar::create([
                'id_bayar'       => $request->id_bayar,
                'id_item'        => $request->id_item ?? 0,
                'jml_bayar'      => $request->jml_bayar ?? 0,
                'kwajiban_bayar' => $request->kwajiban_bayar ?? 0,
                'id_cicilan'     => $request->id_cicilan ?? 0,
                'keterangan'     => $request->keterangan ?? 0,
            ]);


            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_det_bayar',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($detail),
                'serial' => url('store')
            ]);

  
            // update total bayar
            $this->uptotalbayar($request->id_bayar);

            

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data telah tersimpan. ID : ' . $detail->id,
                'id'      => $detail->id,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Peringatan',
                'msg'     => 'Gagal menyimpan data',
                'error'   => $e->getMessage(),
                'data'    => $request->all()
            ], 500);
        }
    }

   public function update(Request $request, $id)
    {
        try {

            $detail = DetBayar::findOrFail($id);

            $detail->update([
                'id_item'        => $request->id_item,
                'kwajiban_bayar' => $request->kwajiban_bayar,
                'jml_bayar'      => $request->jml_bayar,
                'potongan'       => $request->potongan,
                'id_cicilan'     => $request->id_cicilan,
                'keterangan'     => $request->keterangan,
            ]);

            $this->uptotalbayar($request->id_bayar);

             LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_det_bayar',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($detail),
                'serial' => url('update')
            ]);

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data berhasil diupdate'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => 'Gagal mengupdate data',
                'error'   => $e->getMessage(),
            ], 500);

        }
    }

    private function uptotalbayar($id)
    {
        $total = DetBayar::where('id_bayar', $id)
        ->selectRaw('
            COALESCE(SUM(jml_bayar),0) as tot_bayar,
            COALESCE(SUM(kwajiban_bayar),0) - COALESCE(SUM(potongan),0) as tot_kwajiban
        ')->first();

        Bayar::where('id', $id)
            ->update([
                'tot_bayar'    => $total->tot_bayar,
                'tot_kwajiban' => $total->tot_kwajiban,
            ]);
    }

    public function destroy($id,Request $request)
    {
        try {

            $detail = DetBayar::findOrFail($id);

            $idBayar = $detail->id_bayar;

            $detail->delete();

            $this->uptotalbayar($idBayar);

              LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_det_bayar',
                'aksi' => 'delete',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($detail),
                'serial' => url('update')
            ]);

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data berhasil dihapus'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => 'Gagal menghapus data',
                'error'   => $e->getMessage()
            ], 500);

        }
    }



    public function setRegis(Request $request)
    {
        try {

            $idBayar = $request->id_bayar;
            $nipd    = $request->nipd;

            $x = 0;
            $y = 0;

            $siswa = Siswa::where('nipd', $nipd)->first();

            if (!$siswa) {
                return response()->json([
                    'success' => false,
                    'title'   => 'Error',
                    'msg'     => 'Data siswa tidak ditemukan'
                ]);
            }

            $idTemplate = $siswa->id_template_bayar;

            $items = DetTempBayar::with('itemBayar')
                ->where('id_template', $idTemplate)
                ->whereHas('itemBayar', function ($q) {
                    $q->whereIn('id_kategori', [2, 5]);
                })
                ->get();

            foreach ($items as $item) {

                $detail = DetBayar::where('id_bayar', $idBayar)
                    ->where('id_item', $item->id_item)
                    ->first();

                if ($detail) {

                    $update = $detail->update([
                        'kwajiban_bayar' => $item->jml_bayar
                    ]);

                    $update ? $x++ : $y++;

                } else {

                    $insert = DetBayar::create([
                        'id_bayar'       => $idBayar,
                        'id_item'        => $item->id_item,
                        'kwajiban_bayar' => $item->jml_bayar,
                        'jml_bayar'      => 0,
                        'potongan'       => 0,
                        'id_cicilan'     => 0,
                    ]);

                    $insert ? $x++ : $y++;
                }
            }

            $b = 0;

            if ($this->uptotalbayar($idBayar)) {
                $b++;
            }

             LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_det_bayar',
                'aksi' => 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($insert),
                'serial' => url('setRegist')
            ]);


            return response()->json([
                'success' => true,
                'title'   => 'Success',
                'msg'     => "Proses berhasil dilakukan. Berhasil : {$x}, Gagal : {$y}"
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'title'   => 'Error',
                'msg'     => $e->getMessage()
            ], 500);

        }
    }
}
