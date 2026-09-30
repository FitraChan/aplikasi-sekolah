<div id="modal-add-kelas" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Tambah Kelas
                </h2>
            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Nama Kelas
                    </label>

                    <input
                        type="text"
                        id="add_nama_kelas"
                        class="form-control"
                        placeholder="Contoh : X RPL 1">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="add_id_jurusan"
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
                        Tingkat Kelas
                    </label>

                    <select
                        id="add_kelas"
                        class="form-select">

                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Alias
                    </label>

                    <input
                        type="text"
                        id="add_alias"
                        class="form-control"
                        placeholder="Contoh : X-RPL-1">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Urutan (Idx)
                    </label>

                    <input
                        type="number"
                        id="add_idx"
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