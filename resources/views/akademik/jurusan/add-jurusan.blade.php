<div id="modal-add-jurusan" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Tambah Jurusan
                </h2>
            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <div class="col-span-12">

                    <label class="form-label">
                        Nama Jurusan
                    </label>

                    <input
                        type="text"
                        id="add_nama_jurusan"
                        class="form-control"
                        placeholder="Contoh : Rekayasa Perangkat Lunak">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Singkatan
                    </label>

                    <input
                        type="text"
                        id="add_singkatan"
                        class="form-control"
                        placeholder="Contoh : RPL">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Jumlah Siswa
                    </label>

                    <input
                        type="number"
                        id="add_jumlah_siswa"
                        class="form-control"
                        value="0">

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    data-tw-dismiss="modal"
                    class="btn btn-outline-secondary w-24 mr-1">

                    Batal

                </button>

                <button
                    type="button"
                    onclick="saveData()"
                    class="btn btn-primary w-24">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>