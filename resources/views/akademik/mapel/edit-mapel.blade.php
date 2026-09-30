<div id="modal-edit-mapel" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <input type="hidden" id="edit_id">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Edit Mata Pelajaran
                </h2>
            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <div class="col-span-12">

                    <label class="form-label">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        id="edit_nama_mapel"
                        class="form-control"
                        placeholder="Contoh : Bahasa Indonesia">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="edit_id_jurusan"
                        class="form-select">

                        <option value="">
                            Pilih Jurusan
                        </option>

                        @foreach($jurusan as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_jurusan }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Kategori Mapel
                    </label>

                    <select
                        id="edit_id_kategori_mapel"
                        class="form-select">

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach($kategori as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_kategori_mapel }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Kurikulum
                    </label>

                    <input
                        type="text"
                        id="edit_kurikulum"
                        class="form-control"
                        placeholder="Contoh : Merdeka">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        id="edit_ket"
                        class="form-select">

                        <option value="1">
                            Aktif
                        </option>

                        <option value="0">
                            Tidak Aktif
                        </option>

                    </select>

                </div>

                <div class="col-span-12">
                    <h3 class="font-medium text-base">
                        Jam Pelajaran per Semester
                    </h3>
                </div>

                <div class="col-span-6 md:col-span-2">

                    <label class="form-label">
                        SMT 1
                    </label>

                    <input
                        type="number"
                        id="edit_smt1"
                        class="form-control">

                </div>

                <div class="col-span-6 md:col-span-2">

                    <label class="form-label">
                        SMT 2
                    </label>

                    <input
                        type="number"
                        id="edit_smt2"
                        class="form-control">

                </div>

                <div class="col-span-6 md:col-span-2">

                    <label class="form-label">
                        SMT 3
                    </label>

                    <input
                        type="number"
                        id="edit_smt3"
                        class="form-control">

                </div>

                <div class="col-span-6 md:col-span-2">

                    <label class="form-label">
                        SMT 4
                    </label>

                    <input
                        type="number"
                        id="edit_smt4"
                        class="form-control">

                </div>

                <div class="col-span-6 md:col-span-2">

                    <label class="form-label">
                        SMT 5
                    </label>

                    <input
                        type="number"
                        id="edit_smt5"
                        class="form-control">

                </div>

                <div class="col-span-6 md:col-span-2">

                    <label class="form-label">
                        SMT 6
                    </label>

                    <input
                        type="number"
                        id="edit_smt6"
                        class="form-control">

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

                    Update

                </button>

            </div>

        </div>

    </div>

</div>