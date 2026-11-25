<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    @php
    $dataBayar = $dataBayar ?? null;

    $rupiah = fn($value) =>
    'Rp ' . number_format((float) ($value ?? 0), 0, ',', '.');

    $tanggal = $dataBayar?->tgl_bayar
    ? $dataBayar->tgl_bayar->format('d M Y')
    : '-';

    $jam = $dataBayar?->jam_bayar
    ? $dataBayar->jam_bayar->format('H:i:s')
    : '-';

    $bukti = $dataBayar?->bukti_bayar
    ? asset('storage/app/public/' . ltrim($dataBayar->bukti_bayar, '/'))
    : null;
    @endphp

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="flex items-center gap-3">

            <button onclick="history.back()"
                class="p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 transition text-slate-600">
                <i class="w-5 h-5" data-lucide="arrow-left"></i>
            </button>

            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-1">
                    <span>Keuangan</span>
                    <i class="w-3.5 h-3.5" data-lucide="chevron-right"></i>
                    <span>Verifikasi Pembayaran</span>
                    <i class="w-3.5 h-3.5" data-lucide="chevron-right"></i>
                    <span class="text-teal-600 font-semibold">Detail</span>
                </div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                    Detail Verifikasi Pembayaran
                </h1>


            </div>

        </div>

        <div class="flex items-center gap-3 flex-wrap" id="status-transaksi-container">

            <span class="flex items-center gap-2 px-3 py-2 text-xs font-bold
                text-amber-700 bg-amber-100 rounded-full">

                <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                STATUS: {{ $dataBayar->statusTransaksi?->nama ?? '-' }}

            </span>



        </div>

    </div>


    <!-- GRID UTAMA -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        <!-- KOLOM KIRI -->
        <div class="lg:col-span-6 space-y-6">


            <!-- DATA SISWA -->
            <section class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

                <div class="flex items-center justify-between pb-5 border-b border-slate-100">

                    <div class="flex items-center gap-2.5">

                        <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                            <i class="w-5 h-5" data-lucide="user-round"></i>
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-slate-900">
                                Data Calon Siswa
                            </h2>

                            <p class="text-xs text-slate-400">
                                Informasi identitas Calon siswa
                            </p>
                        </div>

                    </div>

                    <span class="px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-bold">
                        No Daftar: {{ $calonSiswa->no_daftar ?? '-' }}
                    </span>

                </div>


                <div class="pt-5 grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div class="sm:col-span-2">
                        <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                            Nama Lengkap
                        </span>

                        <p class="text-base font-bold text-slate-900">
                            {{ $calonSiswa->nama_lengkap ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                            No Daftar
                        </span>

                        <p class="text-sm font-semibold text-slate-700">
                            {{ $calonSiswa->no_daftar ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                            Kelas
                        </span>

                        @php
                        $calonSiswa = $calonSiswa ?? null;
                        @endphp

                        <p class="text-sm font-semibold text-slate-700">
                            {{ data_get($calonSiswa, 'kelas.nama_kelas', '-') }}
                        </p>
                    </div>


                    <div class="sm:col-span-2">

                        <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                            Jurusan
                        </span>

                        <span class="inline-flex items-center gap-2 px-3 py-2
                            text-xs font-bold text-teal-700 bg-teal-50 rounded-lg">

                            <i class="w-4 h-4" data-lucide="graduation-cap"></i>

                            {{ data_get($calonSiswa, 'jurusan.nama_jurusan', '-') }}

                        </span>

                    </div>

                </div>

            </section>


            <!-- DETAIL TRANSAKSI -->
            <section class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

                <div class="flex items-center gap-3 pb-5 border-b border-slate-100">

                    <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <i class="w-5 h-5" data-lucide="receipt"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Informasi Transaksi
                        </h2>

                        <p class="text-xs text-slate-400">
                            Informasi pembayaran siswa
                        </p>
                    </div>

                </div>


                <div class="pt-5 grid grid-cols-2 gap-5">

                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-1">
                            No. Kwitansi
                        </span>

                        <p class="text-sm font-bold text-slate-800">
                            {{ $dataBayar->no_kwitansi ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-1">
                            Tahun Ajaran
                        </span>

                        <p class="text-sm font-semibold text-slate-800">
                            {{ $dataBayar->tahunAjaran->thn_ajaran ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-1">
                            Tanggal Pembayaran
                        </span>

                        <p class="text-sm font-semibold text-slate-800">
                            {{ $tanggal }}
                        </p>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-1">
                            Bank Pengirim
                        </span>

                        <p class="text-sm font-semibold text-slate-800">
                            {{$dataBayar->bankPengirim->nama_bank ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-1">
                            Bank Penerima
                        </span>

                        <span class="inline-flex px-3 py-1.5 rounded-lg bg-purple-50 text-purple-700 text-xs font-bold">
                            {{ $dataBayar->bankPenerima->nama_bank ?? '-' }}
                        </span>
                    </div>


                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-1">
                            Admin
                        </span>

                        <p class="text-sm font-semibold text-slate-800">
                            {{ $dataBayar->kasir->name ?? '-' }}
                        </p>
                    </div>


                    <div class="col-span-2 pt-4 border-t border-slate-100">

                        <span class="block text-[11px] font-bold text-slate-400 uppercase mb-2">
                            Keterangan
                        </span>

                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $dataBayar?->keterangan ?: 'Tidak ada keterangan pembayaran.' }}
                        </p>

                    </div>

                </div>

            </section>


        </div>



        <!-- KOLOM KANAN -->
        <div class="lg:col-span-6 space-y-6">


            <!-- BUKTI PEMBAYARAN -->
            <section class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">

                <div class="px-6 py-5 flex items-center justify-between border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <i class="w-5 h-5" data-lucide="image"></i>
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-slate-900">
                                Bukti Pembayaran
                            </h2>

                            <p class="text-xs text-slate-400">
                                Dokumen bukti transaksi
                            </p>
                        </div>

                    </div>

                    @if($bukti)
                    <button onclick="openImageModal()"
                        class="flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800">

                        <i class="w-4 h-4" data-lucide="zoom-in"></i>
                        Perbesar

                    </button>
                    @endif

                </div>


                <div class="p-6 bg-slate-50 flex items-center justify-center min-h-[250px]">

                    @if($bukti)

                    <div onclick="openImageModal()"
                        class="w-full max-w-md rounded-xl overflow-hidden shadow-md border border-slate-200 bg-white cursor-pointer group">

                        <img id="proof-image"
                            src="{{ $bukti }}"
                            alt="Bukti Pembayaran"
                            class="w-full h-auto object-contain max-h-[450px] group-hover:scale-[1.02] transition duration-300">

                    </div>

                    @else

                    <div class="text-center py-10">

                        <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                            <i class="w-8 h-8" data-lucide="image-off"></i>
                        </div>

                        <p class="text-sm font-bold text-slate-500">
                            Bukti pembayaran tidak tersedia
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Tidak ada file bukti yang dilampirkan.
                        </p>

                    </div>

                    @endif

                </div>

            </section>



            <!-- RINCIAN ITEM PEMBAYARAN -->
            <section class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">

                <div class="px-6 py-5 flex items-center justify-between border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="w-5 h-5" data-lucide="list-checks"></i>
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-slate-900">
                                Rincian Item Pembayaran
                            </h2>

                            <p class="text-xs text-slate-400">
                                Detail kewajiban dan pembayaran
                            </p>
                        </div>

                    </div>


                    <span class="px-3 py-1.5 rounded-lg bg-teal-50 text-teal-700 text-xs font-bold">
                        {{ $detBayar?->count() ?? 0 }} Item
                    </span>

                </div>



                <div class="overflow-x-auto rounded-xl">
                    @php
                    /*
                    |--------------------------------------------------------------------------
                    | DEFAULT DATA
                    |--------------------------------------------------------------------------
                    */

                    $dataBayar = $dataBayar ?? null;
                    $calonSiswa = $calonSiswa ?? null;
                    $detBayar = collect($detBayar ?? []);

                    $totBayar = 0;

                    $rupiah = fn($value) =>
                    'Rp ' . number_format((float) ($value ?? 0), 0, ',', '.');
                    @endphp

                    <table class="w-full text-sm">

                        {{-- HEADER --}}
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr class="text-[10px] uppercase tracking-wider text-slate-500">

                                <th class="px-4 py-3 text-left font-bold">
                                    Item Pembayaran
                                </th>

                                <th class="px-4 py-3 text-center font-bold">
                                    Tanggal Bayar
                                </th>

                                <th class="px-4 py-3 text-right font-bold">
                                    Kewajiban
                                </th>

                                <th class="px-4 py-3 text-right font-bold">
                                    Bayar
                                </th>

                                <th class="px-4 py-3 text-center font-bold">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        {{-- BODY --}}
                        <tbody class="divide-y divide-slate-100">

                            @forelse($detBayar as $item)

                            @php
                            $dibayar = (float) ($item->jml_bayar ?? 0);

                            $totBayar += $dibayar;

                            $namaItem = $item->itemBayar->nama_item
                            ?? 'Item tidak tersedia';

                            $tanggalBayar = $dataBayar?->tgl_bayar
                            ? $dataBayar->tgl_bayar->format('d M Y')
                            : '-';
                            @endphp

                            <tr class="hover:bg-teal-50/50 transition-colors">

                                {{-- ITEM PEMBAYARAN --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">

                                            <i data-lucide="receipt" class="w-4 h-4"></i>

                                        </div>

                                        <div>

                                            <p class="font-bold text-slate-800 text-sm">
                                                {{ $namaItem }}
                                            </p>

                                            <p class="text-xs text-slate-400 mt-0.5">
                                                Rincian pembayaran
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- TANGGAL BAYAR --}}
                                <td class="px-4 py-4 text-center whitespace-nowrap">

                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500">

                                        <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>

                                        {{ $tanggalBayar ? \Carbon\Carbon::parse($tanggalBayar)->format('d-m-Y') : '-' }}

                                    </span>

                                </td>


                                {{-- KEWAJIBAN --}}
                                <td class="px-4 py-4 text-right whitespace-nowrap">

                                    <span class="font-semibold text-slate-600">
                                        {{ $rupiah($item->jml_kewajiban ?? 0) }}
                                    </span>

                                </td>


                                {{-- NOMINAL BAYAR --}}
                                <td class="px-4 py-4 text-right whitespace-nowrap">

                                    <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-extrabold">

                                        {{ $rupiah($dibayar) }}

                                    </span>

                                </td>


                                {{-- AKSI --}}
                                <td class="px-4 py-4 text-center">

                                    <button
                                        type="button"
                                        onclick="editDetailBayar(this)"
                                        data-id="{{ $item->id }}"
                                        data-nama="{{ $namaItem }}"
                                        data-tanggal="{{ $tanggalBayar }}"
                                        data-nominal="{{ $dibayar }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-2
                               rounded-lg bg-blue-50 text-blue-600
                               hover:bg-blue-100 font-bold text-xs transition">

                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>

                                        Edit

                                    </button>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center py-12 text-slate-400">

                                    <i data-lucide="inbox" class="w-10 h-10 mx-auto mb-3 opacity-40"></i>

                                    <p class="text-sm font-semibold">
                                        Belum ada rincian pembayaran.
                                    </p>

                                    <p class="text-xs mt-1">
                                        Data pembayaran belum tersedia.
                                    </p>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>


                        {{-- FOOTER TOTAL --}}
                        @if($detBayar->isNotEmpty())

                        <tfoot class="bg-slate-50 border-t border-slate-200">

                            <tr>

                                <td colspan="4" class="px-4 py-4 text-right font-bold text-slate-600">
                                    Total Pembayaran
                                </td>

                                <td class="px-4 py-4 text-center whitespace-nowrap">

                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-700 font-black text-sm">

                                        {{ $rupiah($totBayar) }}

                                    </span>

                                </td>

                            </tr>

                        </tfoot>

                        @endif

                    </table>


                    {{-- =========================================================
     MODAL EDIT PEMBAYARAN
========================================================== --}}

                    <div
                        id="modalEditBayar"
                        class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">

                        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">


                            {{-- HEADER --}}
                            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">

                                <div>

                                    <h3 class="text-lg font-black text-slate-800">
                                        Edit Pembayaran
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Ubah rincian nominal pembayaran.
                                    </p>

                                </div>

                                <button
                                    type="button"
                                    onclick="tutupModalBayar()"
                                    class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">

                                    <i data-lucide="x" class="w-5 h-5"></i>

                                </button>

                            </div>


                            {{-- FORM --}}
                            <form
                                id="formEditBayar">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id_detail_bayar" id="edit_id_detail">

                                <input
                                    type="hidden"
                                    name="id_bayar"
                                    id="edit_id_bayar"
                                    value="{{ $dataBayar?->id ?? '' }}">

                                <div class="p-6 space-y-5">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-2">
                                            ITEM PEMBAYARAN
                                        </label>

                                        <input
                                            type="text"
                                            id="edit_nama"
                                            readonly
                                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-600 font-bold text-sm">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-2">
                                            NOMINAL PEMBAYARAN
                                        </label>

                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">
                                                Rp
                                            </span>

                                            <input
                                                type="number"
                                                name="jml_bayar"
                                                id="edit_nominal"
                                                min="0"
                                                step="1"
                                                required
                                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-100 outline-none font-bold text-slate-800">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3 px-6 py-5 bg-slate-50 border-t border-slate-100">
                                    <button
                                        type="button"
                                        onclick="tutupModalBayar()"
                                        class="flex-1 py-3 rounded-xl border border-slate-200 bg-white text-slate-600 font-bold text-sm hover:bg-slate-100">
                                        Batal
                                    </button>

                                    <button
                                        type="button"
                                        id="btnSimpanEditBayar"
                                          onclick="simpanEditBayar()"
                                        class="flex-1 py-3 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm shadow-sm flex items-center justify-center gap-2">

                                        <i data-lucide="save" class="w-4 h-4"></i>
                                        <span>Simpan Perubahan</span>
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>


            </section>



            <!-- AKSI VERIFIKASI -->
            <section
                id="verification-section"
                class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

                <div class="flex items-center gap-3 mb-5">

                    <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i class="w-5 h-5" data-lucide="shield-check"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Aksi Verifikasi
                        </h2>

                        <p class="text-xs text-slate-400">
                            Tentukan hasil pemeriksaan pembayaran
                        </p>
                    </div>

                </div>

                <div id="verification-action-container">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        @if (($dataBayar?->sts_trans ?? null) == 1)

                        <form
                            action="{{ route('updateStatusTransaksiCalonSiswa', $dataBayar->id) }}"
                            method="GET"
                            class="form-verifikasi">

                            <button
                                type="button"
                                id="btnSetujuiPembayaran"
                                onclick="setujuiPembayaran('{{ route('updateStatusTransaksiCalonSiswa', $dataBayar->id) }}','{{$dataBayar->id}}')"
                                class="flex items-center justify-center gap-2 py-3 px-4
                                bg-emerald-500 hover:bg-emerald-600
                                text-white font-bold text-sm rounded-xl shadow-sm transition">

                                <i class="w-4 h-4" data-lucide="check-circle-2"></i>
                                Setujui Pembayaran

                            </button>

                        </form>

                        @endif

                    </div>

                </div>

            </section>

        </div>

    </div>

</main>
<script>
    function editDetailBayar(button) {

        const id = button.dataset.id;

        document.getElementById('edit_id_detail').value = id;

        document.getElementById('edit_nominal').value = button.dataset.nominal;



        const modal = document.getElementById('modalEditBayar');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    function tutupModalBayar() {
        const modal = document.getElementById('modalEditBayar');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


</script>