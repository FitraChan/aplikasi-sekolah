

<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> Data Pembayaran Calon Siswa</h2>
                    <div class="flex gap-2">

                    <button
                        class="btn btn-primary"
                        data-tw-toggle="modal"
                        data-tw-target="#modal-bulanan-all-siswa">

                        Set Bulanan All Siswa

                    </button>

                     <button
                        class="btn btn-success"
                        onclick="cetakKewajiban()">

                        <i data-lucide="printer" class="w-4 h-4 mr-1"></i>
                        Cetak Kewajiban

                    </button>
                    </div>
                </div>

                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">

                            <div class="grid grid-cols-12 gap-3 mb-4">

                                <div class="col-span-12 md:col-span-3">
                                    <select id="filter_tahun" class="form-select">
                                        <option value="">Semua Tahun Ajaran</option>

                                        @foreach($tahun as $row)
                                        <option value="{{ $row->thn_ajaran }}">
                                            {{ $row->thn_ajaran }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-span-12 md:col-span-3">
                                    <select id="filter_jurusan" class="form-select">
                                        <option value="">Semua Jurusan</option>

                                        @foreach($jurusan as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->nama_jurusan }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-span-12 md:col-span-3">
                                    <select id="filter_kelas" class="form-select">
                                        <option value="">Semua Kelas</option>

                                        @foreach($kelas as $row)
                                        <option value="{{ $row->idx }}">
                                            {{ $row->nama_kelas }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>



                                <div class="col-span-12 md:col-span-3">
                                    <input
                                        type="text"
                                        id="filter_keyword"
                                        class="form-control"
                                        placeholder="Nama / NIPD">
                                </div>

                                <div class="col-span-12 md:col-span-1">
                                    <button
                                        class="btn btn-secondary w-full"
                                        onclick="applyFilter()">
                                        Cari
                                    </button>
                                </div>

                            </div>
                            <div id="tableBayar"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> History Pembayaran Calon Siswa</h2>
                    <div class="flex gap-2">

                        <button
                            type="button"
                            class="btn btn-warning"
                            onclick="openModalCicilan()">

                            <i data-lucide="wallet" class="w-4 h-4 mr-1"></i>
                            Cicilan

                        </button>

                       <button
                            type="button"
                            class="btn btn-success"
                            onclick="openModalBayar()">

                            <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
                            Bayar

                        </button>
                       
                    </div>
                </div>



                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">

                        <input type="hidden" id="id_bayar" value="">
                            <input type="hidden" id="id_calon_siswa" value="">

                            <div id="tableHistoryBayar"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

@include('keuangan.bayar_calon_siswa.modal_history.modal_bulanan_all_siswa')
@include('keuangan.bayar_calon_siswa.modal_history.modal_bayar')
@include('keuangan.bayar_calon_siswa.modal_history.modal_cicilan')


