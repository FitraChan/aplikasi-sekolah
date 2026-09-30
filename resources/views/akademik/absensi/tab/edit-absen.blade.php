<div id="modal-edit-jadwal" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Edit Master Jadwal
                </h2>
            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <input
                    type="hidden"
                    id="edit_id">

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Tahun Ajaran
                    </label>

                    <select
                        id="edit_id_tahun"
                        class="form-select">

                        <option value="">
                            Pilih Tahun Ajaran
                        </option>

                        @foreach($tahun as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->thn_ajaran }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Semester
                    </label>

                    <select
                        id="edit_semester"
                        class="form-select">

                        <option value="1">
                            Semester 1
                        </option>

                        <option value="2">
                            Semester 2
                        </option>

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Kelas
                    </label>

                    <select
                        id="edit_id_kelas"
                        class="form-select">

                        <option value="">
                            Pilih Kelas
                        </option>

                        @foreach($kelas as $item)

                        <option value="{{ $item->idx }}">
                            {{ $item->nama_kelas }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Mata Pelajaran
                    </label>

                    <select
                        id="edit_id_mapel"
                        class="tom-select w-full">

                        <option value="">
                            Pilih Mata Pelajaran
                        </option>

                        @foreach($mapel as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_mapel }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-span-12">

                    <label class="form-label">
                        Guru Pengajar
                    </label>

                    <select
                        id="edit_id_gtk"
                        class="form-select">

                        <option value="">
                            Pilih Guru
                        </option>

                        @foreach($guru as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_gtk }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Jumlah Jam
                    </label>

                    <input
                        type="number"
                        id="edit_jml_jam"
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