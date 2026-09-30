
<!-- =========================================================
     BUKTI PENDAFTARAN
========================================================= -->

<form action="{{ route('calon-siswa.update-status', $rows->id ?? 0) }}"
      method="POST">

    @csrf

    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        <!-- HEADER -->

        <div class="px-5 sm:px-6 py-5
                    border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl
                            bg-[#00B686]/10
                            text-[#00B686]
                            flex items-center justify-center">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 3h9l3 3v15H6z"/>

                        <path stroke-linecap="round"
                              d="M9 13h6M9 17h4"/>

                        <path stroke-linecap="round"
                              d="M9 9h3"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Bukti Pendaftaran
                    </h2>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Periksa bukti pembayaran dan status calon siswa
                    </p>

                </div>

            </div>

        </div>


        <!-- BODY -->

        <div class="p-5 sm:p-6">

            <div class="space-y-6">


                <!-- =================================================
                     BUKTI TRANSFER
                ================================================== -->

                <div>

                    <div class="flex items-center justify-between mb-3">

                        <div>

                            <h3 class="text-sm font-semibold text-slate-800">
                                Bukti Transfer
                            </h3>

                            <p class="text-xs text-slate-500 mt-0.5">
                                Bukti pembayaran yang diunggah calon siswa
                            </p>

                        </div>

                    </div>


                    @forelse($bukti as $calon)

                        @if($calon->buktiPembayaran->count())

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                                @foreach($calon->buktiPembayaran as $row)

                                    <div class="rounded-xl
                                                border border-slate-200
                                                bg-slate-50
                                                p-3
                                                hover:border-[#00B686]/40
                                                transition-colors">

                                        <a href="{{ asset('storage/app/public/'.$row->bukti_transfer) }}"
                                           target="_blank"
                                           class="block group">

                                            <div class="overflow-hidden
                                                        rounded-lg
                                                        bg-white
                                                        border border-slate-200">

                                                <img
                                                    src="{{ asset('storage/app/public/'.$row->bukti_transfer) }}"
                                                    class="w-full h-64
                                                           object-contain
                                                           group-hover:scale-[1.02]
                                                           transition-transform
                                                           duration-200"
                                                    alt="Bukti Transfer"
                                                >

                                            </div>

                                        </a>

                                        <div class="flex items-center gap-2 mt-3">

                                            <div class="w-8 h-8 rounded-lg
                                                        bg-[#00B686]/10
                                                        text-[#00B686]
                                                        flex items-center justify-center">

                                                <svg class="w-4 h-4"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="2"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                                </svg>

                                            </div>

                                            <p class="text-xs text-slate-500">
                                                Klik gambar untuk memperbesar
                                            </p>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="flex items-center gap-3
                                        rounded-xl
                                        border border-amber-200
                                        bg-amber-50
                                        px-4 py-4">

                                <div class="w-9 h-9 rounded-lg
                                            bg-amber-100
                                            text-amber-600
                                            flex items-center justify-center">

                                    <svg class="w-5 h-5"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M12 9v4"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M12 17h.01"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-amber-800">
                                        Belum ada bukti pembayaran
                                    </p>

                                    <p class="text-xs text-amber-700 mt-0.5">
                                        Calon siswa belum mengunggah bukti transfer.
                                    </p>

                                </div>

                            </div>

                        @endif

                    @empty

                        <div class="flex items-center gap-3
                                    rounded-xl
                                    border border-amber-200
                                    bg-amber-50
                                    px-4 py-4">

                            <div class="w-9 h-9 rounded-lg
                                        bg-amber-100
                                        text-amber-600
                                        flex items-center justify-center">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 9v4"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 17h.01"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>

                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-amber-800">
                                    Belum ada bukti pembayaran
                                </p>

                                <p class="text-xs text-amber-700 mt-0.5">
                                    Belum ditemukan bukti transfer.
                                </p>

                            </div>

                        </div>

                    @endforelse

                </div>


                <!-- =================================================
                     STATUS SISWA
                ================================================== -->

                <div class="pt-5 border-t border-slate-100">

                    <label
                        for="status_daftar"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Status Siswa
                    </label>

                    <select
                        id="status_daftar"
                        name="status_daftar"
                        class="w-full
                               rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm text-slate-700
                               outline-none
                               focus:border-[#00B686]
                               focus:ring-2
                               focus:ring-[#00B686]/10
                               transition"
                    >

                        @foreach($sts_daftar as $baris)

                            <option
                                value="{{ $baris['id'] }}"
                                {{ ($rows->status_daftar == $baris['id']) ? 'selected' : '' }}
                            >

                                {{ $baris['keterangan'] }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- =================================================
                     BUTTON SIMPAN
                ================================================== -->

                <div class="flex justify-end
                            pt-5
                            border-t border-slate-100">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2
                               px-6 py-3
                               rounded-xl
                               bg-[#02BC9C]
                               hover:bg-[#02a387]
                               text-white
                               text-sm font-semibold
                               shadow-sm
                               hover:shadow-md
                               transition-all duration-200"
                    >

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5 12l4 4L19 6"/>

                        </svg>

                        Simpan Status

                    </button>

                </div>

            </div>

        </div>

    </div>

</form>


<!-- =========================================================
     BUKTI PEMBAYARAN IPAYMU
========================================================= -->

<div class="mt-6">

    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">


        <!-- HEADER -->

        <div class="px-5 sm:px-6 py-5
                    border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl
                            bg-indigo-50
                            text-indigo-600
                            flex items-center justify-center">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">

                        <rect x="3"
                              y="5"
                              width="18"
                              height="14"
                              rx="2"/>

                        <path stroke-linecap="round"
                              d="M3 10h18"/>

                        <path stroke-linecap="round"
                              d="M7 15h3"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Bukti Pembayaran iPaymu
                    </h2>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Informasi transaksi pembayaran calon siswa
                    </p>

                </div>

            </div>

        </div>


        <!-- BODY -->

        <div class="p-5 sm:p-6">

            @if($dataIpaymu)

                @php

                    $totalBayar =
                        $dataIpaymu->detailBayar->sum('jml_bayar');

                    $status = [
                        1 => ['Lunas', 'emerald'],
                        2 => ['Pending', 'amber'],
                        3 => ['Gagal', 'red'],
                    ];

                    $via = [
                        1 => 'Cash',
                        2 => 'Transfer',
                        3 => 'QRIS',
                        4 => 'iPaymu',
                    ];

                    $badge =
                        $status[$dataIpaymu->sts_bayar]
                        ?? ['Tidak Diketahui', 'slate'];

                @endphp


                <!-- =============================================
                     SUMMARY
                ============================================== -->

                <div class="grid grid-cols-1 sm:grid-cols-2
                            lg:grid-cols-3 gap-4">


                    <!-- NO KWITANSI -->

                    <div class="rounded-xl
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs font-medium
                                  text-slate-500 mb-1">

                            No. Kwitansi

                        </p>

                        <p class="text-sm font-semibold text-slate-800">

                            {{ $dataIpaymu->no_kwitansi ?? '-' }}

                        </p>

                    </div>


                    <!-- TANGGAL -->

                    <div class="rounded-xl
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs font-medium
                                  text-slate-500 mb-1">

                            Tanggal Bayar

                        </p>

                        <p class="text-sm font-semibold text-slate-800">

                            {{ optional($dataIpaymu->tgl_bayar)->format('d-m-Y H:i') ?? $dataIpaymu->tgl_bayar }}

                        </p>

                    </div>


                    <!-- NAMA SISWA -->

                    <div class="rounded-xl
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs font-medium
                                  text-slate-500 mb-1">

                            Nama Siswa

                        </p>

                        <p class="text-sm font-semibold text-slate-800">

                            {{ $dataIpaymu->calonSiswa?->nama_lengkap ?? '-' }}

                        </p>

                    </div>


                    <!-- TOTAL -->

                    <div class="rounded-xl
                                border border-[#00B686]/20
                                bg-[#00B686]/5
                                p-4">

                        <p class="text-xs font-medium
                                  text-[#008f70] mb-1">

                            Total Bayar

                        </p>

                        <p class="text-lg font-bold
                                  text-[#008f70]">

                            Rp {{ number_format($totalBayar, 0, ',', '.') }}

                        </p>

                    </div>


                    <!-- VIA PEMBAYARAN -->

                    <div class="rounded-xl
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs font-medium
                                  text-slate-500 mb-1">

                            Via Pembayaran

                        </p>

                        <p class="text-sm font-semibold text-slate-800">

                            {{ $via[$dataIpaymu->via] ?? '-' }}

                        </p>

                    </div>


                    <!-- STATUS -->

                    <div class="rounded-xl
                                border border-slate-200
                                bg-slate-50
                                p-4">

                        <p class="text-xs font-medium
                                  text-slate-500 mb-2">

                            Status Pembayaran

                        </p>

                        @if($badge[1] === 'emerald')

                            <span class="inline-flex items-center gap-1.5
                                         px-3 py-1.5
                                         rounded-full
                                         bg-emerald-50
                                         text-emerald-700
                                         text-xs font-semibold">

                                <span class="w-1.5 h-1.5
                                             rounded-full
                                             bg-emerald-500"></span>

                                {{ $badge[0] }}

                            </span>

                        @elseif($badge[1] === 'amber')

                            <span class="inline-flex items-center gap-1.5
                                         px-3 py-1.5
                                         rounded-full
                                         bg-amber-50
                                         text-amber-700
                                         text-xs font-semibold">

                                <span class="w-1.5 h-1.5
                                             rounded-full
                                             bg-amber-500"></span>

                                {{ $badge[0] }}

                            </span>

                        @elseif($badge[1] === 'red')

                            <span class="inline-flex items-center gap-1.5
                                         px-3 py-1.5
                                         rounded-full
                                         bg-red-50
                                         text-red-700
                                         text-xs font-semibold">

                                <span class="w-1.5 h-1.5
                                             rounded-full
                                             bg-red-500"></span>

                                {{ $badge[0] }}

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5
                                         px-3 py-1.5
                                         rounded-full
                                         bg-slate-100
                                         text-slate-600
                                         text-xs font-semibold">

                                <span class="w-1.5 h-1.5
                                             rounded-full
                                             bg-slate-400"></span>

                                {{ $badge[0] }}

                            </span>

                        @endif

                    </div>

                </div>


                <!-- =============================================
                     KETERANGAN
                ============================================== -->

                @if(!empty($dataIpaymu->keterangan))

                    <div class="mt-5
                                rounded-xl
                                border border-blue-200
                                bg-blue-50
                                p-4">

                        <div class="flex gap-3">

                            <div class="w-8 h-8 shrink-0
                                        rounded-lg
                                        bg-blue-100
                                        text-blue-600
                                        flex items-center justify-center">

                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     viewBox="0 0 24 24">

                                    <circle cx="12"
                                            cy="12"
                                            r="9"/>

                                    <path stroke-linecap="round"
                                          d="M12 11v5"/>

                                    <path stroke-linecap="round"
                                          d="M12 8h.01"/>

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-semibold
                                          text-blue-700 mb-1">

                                    Keterangan

                                </p>

                                <p class="text-sm text-blue-800">

                                    {{ $dataIpaymu->keterangan }}

                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                <!-- =============================================
                     DETAIL PEMBAYARAN
                ============================================== -->

                <div class="mt-6">

                    <div class="flex items-center gap-2 mb-4">

                        <div class="w-8 h-8 rounded-lg
                                    bg-slate-100
                                    text-slate-600
                                    flex items-center justify-center">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M8 6h13M8 12h13M8 18h13"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3 6h.01M3 12h.01M3 18h.01"/>

                            </svg>

                        </div>

                        <h3 class="text-sm font-bold text-slate-800">

                            Detail Pembayaran

                        </h3>

                    </div>


                    <div class="overflow-x-auto
                                rounded-xl
                                border border-slate-200">

                        <table class="w-full min-w-[700px]
                                      text-sm">

                            <thead>

                                <tr class="bg-slate-50
                                           border-b border-slate-200">

                                    <th class="px-4 py-3
                                               text-left
                                               text-xs font-semibold
                                               text-slate-600">

                                        Item Pembayaran

                                    </th>

                                    <th class="px-4 py-3
                                               text-right
                                               text-xs font-semibold
                                               text-slate-600">

                                        Kewajiban

                                    </th>

                                    <th class="px-4 py-3
                                               text-right
                                               text-xs font-semibold
                                               text-slate-600">

                                        Potongan

                                    </th>

                                    <th class="px-4 py-3
                                               text-right
                                               text-xs font-semibold
                                               text-slate-600">

                                        Dibayar

                                    </th>

                                    <th class="px-4 py-3
                                               text-right
                                               text-xs font-semibold
                                               text-slate-600">

                                        Sisa

                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @forelse($dataIpaymu->detailBayar as $detail)

                                    <tr class="hover:bg-slate-50
                                               transition-colors">

                                        <td class="px-4 py-3
                                                   font-medium
                                                   text-slate-700">

                                            {{ $detail->nama_item }}

                                        </td>

                                        <td class="px-4 py-3
                                                   text-right
                                                   text-slate-600">

                                            Rp {{ number_format($detail->kwajiban_bayar,0,',','.') }}

                                        </td>

                                        <td class="px-4 py-3
                                                   text-right
                                                   text-slate-600">

                                            Rp {{ number_format($detail->potongan,0,',','.') }}

                                        </td>

                                        <td class="px-4 py-3
                                                   text-right
                                                   font-semibold
                                                   text-[#008f70]">

                                            Rp {{ number_format($detail->jml_bayar,0,',','.') }}

                                        </td>

                                        <td class="px-4 py-3
                                                   text-right
                                                   text-slate-600">

                                            Rp {{ number_format($detail->sisa_bayar,0,',','.') }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="px-4 py-8
                                                   text-center
                                                   text-sm
                                                   text-slate-500"
                                        >

                                            <div class="flex flex-col
                                                        items-center
                                                        justify-center">

                                                <svg class="w-8 h-8
                                                            text-slate-300
                                                            mb-2"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="1.5"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M9 5h6M9 9h6M9 13h4"/>

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M6 3h9l3 3v15H6z"/>

                                                </svg>

                                                Tidak ada detail pembayaran.

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


            @else


                <!-- =============================================
                     BELUM ADA TRANSAKSI
                ============================================== -->

                <div class="flex items-center gap-4
                            rounded-xl
                            border border-amber-200
                            bg-amber-50
                            p-5">

                    <div class="w-11 h-11 shrink-0
                                rounded-xl
                                bg-amber-100
                                text-amber-600
                                flex items-center justify-center">

                        <svg class="w-6 h-6"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 9v4"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 17h.01"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>

                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-semibold
                                  text-amber-800">

                            Belum ada transaksi iPaymu

                        </p>

                        <p class="text-xs text-amber-700 mt-1">

                            Belum ditemukan data pembayaran melalui iPaymu.

                        </p>

                    </div>

                </div>


            @endif

        </div>

    </div>

</div>

