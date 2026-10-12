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

<section class="mb-8">
      <div id="gelombang-container"
      class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

      <!-- LOADING -->

      <div class="col-span-full
                        flex items-center justify-center
                        py-12
                        text-sm
                        text-slate-400">

        Memuat data gelombang...

      </div>

    </div>

  </section>





  {{-- =========================================================
        TARGET PENDAFTARAN
    ========================================================== --}}
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

    {{-- HEADER TABEL --}}
    <div class="flex flex-col gap-3 border-b border-slate-200 bg-white px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h3 class="text-base font-bold text-slate-800">
                Rekapitulasi Pendaftaran Siswa
            </h3>

            <p class="mt-1 text-xs text-slate-500">
                Statistik target, pembayaran, dan jumlah siswa per jurusan.
            </p>
        </div>

        <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
            Data Pendaftaran
        </div>

    </div>


    {{-- TABEL RESPONSIVE --}}
    <div class="w-full overflow-x-auto">

        <table class="w-full min-w-[1250px] border-collapse text-sm">

            <thead>
                <tr class="border-b border-slate-200 bg-slate-50">

                    <th class="whitespace-nowrap px-5 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                        #
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        Tahun Ajaran
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        Jurusan
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                        Target
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-amber-600">
                        Belum Bayar
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-emerald-600">
                        Sudah Bayar
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-blue-600">
                        Daftar Ulang
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-red-500">
                        Batal
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                        Jumlah Siswa
                    </th>

                    <th class="whitespace-nowrap px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        Progress Target
                    </th>

                </tr>
            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse($data as $index => $item)

                    @php
                        $target = (int) ($item['target'] ?? 0);

                        $belumBayar = (int) ($item['jml_daftar'] ?? 0);
                        $sudahBayar = (int) ($item['jml_bayar'] ?? 0);
                        $daftarUlang = (int) ($item['jml_regis'] ?? 0);
                        $batal = (int) ($item['jml_batal'] ?? 0);
                        $jumlahSiswa = (int) ($item['jml_siswa'] ?? 0);

                        $registrasi = $belumBayar
                            + $sudahBayar
                            + $daftarUlang
                            + $jumlahSiswa;

                        $persentase = $target > 0
                            ? ($registrasi / $target) * 100
                            : 0;

                        $persentaseTampil = min($persentase, 100);

                        $warnaProgress = $persentase >= 100
                            ? 'bg-emerald-500'
                            : ($persentase >= 70
                                ? 'bg-[#02BC9C]'
                                : ($persentase >= 40
                                    ? 'bg-amber-400'
                                    : 'bg-blue-500'));
                    @endphp


                    <tr class="group transition-colors duration-150 hover:bg-emerald-50/40">

                        {{-- NOMOR --}}
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-xs font-semibold text-slate-500 transition group-hover:bg-emerald-100 group-hover:text-emerald-700">
                                {{ $index + 1 }}
                            </span>
                        </td>


                        {{-- TAHUN --}}
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="font-semibold text-slate-700">
                                {{ $item['thn_ajaran'] ?? '-' }}
                            </span>
                        </td>


                        {{-- JURUSAN --}}
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.7">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 14l9-5-9-5-9 5 9 5z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12v5c4.5 3.5 9.5 3.5 14 0v-5" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 9v6" />

                                    </svg>
                                </div>

                                <span class="font-semibold text-slate-700">
                                    {{ $item['nama_jurusan'] ?? '-' }}
                                </span>

                            </div>
                        </td>


                        {{-- TARGET --}}
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <span class="font-bold text-slate-700">
                                {{ number_format($target, 0, ',', '.') }}
                            </span>
                        </td>


                        {{-- BELUM BAYAR --}}
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <span class="inline-flex min-w-12 items-center justify-center rounded-lg bg-amber-50 px-2.5 py-1.5 font-semibold text-amber-700">
                                {{ number_format($belumBayar, 0, ',', '.') }}
                            </span>
                        </td>


                        {{-- SUDAH BAYAR --}}
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <span class="inline-flex min-w-12 items-center justify-center rounded-lg bg-emerald-50 px-2.5 py-1.5 font-semibold text-emerald-700">
                                {{ number_format($sudahBayar, 0, ',', '.') }}
                            </span>
                        </td>


                        {{-- DAFTAR ULANG --}}
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <span class="inline-flex min-w-12 items-center justify-center rounded-lg bg-blue-50 px-2.5 py-1.5 font-semibold text-blue-700">
                                {{ number_format($daftarUlang, 0, ',', '.') }}
                            </span>
                        </td>


                        {{-- BATAL --}}
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <span class="inline-flex min-w-12 items-center justify-center rounded-lg bg-red-50 px-2.5 py-1.5 font-semibold text-red-600">
                                {{ number_format($batal, 0, ',', '.') }}
                            </span>
                        </td>


                        {{-- JUMLAH SISWA --}}
                        <td class="whitespace-nowrap px-5 py-4 text-right">
                            <span class="font-bold text-slate-800">
                                {{ number_format($jumlahSiswa, 0, ',', '.') }}
                            </span>

                            <span class="ml-1 text-xs text-slate-400">
                                siswa
                            </span>
                        </td>


                        {{-- PROGRESS --}}
                        <td class="min-w-[200px] px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-slate-100">

                                    <div
                                        class="{{ $warnaProgress }} h-full rounded-full transition-all duration-500"
                                        style="width: {{ $persentaseTampil }}%">
                                    </div>

                                </div>

                                <span class="w-14 text-right text-xs font-bold
                                    {{ $persentase >= 100 ? 'text-emerald-600' : 'text-slate-600' }}">

                                    {{ number_format($persentase, 1, ',', '.') }}%

                                </span>

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                {{ number_format($registrasi, 0, ',', '.') }}
                                dari
                                {{ number_format($target, 0, ',', '.') }}
                            </p>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="10" class="px-5 py-16 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-7 w-7"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />

                                </svg>

                            </div>

                            <h4 class="mt-4 text-sm font-bold text-slate-700">
                                Belum Ada Data
                            </h4>

                            <p class="mt-1 text-xs text-slate-500">
                                Data pendaftaran siswa belum tersedia.
                            </p>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}
    @if(count($data) > 0)

        <div class="flex flex-col gap-2 border-t border-slate-200 bg-slate-50/70 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-xs text-slate-500">
                Menampilkan
                <span class="font-bold text-slate-700">{{ count($data) }}</span>
                data jurusan.
            </p>

            <p class="text-xs text-slate-400">
                Rekapitulasi PPDB
            </p>

        </div>

    @endif

