<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-12 lg:col-span-12">
            <div class="box h-full">
                <div class="p-5">
                    <div class="mb-5">

                      <input
                                type="hidden"
                                id="id_bayar_detail"
                                
                                readonly>

                        <div class="flex items-center gap-3 mb-3">
                            <label class="w-32 text-sm font-medium">No Daftar</label>

                          
                            <input
                                type="text"
                                id="id_calon_siswa_detail"
                                class="form-control form-control-sm h-8 text-sm flex-1"
                                readonly>
                        </div>

                        <div class="flex items-center gap-3 mb-3">
                            <label class="w-32 text-sm font-medium">Nama Siswa</label>
                            <input
                                type="text"
                                id="nama_siswa_detail"
                                class="form-control form-control-sm h-8 text-sm flex-1"
                                readonly>
                        </div>

                        <div class="flex items-center gap-3">
                            <label class="w-32 text-sm font-medium">Jurusan</label>
                            <input
                                type="text"
                                id="jurusan_siswa_detail"
                                class="form-control form-control-sm h-8 text-sm flex-1"
                                readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- HISTORY PEMBAYARAN -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box h-full">

                <div class="flex items-center px-5 py-4 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        History Pembayaran
                    </h2>

                    <div class="flex gap-2">

                       
                        <button
                            type="button"
                            class="btn btn-primary"
                            onclick="editHistoryBayar()">

                            <i data-lucide="activity" class="w-4 h-4 mr-2"></i> 

                            Edit

                        </button>

                        <button
                            type="button"
                            class="btn btn-danger"
                            onclick="hapusHistoryBayar()">

                            <i data-lucide="trash-2"
                                class="w-4 h-4 mr-1"></i>

                            Hapus

                        </button>

                    </div>

                </div>

                <div class="p-5">
                    <div id="tableHistoryBayarDetail"></div>
                </div>

            </div>
        </div>
        <!-- DETAIL TRANSAKSI -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box h-full">

                <div class="flex items-center px-5 py-4 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> Data Pembayaran Calon Siswa</h2>
                    <div class="flex gap-2">


                     <button
                        class="btn btn-warning"
                         data-tw-toggle="modal"
                        data-tw-target="#modal-tambah-form">

                        <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> 
                        Tambah

                    </button>

                    <button
                        class="btn btn-primary"
                        onclick="editData()">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> 

                        Edit
                    </button>

                     <button
                        class="btn btn-danger"
                        onclick="hapusData()">

                        <i data-lucide="trash" class="w-4 h-4 mr-2"></i> 
                        Hapus

                    </button>
                    </div>
                </div>

                <div class="p-5">

                    <div class="overflow-x-auto">
                        <div id="tableDetailBayar"></div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>


@include('keuangan.bayar_calon_siswa.modal_detail.modal_tambah')
@include('keuangan.bayar_calon_siswa.modal_detail.modal_update_history')

