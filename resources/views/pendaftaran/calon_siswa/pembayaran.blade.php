@extends('layout.app')

@section('title', 'Pembayaran PPDB 2026')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full"
    data-purpose="dashboard-main-content">

    <!-- Greeting Header -->
    <section class="mb-6 sm:mb-7"
        data-purpose="page-title-banner">

        <h2 class="text-xl sm:text-2xl lg:text-[28px] font-extrabold text-[#00a86b] tracking-tight">
            Selamat Datang, <?= $nama;  ?>
        </h2>

        <p class="text-slate-500 text-xs sm:text-sm mt-1 sm:mt-1.5 font-normal">
            Pantau status pendaftaran Anda, jadwal ujian, dan lengkapi proses registrasi calon siswa.
        </p>

    </section>

    @if(session('error'))
    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <div class="font-semibold">
            Upload gagal
        </div>

        <div class="mt-1">
            {{ session('error') }}
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        <div class="font-semibold">
            Berhasil
        </div>

        <div class="mt-1">
            {{ session('success') }}
        </div>
    </div>
    @endif


    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        <!-- ========================================== -->
        <!-- LEFT COLUMN -->
        <!-- ========================================== -->

        <div class="lg:col-span-8 space-y-6">

            <!-- Daftar Tagihan -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-6"
                data-purpose="tagihan-container">

                <!-- Card Header -->
                <div class="flex items-center justify-between gap-3 mb-5 sm:mb-6">

                    <div class="flex items-center gap-3 sm:gap-3.5">

                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#00b074] text-white flex items-center justify-center flex-shrink-0 shadow-sm">

                            <svg class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>

                            </svg>

                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-slate-800">
                            Daftar Tagihan
                        </h3>

                    </div>


                    <span class="sm:hidden text-[11px] text-slate-400 font-medium flex items-center gap-1">

                        <svg class="w-3.5 h-3.5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>

                        </svg>

                        Geser tabel

                    </span>

                </div>


                <!-- Table -->
                @php
                $no = 1;
                $totBayar = 0;
                $totKewajiban = 0;
                $totPotongan = 0;
                @endphp

                <div class="overflow-x-auto border border-slate-200/80 rounded-xl mb-6 -mx-1 sm:mx-0">

                    <table class="w-full text-left text-xs sm:text-sm min-w-[800px]"
                        data-purpose="table-bills">

                        <thead>
                            <tr class="bg-[#f1f5f9] text-slate-600 font-semibold border-b border-slate-200">

                                <th class="py-3 px-4 sm:px-5 text-center whitespace-nowrap">
                                    No
                                </th>

                                <th class="py-3 px-4 sm:px-5 whitespace-nowrap">
                                    Item Pembayaran
                                </th>

                                <th class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Kewajiban
                                </th>

                                <th class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Potongan
                                </th>

                                <th class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Dibayar
                                </th>

                                <th class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Sisa
                                </th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($hasil as $row)

                            @php
                            $kewajiban = (float) ($row->SUMK2 ?? 0);
                            $potongan = (float) ($row->SUMP ?? 0);
                            $dibayar = (float) ($row->SUMB ?? 0);

                            $sisa = $kewajiban - $potongan - $dibayar;

                            $totKewajiban += $kewajiban;
                            $totPotongan += $potongan;
                            $totBayar += $dibayar;
                            @endphp

                            <tr class="hover:bg-slate-50 transition-colors">

                                {{-- No --}}
                                <td class="py-3 px-4 sm:px-5 text-center text-slate-600">
                                    {{ $no++ }}
                                </td>

                                {{-- Item --}}
                                <td class="py-3 px-4 sm:px-5 font-medium text-slate-700">
                                    {{ $row->nama_item }}
                                </td>

                                {{-- Kewajiban --}}
                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($kewajiban, 0, ',', '.') }}
                                </td>

                                {{-- Potongan --}}
                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($potongan, 0, ',', '.') }}
                                </td>

                                {{-- Dibayar --}}
                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($dibayar, 0, ',', '.') }}
                                </td>

                                {{-- Sisa --}}
                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap font-semibold
                        {{ $sisa > 0 ? 'text-red-600' : 'text-emerald-600' }}">

                                    Rp {{ number_format($sisa, 0, ',', '.') }}

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="6"
                                    class="py-8 px-4 text-center text-slate-500">

                                    Belum ada data pembayaran.

                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                        @if($hasil->count() > 0)

                        <tfoot>

                            <tr class="bg-slate-50 font-bold text-slate-700 border-t-2 border-slate-200">

                                <td colspan="2"
                                    class="py-3 px-4 sm:px-5 text-center">
                                    TOTAL
                                </td>

                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($totKewajiban, 0, ',', '.') }}
                                </td>

                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($totPotongan, 0, ',', '.') }}
                                </td>

                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($totBayar, 0, ',', '.') }}
                                </td>

                                <td class="py-3 px-4 sm:px-5 text-right whitespace-nowrap">
                                    Rp {{ number_format($totKewajiban - $totPotongan - $totBayar, 0, ',', '.') }}
                                </td>

                            </tr>

                        </tfoot>

                        @endif

                    </table>

                </div>


                <!-- Total Tagihan -->
                <div
                    class="bg-[#eef5ff] border border-[#d6e5fa] rounded-xl p-4 sm:p-5 mb-6 sm:mb-7 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4"
                    data-purpose="total-tagihan-banner">
                    @if($hasil->count() > 0)

                    <div>

                        <span class="text-xs font-bold text-slate-600 tracking-wider uppercase">
                            Total Tagihan Pending
                        </span>

                        <div class="text-2xl sm:text-[26px] font-extrabold text-[#0052cc] mt-0.5 tracking-tight">
                            Rp {{ number_format($totKewajiban - $totPotongan - $totBayar, 0, ',', '.') }}
                        </div>

                    </div>
                    @endif

                    <!-- Rekening -->
                    <div id="rekening-mandiri"
                        class="bg-white border border-slate-200/90 rounded-lg p-3 sm:p-3.5 flex items-center gap-3 sm:gap-4 w-full md:w-auto shadow-sm scroll-mt-28 transition-all duration-300">

                        <div class="w-12 sm:w-14 h-8 sm:h-9 rounded-md bg-gradient-to-tr from-slate-200 to-slate-100 border border-slate-300 flex flex-col justify-between p-1 shadow-xs flex-shrink-0">

                            <div class="h-1.5 sm:h-2 w-full bg-slate-700 rounded-sm"></div>

                            <div class="h-1 sm:h-1.5 w-5 sm:w-6 bg-amber-400 rounded-xs"></div>

                        </div>


                        <div class="flex-1 min-w-0">

                            <div class="text-[10px] font-bold text-slate-600 uppercase tracking-tight truncate">
                                Transfer ke Rek Bank Mandiri
                            </div>

                            <div id="account-number"
                                class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight leading-none mt-0.5">
                                9000123456789
                            </div>

                            <div class="text-[11px] text-slate-400 font-medium mt-0.5">
                                a.n MOBIS (Mobile Information School)
                            </div>

                        </div>


                        <button id="copy-account-btn"
                            type="button"
                            aria-label="Salin nomor rekening"
                            class="relative p-2 hover:bg-slate-100 rounded-lg text-blue-600 transition flex-shrink-0">

                            <svg class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>

                            </svg>

                        </button>

                    </div>

                </div>


                <!-- Toast -->
                <div id="copy-toast"
                    class="fixed bottom-6 right-6 bg-slate-900 text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow-lg pointer-events-none opacity-0 transition-opacity duration-300 z-50">

                    Nomor rekening berhasil disalin!

                </div>


                <!-- Langkah Pembayaran -->
                <div data-purpose="payment-instructions">

                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-4">
                        Langkah Pembayaran
                    </h4>

                    <ul class="space-y-3 sm:space-y-3.5">

                        <li class="flex items-start gap-3">

                            <span class="w-5 h-5 rounded-full bg-[#00b074] text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                1
                            </span>

                            <p class="text-xs text-slate-600 leading-relaxed">
                                Lakukan transfer ATM, Mobile Banking, atau Internet Banking sesuai nominal di atas.
                            </p>

                        </li>

                        <li class="flex items-start gap-3">

                            <span class="w-5 h-5 rounded-full bg-[#00b074] text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                2
                            </span>

                            <p class="text-xs text-slate-600 leading-relaxed">
                                Simpan bukti transfer dalam format JPG, PNG, atau PDF (Maks. 2MB).
                            </p>

                        </li>

                        <li class="flex items-start gap-3">

                            <span class="w-5 h-5 rounded-full bg-[#00b074] text-white flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                3
                            </span>

                            <p class="text-xs text-slate-600 leading-relaxed">
                                Unggah bukti tersebut pada formulir di sebelah kanan halaman ini.
                            </p>

                        </li>

                    </ul>

                </div>

            </div>

        </div>


        <!-- ========================================== -->
        <!-- RIGHT COLUMN -->
        <!-- ========================================== -->

        <div class="lg:col-span-4 space-y-6">


            <!-- Upload Bukti -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-200/90 shadow-sm p-4 sm:p-6"
                data-purpose="upload-proof-card">

                <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-4 sm:mb-5">
                    Unggah Bukti
                </h3>


                <form action="{{ route('calon-siswa.pembayaran', $id ?? 0) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">

                    @csrf

                    <!-- Nama Pengirim -->
                    <div>

                        <label for="sender_name"
                            class="block text-xs font-bold text-slate-700 mb-1.5">

                            Nama Pengirim

                        </label>

                        <input
                            type="text"
                            id="sender_name"
                            name="sender_name"
                            placeholder="Contoh: Devin Garmenta"
                            class="w-full text-xs sm:text-sm rounded-lg border-slate-300 px-3.5 py-2.5 sm:py-3 text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-emerald-500 transition">

                    </div>


                    <!-- Item Pembayaran -->
                    <div>

                        <label for="payment_item"
                            class="block text-xs font-bold text-slate-700 mb-1.5">

                            Item Pembayaran

                        </label>

                        <select
                            id="payment_item"
                            name="payment_item"
                            class="w-full text-xs sm:text-sm rounded-lg border-slate-300 px-3.5 py-2.5 sm:py-3 text-slate-700 focus:border-emerald-500 focus:ring-emerald-500 transition">

                            <option value="">
                                Pilih Item Pembayaran
                            </option>

                            @foreach($itemBayar as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_item }}
                            </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- Upload -->
                    <div>

                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Upload Bukti Transfer
                        </label>

                        <div
                            id="drop-zone"
                            onclick="document.getElementById('file_upload').click()"
                            class="border-2 border-dashed border-slate-300 rounded-xl p-5 sm:p-6 text-center hover:border-emerald-500 transition-colors cursor-pointer bg-[#fafafa]">

                            <div class="flex justify-center mb-2">

                                <svg class="w-8 sm:w-9 h-8 sm:h-9 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.75"
                                    viewBox="0 0 24 24">

                                    <path
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>

                                </svg>

                            </div>


                            <p id="file-label"
                                class="text-xs font-medium text-slate-700 leading-snug">

                                Klik untuk cari atau<br>
                                seret file ke sini

                            </p>

                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-semibold">
                                JPG, PNG, PDF (MAX 2MB)
                            </p>


                            <input
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="hidden"
                                id="file_upload"
                                name="bukti_transfer"
                                type="file">

                        </div>

                    </div>


                    <!-- Submit -->
                    <div class="pt-1">

                        <button
                            type="submit"
                            class="w-full py-3 sm:py-3.5 px-4 bg-[#00b074] hover:bg-[#009b64] active:scale-[0.99] text-white font-semibold text-xs sm:text-sm rounded-xl flex items-center justify-center gap-2.5 transition shadow-sm">

                            <svg class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>

                            </svg>

                            <span>
                                Unggah Bukti Pembayaran
                            </span>

                        </button>

                    </div>

                </form>

            </div>


            <!-- Status -->
            <div
                class="bg-[#fffbeb] border border-[#fde68a] rounded-xl sm:rounded-2xl p-4 sm:p-5 flex items-start gap-3 sm:gap-3.5"
                data-purpose="status-warning-card">

                <div class="text-[#d97706] mt-0.5 flex-shrink-0">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="10"></circle>

                        <path
                            d="M12 8v4m0 4h.01"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                    </svg>

                </div>




            </div>

        </div>

    </div>

