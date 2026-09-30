<div id="modal-edit-kelas" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <input type="hidden" id="edit_id">

            <div class="modal-header">

                <h2 class="font-medium text-base mr-auto">
                    Edit Kelas
                </h2>

            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Nama Kelas
                    </label>

                    <input
                        type="text"
                        id="edit_nama_kelas"
                        class="form-control">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="edit_id_jurusan"
                        class="form-select">

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
                        id="edit_kelas"
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
                        id="edit_alias"
                        class="form-control">

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Urutan (Idx)
                    </label>

                    <input
                        type="number"
                        id="edit_idx"
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