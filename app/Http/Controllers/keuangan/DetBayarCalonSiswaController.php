<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BayarCalonSiswa;
use App\Models\DetBayarCalonSiswa;
use App\Models\DetTempBayar;
use App\Models\LogModel;



class DetBayarCalonSiswaController extends Controller
{
    //
    public function store(Request $request)
    {      
        try {
            $detail = DetBayarCalonSiswa::create([
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

            $detail = DetBayarCalonSiswa::findOrFail($id);

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
        $total = DetBayarCalonSiswa::where('id_bayar', $id)
        ->selectRaw('
            COALESCE(SUM(jml_bayar),0) as tot_bayar,
            COALESCE(SUM(kwajiban_bayar),0) - COALESCE(SUM(potongan),0) as total_kwajiban
        ')->first();

        BayarCalonSiswa::where('id', $id)
            ->update([
                'tot_bayar'    => $total->tot_bayar,
                'total_kwajiban' => $total->total_kwajiban,
            ]);
    }

    public function destroy($id,Request $request)
    {
        try {

            $detail = DetBayarCalonSiswa::findOrFail($id);

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
}
