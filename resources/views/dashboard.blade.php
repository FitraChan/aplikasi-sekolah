@extends('layout.app')

@section('title', 'Dashboard PPDB 2026')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full">

  {{-- HEADER --}}
  <div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

      <div>
        <h1 class="text-2xl font-bold text-slate-800">
          Dashboard PPDB
        </h1>

        <p class="text-sm text-slate-600 mt-1">
          Tahun Ajaran {{ $thn_ajaran ?? '-' }}
        </p>
      </div>

      <div class="text-sm text-slate-500">
        Monitoring Pendaftaran Siswa Baru
      </div>

    </div>
  </div>


  {{-- =========================================================
        STATISTIC CARDS
    ========================================================== --}}

  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8" data-purpose="metrics-row">

    {{-- 1. BELUM BAYAR PENDAFTARAN --}}
    <a href="{{ route('siswa.index') }}"
      class="block bg-white rounded-2xl p-5 border border-[#E8EEF5]
               shadow-[0_2px_8px_rgba(0,0,0,0.02)]
               hover:border-[#02BC9C]/50 hover:shadow-md transition">

      <div class="flex items-center justify-between">

        {{-- ICON --}}
        <div class="w-11 h-11 rounded-xl bg-[#EEF4FF]
                        flex items-center justify-center text-[#2563EB]">

          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z">
            </path>
          </svg>

        </div>

        {{-- TREND --}}
        <div class="flex items-center gap-1 font-bold text-sm text-slate-400">
          <span>—</span>
        </div>

      </div>

      <div class="mt-4">

        <span class="text-sm font-semibold text-slate-500">
          Belum Bayar Pendaftaran
        </span>

        <div class="text-[30px] font-bold text-slate-900 tracking-tight mt-1">
          {{ $jdaftar->jumlah ?? 0 }}
        </div>

      </div>

    </a>


    {{-- 2. SUDAH BAYAR PENDAFTARAN --}}
    <a href="{{ route('siswa.index') }}"
      class="block bg-white rounded-2xl p-5 border border-[#E8EEF5]
               shadow-[0_2px_8px_rgba(0,0,0,0.02)]
               hover:border-[#02BC9C]/50 hover:shadow-md transition">

      <div class="flex items-center justify-between">

        {{-- ICON --}}
        <div class="w-11 h-11 rounded-xl bg-[#e6f9f5]
                        flex items-center justify-center text-[#02BC9C]">

          <svg class="w-5 h-5" fill="none" stroke="currentColor"
            stroke-width="2.2" viewBox="0 0 24 24">

            <path
              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
              stroke-linecap="round"
              stroke-linejoin="round">
            </path>

          </svg>

        </div>

        {{-- TREND --}}
        <div class="flex items-center gap-1 font-bold text-sm text-slate-400">
          <span>—</span>
        </div>

      </div>

      <div class="mt-4">

        <span class="text-sm font-semibold text-slate-500">
          Sudah Bayar Pendaftaran
        </span>

        <div class="text-[30px] font-bold text-slate-900 tracking-tight mt-1">
          {{ $daftar->jumlah ?? 0 }}
        </div>

      </div>

    </a>


    {{-- 3. SUDAH DAFTAR ULANG --}}
    <a href="{{ route('siswa.index') }}"
      class="block bg-white rounded-2xl p-5 border border-[#E8EEF5]
               shadow-[0_2px_8px_rgba(0,0,0,0.02)]
               hover:border-[#02BC9C]/50 hover:shadow-md transition">

      <div class="flex items-center justify-between">

        {{-- ICON --}}
        <div class="w-11 h-11 rounded-xl bg-[#F4EFFE]
                        flex items-center justify-center text-[#8B5CF6]">

          <svg class="w-5 h-5" fill="none" stroke="currentColor"
            stroke-width="2" viewBox="0 0 24 24">

            <path
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
              stroke-linecap="round"
              stroke-linejoin="round">
            </path>

          </svg>

        </div>

        {{-- TREND --}}
        <div class="flex items-center gap-1 font-bold text-sm text-slate-400">
          <span>—</span>
        </div>

      </div>

      <div class="mt-4">

        <span class="text-sm font-semibold text-slate-500">
          Sudah Daftar Ulang
        </span>

        <div class="text-[30px] font-bold text-slate-900 tracking-tight mt-1">
          {{ $jregis->jumlah ?? 0 }}
        </div>

      </div>

    </a>


    {{-- 4. TOTAL SISWA BARU --}}
    <a href="{{ route('siswa.index') }}"
      class="block bg-white rounded-2xl p-5 border border-[#E8EEF5]
               shadow-[0_2px_8px_rgba(0,0,0,0.02)]
               hover:border-[#02BC9C]/50 hover:shadow-md transition">

      <div class="flex items-center justify-between">

        {{-- ICON --}}
        <div class="w-11 h-11 rounded-xl bg-[#F0F5FA]
                        flex items-center justify-center text-[#3B82F6]">

          <svg class="w-5 h-5" fill="none" stroke="currentColor"
            stroke-width="2" viewBox="0 0 24 24">

            <rect height="14" rx="3"
              stroke-linecap="round"
              stroke-linejoin="round"
              width="18"
              x="3"
              y="5">
            </rect>

            <path
              d="M16 12h2M12 12h.01"
              stroke-linecap="round"
              stroke-linejoin="round">
            </path>

          </svg>

        </div>

        {{-- TREND --}}
        <div class="flex items-center gap-1 font-bold text-sm text-slate-400">
          <span>—</span>
        </div>

      </div>
      <div class="mt-4">

        <span class="text-sm font-semibold text-slate-500">
          Total Siswa Baru
        </span>

        <div class="text-[30px] font-bold text-slate-900 tracking-tight mt-1">
          {{ $siswa->jumlah ?? 0 }}
        </div>

      </div>

    </a>

  </section>





  {{-- =========================================================
        TARGET PENDAFTARAN
    ========================================================== --}}
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-8">

    <div class="p-5 border-b border-slate-200">

      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

        <div>
          <h2 class="text-lg font-semibold text-slate-800">
            Target Pendaftaran
          </h2>

          <p class="text-sm text-slate-500 mt-1">
            Perbandingan target dengan realisasi pendaftaran
          </p>
        </div>

        <span class="text-sm font-medium text-slate-600">
          Tahun {{ $thn_ajaran ?? '-' }}
        </span>

      </div>

    </div>


    <div class="overflow-x-auto">

      <table class="w-full text-sm">

        <thead class="bg-slate-50 border-b border-slate-200">

          <tr>

            <th class="px-5 py-3 text-left font-semibold text-slate-600">
              #
            </th>

            <th class="px-5 py-3 text-left font-semibold text-slate-600">
              Tahun
            </th>

            <th class="px-5 py-3 text-left font-semibold text-slate-600">
              Jurusan
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Target
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Belum Bayar Pendaftaran
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Sudah Bayar Pendaftaran
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Daftar Ulang
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Batal
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Jumlah Siswa
            </th>

            <th class="px-5 py-3 text-left font-semibold text-slate-600">
              Progress
            </th>

          </tr>

        </thead>


        <tbody class="divide-y divide-slate-100">

          @forelse($data as $index => $item)

          @php

          $target = (int) ($item['target'] ?? 0);

          $registrasi = (int) ($item['jml_regis'] ?? 0);

          $persentase = $target > 0
          ? ($registrasi / $target) * 100
          : 0;

          $persentase = min($persentase, 100);

          @endphp


          <tr class="hover:bg-slate-50 transition">

            <td class="px-5 py-4 text-slate-500">
              {{ $index + 1 }}
            </td>

            <td class="px-5 py-4 font-medium text-slate-700">
              {{ $item['thn_ajaran'] ?? '-' }}
            </td>

            <td class="px-5 py-4 text-slate-700">
              {{ $item['nama_jurusan'] ?? '-' }}
            </td>

            <td class="px-5 py-4 text-right font-medium">
              {{ number_format($target) }}
            </td>

            <td class="px-5 py-4 text-right">
              {{ number_format(
                         ((int) ($item['jml_daftar'] ?? 0))
                                    
                                ) }}
            </td>

            <td class="px-5 py-4 text-right font-semibold text-emerald-600">
              {{ number_format($item['jml_bayar']) }}
            </td>

            <td class="px-5 py-4 text-right text-red-500">
              {{ number_format($item['jml_regis'] ?? 0) }}
            </td>

            <td class="px-5 py-4 text-right text-red-500">
              {{ number_format($item['jml_batal'] ?? 0) }}
            </td>


            <td class="px-5 py-4 text-right text-red-500">
              {{ number_format($item['jml_siswa'] ?? 0) }}
            </td>

            <td class="px-5 py-4 min-w-[180px]">

              <div class="flex items-center gap-3">

                <div class="flex-1">

                  <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">

                    <div
                      class="h-full bg-emerald-500 rounded-full"
                      style="width: {{ $persentase }}%">
                    </div>

                  </div>

                </div>

                <span class="text-xs font-semibold text-slate-600 w-12 text-right">
                  {{ number_format($persentase, 1) }}%
                </span>

              </div>

            </td>

          </tr>

          @empty

          <tr>

            <td
              colspan="8"
              class="px-5 py-10 text-center text-slate-500">

              Belum ada data pendaftaran.

            </td>

          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

  </div>



  {{-- =========================================================
        RINGKASAN PEMBAYARAN
    ========================================================== --}}
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

    <div class="p-5 border-b border-slate-200">

      <h2 class="text-lg font-semibold text-slate-800">
        Ringkasan Pembayaran
      </h2>

      <p class="text-sm text-slate-500 mt-1">
        Rekap kewajiban dan pembayaran siswa
      </p>

    </div>


    <div class="overflow-x-auto">

      <table class="w-full text-sm">

        <thead class="bg-slate-50 border-b border-slate-200">

          <tr>

            <th class="px-5 py-3 text-left font-semibold text-slate-600">
              Tahun
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Kewajiban
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Potongan
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Sudah Bayar
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Sisa
            </th>

            <th class="px-5 py-3 text-right font-semibold text-slate-600">
              Belum Bayar
            </th>

            <th class="px-5 py-3 text-left font-semibold text-slate-600">
              Progress
            </th>

          </tr>

        </thead>


        <tbody class="divide-y divide-slate-100">

          @php

          $totalKewajiban = 0;
          $totalPotongan = 0;
          $totalBayar = 0;
          $totalSisa = 0;
          $totalBelumBayar = 0;

          @endphp


          @forelse($hasil as $item)

          @php

          $kewajiban = $item->SUMK2 ?? 0;

          $potongan = $item->SUMP ?? 0;

          $bayar = $item->SUMB ?? 0;

          $total = max($kewajiban - $potongan, 0);

          $sisa = max($total - $bayar, 0);

          $progress = $total > 0
          ? ($bayar / $total) * 100
          : 0;

          $progress = min($progress, 100);

          $totalKewajiban += $kewajiban;
          $totalPotongan += $potongan;
          $totalBayar += $bayar;
          $totalSisa += $sisa;

          $totalBelumBayar += $item->jml_belum_bayar ?? 0;

          @endphp


          <tr class="hover:bg-slate-50 transition">

            <td class="px-5 py-4 font-medium text-slate-700">
              {{ $item->thn_ajaran ?? '-' }}
            </td>

            <td class="px-5 py-4 text-right">
              Rp {{ number_format($kewajiban, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right text-amber-600">
              Rp {{ number_format($potongan, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right font-semibold text-emerald-600">
              Rp {{ number_format($bayar, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right text-red-500">
              Rp {{ number_format($sisa, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right">
              {{ number_format($item->jml_belum_bayar ?? 0) }}
            </td>

            <td class="px-5 py-4 min-w-[180px]">

              <div class="flex items-center gap-3">

                <div class="flex-1">

                  <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">

                    <div
                      class="h-full bg-blue-500 rounded-full"
                      style="width: {{ $progress }}%">
                    </div>

                  </div>

                </div>

                <span class="text-xs font-semibold text-slate-600 w-12 text-right">
                  {{ number_format($progress, 1) }}%
                </span>

              </div>

            </td>

          </tr>

          @empty

          <tr>

            <td
              colspan="7"
              class="px-5 py-10 text-center text-slate-500">

              Belum ada data pembayaran.

            </td>

          </tr>

          @endforelse

        </tbody>


        {{-- TOTAL --}}
        <tfoot class="bg-slate-50 border-t border-slate-200">

          <tr>

            <td class="px-5 py-4 font-bold text-slate-800">
              TOTAL
            </td>

            <td class="px-5 py-4 text-right font-bold">
              Rp {{ number_format($totalKewajiban, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right font-bold text-amber-600">
              Rp {{ number_format($totalPotongan, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right font-bold text-emerald-600">
              Rp {{ number_format($totalBayar, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right font-bold text-red-500">
              Rp {{ number_format($totalSisa, 0, ',', '.') }}
            </td>

            <td class="px-5 py-4 text-right font-bold">
              {{ number_format($totalBelumBayar) }}
            </td>

            <td class="px-5 py-4">
              @php

              $totalWajibBayar = max(
              $totalKewajiban - $totalPotongan,
              0
              );

              $totalProgress = $totalWajibBayar > 0
              ? ($totalBayar / $totalWajibBayar) * 100
              : 0;

              $totalProgress = min($totalProgress, 100);

              @endphp

              <div class="flex items-center gap-3">

                <div class="flex-1">

                  <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">

                    <div
                      class="h-full bg-emerald-500 rounded-full"
                      style="width: {{ $totalProgress }}%">
                    </div>

                  </div>

                </div>

                <span class="text-xs font-bold text-slate-700">
                  {{ number_format($totalProgress, 1) }}%
                </span>

              </div>

            </td>

          </tr>

        </tfoot>

      </table>

    </div>

  </div>

</main>

@endsection