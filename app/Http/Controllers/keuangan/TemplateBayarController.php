<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\TemplateBayar;
use App\Models\TahunAjaran;
use App\Models\ItemBayar;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;
use App\Models\DetTempBayar;
use App\Models\Gelombang;
use App\Models\Siswa;
use App\Models\LogModel;







use Illuminate\Http\Request;

class TemplateBayarController extends Controller
{

    public function index()
    {
        $side = 'template-bayar';
        $tahun = TahunAjaran::orderBy('id', 'desc')->get();
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        $gelombang = Gelombang::orderBy('idx')->get();
        $itemBayar = ItemBayar::orderBy('id', 'desc')->get();


        return view(
            'keuangan.template_bayar.index',
            compact(
                'side',
                'tahun',
                'jurusan',
                'gelombang',
                'itemBayar'
            )
        );
    }
    public function data(Request $request)
{
    $query = TemplateBayar::query()
        ->with([
            'tahunAjaran',
            'gelombang',
            'jurusan',
        ]);

    if ($request->filled('id_thn_ajaran')) {
        $query->where(
            'id_tahun',
            $request->id_thn_ajaran
        );
    }

    if ($request->filled('id_gelombang')) {
        $query->where(
            'id_gelombang',
            $request->id_gelombang
        );
    }

    if ($request->filled('id_jurusan')) {
        $query->where(
            'id_jurusan',
            $request->id_jurusan
        );
    }

    $data = $query
        ->latest()
        ->get();

    return response()->json($data);
}

    public function detail($idTemplate)
    {
        return DetTempBayar::with([
            'itemBayar.kategori:id,nama_kategori',
            'itemBayar.periode:id,nama_periode'
        ])
            ->where('id_template', $idTemplate)
            ->get()
            ->map(function ($row) {
                return [
                    'id'             => $row->id,
                    'id_item'        => $row->id_item,
                    'nama_item'      => $row->itemBayar->nama_item ?? '',
                    'kategori'       => $row->itemBayar->kategori->nama_kategori ?? '',
                    'periode'        => $row->item->periode->nama_periode ?? '',
                    'jml_bayar'      => $row->jml_bayar,
                    'ket_bayar'      => $row->ket_bayar,
                ];
            });
    }