</div>
<br />



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

<script>
  /*
    |--------------------------------------------------------------------------
    | RENDER GELOMBANG
    |--------------------------------------------------------------------------
    */

    let gelombangData = [];



    /*
    |--------------------------------------------------------------------------
    | LOAD DATA
    |--------------------------------------------------------------------------
    */

    function loadGelombang() {
      

        fetch("{{ route('gelombang.data') }}", {

                method: 'GET',

                headers: {

                    'Accept': 'application/json'

                }

            })

            .then(response => {

                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data gelombang.'
                    );

                }

                return response.json();

            })

            .then(result => {

                /*
                 * Bisa menerima:
                 *
                 * [
                 *     {...},
                 *     {...}
                 * ]
                 *
                 * atau:
                 *
                 * {
                 *     data: [...]
                 * }
                 */

                if (Array.isArray(result)) {

                    gelombangData = result;

                } else {

                    gelombangData =
                        Array.isArray(result.data) ?
                        result.data :
                        [];

                }

                console.log('Data gelombang:', gelombangData);


                renderGelombang(gelombangData);



            })

            .catch(error => {

                console.error(error);

                document.getElementById(
                    'gelombang-container'
                ).innerHTML = `

                <div class="col-span-full
                            bg-red-50
                            border border-red-100
                            rounded-xl
                            p-6
                            text-center">

                    <p class="text-sm
                              font-semibold
                              text-red-600">

                        Gagal memuat data gelombang.

                    </p>

                    <p class="text-xs
                              text-red-400
                              mt-1">

                        ${escapeHtml(error.message)}

                    </p>

                </div>

            `;

            });

    }


  function renderGelombang(data) {
    const container = document.getElementById('gelombang-container');

    if (!container) {
      console.error('Element gelombang-container tidak ditemukan.');
      return;
    }

    if (!Array.isArray(data) || data.length === 0) {
      container.innerHTML = `
                <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-10 text-center">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                        <svg class="w-6 h-6"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 6h18M3 12h18M3 18h18">
                            </path>
                        </svg>
                    </div>

                    <p class="mt-3 text-sm font-semibold text-slate-600">
                        Belum ada data gelombang.
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        Silakan tambahkan gelombang pendaftaran.
                    </p>
                </div>
            `;

      updateStatistik([]);
      return;
    }

    container.innerHTML = data.map(function(item, index) {
      return createGelombangCard(item, index);
    }).join('');

    updateStatistik(data);
  }


  /*
  |--------------------------------------------------------------------------
  | MEMBUAT KARTU GELOMBANG
  |--------------------------------------------------------------------------
  */

  function createGelombangCard(item, index) {
    const nama = item.nama_gelombang ||
      `Gelombang Pendaftaran ${index + 1}`;

    const id = Number(item.id);

    const isAktif = Number(item.is_current) === 1;

    const awal = formatTanggal(item.awal);
    const akhir = formatTanggal(item.akhir);

    const kuota = Math.max(0, Number(item.kuota) || 0);
    const pendaftar = Math.max(0, Number(item.pendaftar) || 0);
    const terverifikasi = Math.max(0, Number(item.terverifikasi) || 0);

    // Persentase berdasarkan jumlah pendaftar terhadap kuota.
    const persen = kuota > 0 ?
      Math.min(100, Math.round((pendaftar / kuota) * 100)) :
      0;

    const sisaKuota = Math.max(0, kuota - pendaftar);

    const formatAngka = function(angka) {
      return new Intl.NumberFormat('id-ID').format(angka);
    };

    const labelClass = isAktif ?
      'bg-[#e6f9f5] text-[#008f78]' :
      'bg-purple-50 text-purple-600';

    const namaAman = escapeHtml(nama);

    /*
    |--------------------------------------------------------------------------
    | KARTU GELOMBANG AKTIF
    |--------------------------------------------------------------------------
    */

    if (isAktif) {
      return `
                <div class="bg-white rounded-2xl border-2 border-[#02BC9C]/60 shadow-sm flex flex-col justify-between relative overflow-hidden">

                    <div class="p-5 pb-4">

                        <div class="flex items-center justify-between gap-2 mb-3">

                            <span class="px-2.5 py-1 text-[10px] font-bold uppercase rounded-md ${labelClass} tracking-wider">
                                BERJALAN
                            </span>

                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#02BC9C] text-white shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                AKTIF
                            </span>

                        </div>

                        <h4 class="font-bold text-slate-900 text-lg leading-snug">
                            ${namaAman}
                        </h4>

                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-2 font-medium">
                            ${iconCalendar()}
                            <span>Berakhir ${akhir}</span>
                        </div>

                        <!-- PROGRESS KUOTA -->
                        <div class="mt-4">

                            <div class="flex justify-between items-center gap-2 text-xs mb-1.5">

                                <span class="text-slate-500">
                                    Keterisian Kuota
                                </span>

                                <span class="font-bold text-slate-800">
                                    ${formatAngka(pendaftar)} / ${formatAngka(kuota)}
                                    (${persen}%)
                                </span>

                            </div>

                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">

                                <div class="bg-[#02BC9C] h-full rounded-full transition-all duration-500"
                                     style="width:${persen}%">
                                </div>

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-500">
                                ${kuota > 0
                                    ? `Sisa kuota ${formatAngka(sisaKuota)} siswa`
                                    : 'Kuota belum ditentukan'}
                            </p>

                        </div>

                        <!-- STATISTIK -->
                        <div class="grid grid-cols-2 gap-2 mt-5">

                            <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">

                                <p class="text-xs text-slate-600 font-semibold tracking-wide">
                                    Pendaftar
                                </p>

                                <p class="mt-1 text-base font-extrabold text-slate-800">
                                    ${formatAngka(pendaftar)}
                                </p>

                            </div>

                            <div class="bg-[#e6f9f5] rounded-xl p-3 border border-[#02BC9C]/20">

                                <p class="text-xs text-[#008f78] font-semibold tracking-wide">
                                    Terverifikasi
                                </p>

                                <p class="mt-1 text-base font-extrabold text-[#02BC9C]">
                                    ${formatAngka(terverifikasi)}
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- AKSI -->
                    <div class="p-3 pt-0">

                        <button
                            type="button"
                            onclick="editGelombangById(${id})"
                            class="w-full py-2.5 px-4 bg-[#02BC9C] hover:bg-[#02a387] text-white text-xs font-bold rounded-xl flex items-center justify-center gap-2 transition-colors">

                            <span>Kelola Pendaftaran</span>

                            <svg class="w-3.5 h-3.5 stroke-[2.5]"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path d="M14 5l7 7m0 0l-7 7m7-7H3"
                                      stroke-linecap="round"
                                      stroke-linejoin="round">
                                </path>

                            </svg>

                        </button>

                    </div>

                </div>
            `;
    }

    /*
    |--------------------------------------------------------------------------
    | KARTU GELOMBANG MENDATANG
    |--------------------------------------------------------------------------
    */

    return `
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between overflow-hidden">

                <div class="p-5 pb-4">

                    <div class="flex items-center justify-between gap-2 mb-3">

                        <span class="px-2.5 py-1 text-[10px] font-bold uppercase rounded-md bg-purple-50 text-purple-600 tracking-wider">
                            MENDATANG
                        </span>

                        <button
                            type="button"
                            onclick="editGelombangById(${id})"
                            aria-label="Konfigurasi gelombang"
                            class="text-slate-400 hover:text-[#02BC9C] transition-colors">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                                      stroke-linecap="round"
                                      stroke-linejoin="round">
                                </path>

                            </svg>

                        </button>

                    </div>

                    <h4 class="font-bold text-slate-800 text-lg leading-snug">
                        ${namaAman}
                    </h4>

                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-2 font-medium">
                        ${iconCalendar()}
                        <span>Mulai ${awal}</span>
                    </div>

                    <!-- KUOTA -->
                    <div class="mt-4">

                        <div class="flex justify-between items-center gap-2 text-xs mb-1.5">

                            <span class="text-slate-500">
                                Target Kuota
                            </span>

                            <span class="font-bold text-slate-800">
                                ${formatAngka(kuota)} kursi
                            </span>

                        </div>

                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">

                            <div class="bg-slate-300 h-full rounded-full"
                                 style="width:${persen}%">
                            </div>

                        </div>

                    </div>

                    <!-- INFORMASI -->
                    <div class="mt-5 p-3 rounded-xl bg-indigo-50/50 border border-indigo-100/60 flex items-start gap-2.5">

                        <svg class="w-4 h-4 text-indigo-500 shrink-0 mt-0.5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 11v5m0-8h.01"
                                  stroke-linecap="round">
                            </path>

                        </svg>

                        <p class="text-[11px] text-slate-600 leading-relaxed">
                            Gelombang dijadwalkan mulai pada ${awal}.
                            Pastikan tanggal dan kuota sudah sesuai.
                        </p>

                    </div>

                </div>

                <!-- AKSI -->
                <div class="p-3 pt-0">

                    <button
                        type="button"
                        onclick="editGelombangById(${id})"
                        class="w-full py-2.5 px-4 bg-slate-50 hover:bg-[#e6f9f5] hover:text-[#02BC9C] text-slate-700 text-xs font-bold rounded-xl flex items-center justify-between transition-colors border border-slate-200">

                        <span>Edit Konfigurasi</span>

                        <svg class="w-3.5 h-3.5 text-slate-500"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                                  stroke-linecap="round"
                                  stroke-linejoin="round">
                            </path>

                        </svg>

                    </button>

                </div>

            </div>
        `;
  }


  /*
  |--------------------------------------------------------------------------
  | IKON KALENDER
  |--------------------------------------------------------------------------
  */

  function iconCalendar() {
    return `
            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <rect height="18" rx="2" width="18" x="3" y="4"></rect>
                <path d="M16 2v4M8 2v4M3 10h18"
                      stroke-linecap="round">
                </path>

            </svg>
        `;
  }


  /*
  |--------------------------------------------------------------------------
  | FORMAT TANGGAL
  |--------------------------------------------------------------------------
  */

  function formatTanggal(value) {
    if (!value) {
      return '-';
    }

    const match = String(value).match(/^(\d{4})-(\d{2})-(\d{2})/);

    if (!match) {
      return '-';
    }

    const tahun = match[1];
    const bulan = Number(match[2]);
    const hari = match[3];

    const namaBulan = [
      'Jan', 'Feb', 'Mar', 'Apr',
      'Mei', 'Jun', 'Jul', 'Agu',
      'Sep', 'Okt', 'Nov', 'Des'
    ];

    return `${hari} ${namaBulan[bulan - 1]} ${tahun}`;
  }


  /*
  |--------------------------------------------------------------------------
  | ESCAPE HTML
  |--------------------------------------------------------------------------
  */

  function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, function(char) {
      return {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      } [char];
    });
  }


  /*
  |--------------------------------------------------------------------------
  | UPDATE STATISTIK GELOMBANG
  |--------------------------------------------------------------------------
  |
  | Jika elemen statistik tersedia di halaman, nilainya diperbarui.
  | Elemen yang belum ada akan dilewati tanpa menyebabkan error.
  */

  function updateStatistik(data) {
    const total = data.length;

    const aktif = data.filter(function(item) {
      return Number(item.is_current) === 1;
    }).length;

    const nonaktif = total - aktif;

    const totalKuota = data.reduce(function(total, item) {
      return total + Math.max(0, Number(item.kuota) || 0);
    }, 0);

    const totalPendaftar = data.reduce(function(total, item) {
      return total + Math.max(0, Number(item.pendaftar) || 0);
    }, 0);

    const totalTerverifikasi = data.reduce(function(total, item) {
      return total + Math.max(0, Number(item.terverifikasi) || 0);
    }, 0);

    const statistik = {
      'stat-total-gelombang': total,
      'stat-gelombang-aktif': aktif,
      'stat-gelombang-nonaktif': nonaktif,
      'stat-total-kuota': totalKuota,
      'stat-total-pendaftar': totalPendaftar,
      'stat-total-terverifikasi': totalTerverifikasi
    };

    Object.entries(statistik).forEach(function([id, nilai]) {
      const element = document.getElementById(id);

      if (element) {
        element.textContent = new Intl.NumberFormat('id-ID').format(nilai);
      }
    });
  }

  /*
    |--------------------------------------------------------------------------
    | LOAD AWAL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            loadGelombang();

        }
    );
</script>


@endsection