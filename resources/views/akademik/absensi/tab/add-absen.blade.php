<div id="modal-add-jadwal" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Tambah Master Jadwal
                </h2>
            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Tahun Ajaran
                    </label>

                    <select
                        id="add_id_tahun"
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
                        id="add_semester"
                        class="form-select">

                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>

                    </select>

                </div>

                <div class="col-span-12 sm:col-span-6">

                    <label class="form-label">
                        Kelas
                    </label>

                    <select
                        id="add_id_kelas"
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
                        id="add_id_mapel"
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
                        id="add_id_gtk"
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
                        id="add_jml_jam"
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