    public function setDefault($id = null)
    {
        DB::transaction(function () use ($id) {
            DetTempBayar::where('id_template', $id)->delete();
            $items = ItemBayar::all();
            $data = [];
            foreach ($items as $item) {
                $data[] = [
                    'id_template' => $id,
                    'id_item'     => $item->id,
                    'jml_bayar'   => $item->def_value,
                    'ket_bayar'   => $item->keterangan,
                ];
            }

            if (!empty($data)) {
                DetTempBayar::insert($data);
            }


            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_det_temp_bayar',
                'aksi' => 'set default',
                'user' => auth()->user()->id,
                'ip' => request()->ip(),
                'keterangan' => json_encode($data),
                'serial' => url('set-default/' . $id)
            ]);
        });



        return response()->json([
            'success' => true,
            'title'   => 'Sukses',
            'msg'     => 'Data telah tersimpan'
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_tahun' => [
                'required',
                'exists:tb_thn_ajaran,id',
            ],

            'tipe_jurusan' => [
                'required',
                'in:semua,perjurusan',
            ],

            'id_jurusan' => [
                'nullable',
                'required_if:tipe_jurusan,perjurusan',
                'exists:tb_jurusan,id',
            ],

            'id_gelombang' => [
                'required',
            ],

            'jns_kelas' => [
                'required',
                'in:1,2',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sts' => [
                'nullable',
                'boolean',
            ],
        ]);

        try {
            $jumlahTemplate = DB::transaction(function () use (
                $request,
                $validated
            ) {
                /*
             * Jika memilih semua jurusan,
             * ambil seluruh ID jurusan.
             */
                if ($validated['tipe_jurusan'] === 'semua') {
                    $jurusanIds = Jurusan::query()
                        ->pluck('id');
                } else {
                    $jurusanIds = collect([
                        $validated['id_jurusan'],
                    ]);
                }

                if ($jurusanIds->isEmpty()) {
                    throw new \Exception(
                        'Data jurusan belum tersedia.'
                    );
                }

                /*
             * Item pembayaran cukup diambil sekali,
             * tidak perlu query ulang setiap looping jurusan.
             */
                $items = ItemBayar::query()
                    ->select([
                        'id',
                        'def_value',
                        'keterangan',
                    ])
                    ->get();

                $templateIds = [];

                foreach ($jurusanIds as $idJurusan) {

                    /*
                 * Opsional: cegah template ganda.
                 */
                    $templateSudahAda = TemplateBayar::query()
                        ->where('id_tahun', $validated['id_tahun'])
                        ->where('id_jurusan', $idJurusan)
                        ->where(
                            'id_gelombang',
                            $validated['id_gelombang']
                        )
                        ->where('jns_kelas', $validated['jns_kelas'])
                        ->exists();

                    if ($templateSudahAda) {
                        continue;
                    }

                    $template = TemplateBayar::create([
                        'id_tahun' => $validated['id_tahun'],

                        'id_jurusan' => $idJurusan,

                        'keterangan' => $validated['keterangan']
                            ?? null,

                        'jns_kelas' => $validated['jns_kelas'],

                        'id_gelombang' =>
                        $validated['id_gelombang'],

                        'sts' => $validated['sts'] ?? 1,
                    ]);

                    $templateIds[] = $template->id;

                    /*
                 * Otomatis set default detail pembayaran.
                 */
                    $this->insertDefaultItems(
                        $template->id,
                        $items
                    );

                    /*
                 * Set template ke siswa berdasarkan:
                 * tahun ajaran dan jurusan.
                 */
                    Siswa::query()
                        ->where(
                            'id_thn_ajaran',
                            $template->id_tahun
                        )
                        ->where(
                            'id_jurusan',
                            $template->id_jurusan
                        )
                        ->whereNull('id_template_bayar')
                        ->update([
                            'id_template_bayar' => $template->id,
                        ]);

                    LogModel::create([
                        'tanggal' => now(),
                        'tabel' => 'tb_template_bayar',
                        'aksi' => 'create',
                        'user' => auth()->id(),
                        'ip' => $request->ip(),
                        'keterangan' => json_encode(
                            $template->toArray()
                        ),
                        'serial' => url(
                            'template-bayar/' . $template->id
                        ),
                    ]);
                }

                return count($templateIds);
            });

            if ($jumlahTemplate === 0) {
                return response()->json([
                    'success' => false,
                    'message' =>
                    'Template tidak dibuat karena seluruh kombinasi template sudah tersedia.',
                ], 422);
            }

            return response()->json([
                'success' => true,
                'message' =>
                $jumlahTemplate . ' template pembayaran berhasil dibuat beserta detail default.',
                'jumlah_template' => $jumlahTemplate,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function insertDefaultItems(
        int $templateId,
        $items
    ): void {
        DetTempBayar::query()
            ->where('id_template', $templateId)
            ->delete();

        $data = $items
            ->map(function ($item) use ($templateId) {
                return [
                    'id_template' => $templateId,
                    'id_item'     => $item->id,
                    'jml_bayar'   => $item->def_value ?? 0,
                    'ket_bayar'   => $item->keterangan,
                ];
            })
            ->values()
            ->all();

        if (!empty($data)) {
            DetTempBayar::insert($data);
        }

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_det_temp_bayar',
            'aksi' => 'set default',
            'user' => auth()->id(),
            'ip' => request()->ip(),
            'keterangan' => json_encode($data),
            'serial' => url(
                'template-bayar/set-default/' . $templateId
            ),
        ]);
    }

    public function update(Request $request, $id)
    {
        $row = TemplateBayar::findOrFail($id);

        $row->update([

            'id_tahun'      => $request->id_tahun,

            'id_jurusan'    => $request->id_jurusan,

            'keterangan'    => $request->keterangan,

            'jns_kelas'     => $request->jns_kelas,

            'id_gelombang'  => $request->id_gelombang,

            'sts'           => $request->sts,
        ]);

        Siswa::where('id_thn_ajaran', $row->id_tahun)
            ->whereNull('id_template_bayar')
            ->update([
                'id_template_bayar' => $row->id
            ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_template_bayar',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($row),
            'serial' => url('ubah/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }


    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $template = TemplateBayar::findOrFail($id);

            $templateData = $template->toArray();

            DetTempBayar::where('id_template', $template->id)
                ->delete();

            $template->delete();

            LogModel::create([
                'tanggal'   => now(),
                'tabel'     => 'tb_template_bayar',
                'aksi'      => 'delete',
                'user'      => auth()->id(),
                'ip'        => request()->ip(),
                'keterangan'=> json_encode($templateData),
                'serial'    => url('hapus/' . $id),
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Template dan detail pembayaran berhasil dihapus.',
        ]);
    }

    public function deleteDetail($id)
    {
        $detail = DetTempBayar::findOrFail($id);
        $detail->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_det_temp_bayar',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($detail),
            'serial' => url('hapus-detail/' . $id)
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Data berhasil dihapus'
        ]);
    }


    public function storeDetail(Request $request)
    {
        $detail = DetTempBayar::create([
            'id_template' => $request->id_template,
            'id_item'     => $request->id_item,
            'jml_bayar'   => $request->jml_bayar,
            'ket_bayar'   => $request->ket_bayar,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_det_temp_bayar',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($detail),
            'serial' => url('simpan-detail')
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Data berhasil disimpan'
        ]);
    }

    public function updateDetail(Request $request, $id)
    {
        $row = DetTempBayar::findOrFail($id);

        $row->update([
            'id_item'   => $request->id_item,
            'jml_bayar' => $request->jml_bayar,
            'ket_bayar' => $request->ket_bayar,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_det_temp_bayar',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($row),
            'serial' => url('ubah-detail/' . $id)
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Data berhasil diupdate'
        ]);
    }
}