</main>

@endsection


@push('scripts')

<script>
    // ==========================================
    // COPY NOMOR REKENING
    // ==========================================

    const copyBtn = document.getElementById('copy-account-btn');
    const toast = document.getElementById('copy-toast');
    const accNumber = document.getElementById('account-number');

    if (copyBtn && accNumber) {

        copyBtn.addEventListener('click', async () => {

            try {

                await navigator.clipboard.writeText(
                    accNumber.innerText.trim()
                );

                if (toast) {

                    toast.classList.remove('opacity-0');
                    toast.classList.add('opacity-100');

                    setTimeout(() => {

                        toast.classList.remove('opacity-100');
                        toast.classList.add('opacity-0');

                    }, 2000);

                }

            } catch (err) {

                console.error('Failed to copy: ', err);

            }

        });

    }


    // ==========================================
    // FOCUS REKENING
    // ==========================================

    function focusRekening(itemVal) {

        const itemSelect = document.getElementById('payment_item');

        if (itemSelect && itemVal) {
            itemSelect.value = itemVal;
        }


        const rekeningBox = document.getElementById('rekening-mandiri');

        if (rekeningBox) {

            rekeningBox.classList.remove('rekening-highlight');

            void rekeningBox.offsetWidth;

            rekeningBox.classList.add('rekening-highlight');

        }

    }


    // ==========================================
    // FILE UPLOAD
    // ==========================================

    const fileUpload = document.getElementById('file_upload');
    const fileLabel = document.getElementById('file-label');

    if (fileUpload && fileLabel) {

        fileUpload.addEventListener('change', (e) => {

            if (e.target.files && e.target.files[0]) {

                fileLabel.innerHTML =
                    `File terpilih:<br>
                    <strong class="text-emerald-600">
                        ${e.target.files[0].name}
                    </strong>`;

            }

        });

    }
</script>

@endpush