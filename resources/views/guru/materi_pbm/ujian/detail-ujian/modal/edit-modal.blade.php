<div id="modal-add-ujian" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Edit Soal
                </h2>
            </div>

            <form id="formEditSoal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <input type="hidden" id="form_mode" value="add">
                    <input type="hidden" name="id" id="e_id">

                    <!-- Judul -->
                    <div class="col-span-12">
                        <label class="form-label">Judul Soal</label>

                        <div class="input-group">
                            <div class="input-group-text">
                                Judul
                            </div>

                            <input
                                type="text"
                                class="form-control"
                                id="e_judul_soal"
                                name="judul_soal"
                                placeholder="Masukkan Judul Soal">
                        </div>
                    </div>

                    <!-- Jenis Soal -->
                    <div class="col-span-6">
                        <label class="form-label">Jenis Soal</label>

                        <select
                            class="form-select"
                            id="e_jenis_soal_id"
                            name="jenis_soal_id">
                        </select>
                    </div>

                    <!-- Mapel -->
                    <div class="col-span-6">
                        <label class="form-label">Mata Pelajaran</label>

                        <select
                            class="form-select"
                            id="e_mapel_id"
                            name="mapel_id">
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="col-span-12">
                        <label class="form-label">Semester</label>

                        <div class="input-group">
                            <div class="input-group-text">
                                Semester
                            </div>

                            <input
                                type="text"
                                class="form-control"
                                id="e_smt"
                                name="smt"
                                placeholder="Semester">
                        </div>
                    </div>

                    <!-- Soal -->
                    <div class="col-span-12">
                        <label class="form-label">Soal</label>

                        <textarea
                            id="e_editor"
                            name="soal">
                        </textarea>
                    </div>

                    <!-- Upload -->
                    <div class="col-span-12">
                        <label class="form-label">
                            Gambar Soal
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="e_url_soal"
                            name="url_soal">
                    </div>

                    <div class="col-span-4 flex items-end">
                        <img
                            id="preview_soal"
                            src=""
                            class="w-40 rounded border hidden">
                    </div>

                    <!-- Jawaban -->
                    @foreach(['a','b','c','d','e'] as $jwb)

                    <div class="col-span-12">

                        <label class="form-label">
                            Jawaban {{ strtoupper($jwb) }}
                        </label>

                        <div class="input-group">

                            <div class="input-group-text font-bold">
                                {{ strtoupper($jwb) }}
                            </div>

                            <input
                                type="text"
                                class="form-control"
                                id="e_jawaban_{{ $jwb }}"
                                name="jawaban_{{ $jwb }}"
                                placeholder="Masukkan Jawaban {{ strtoupper($jwb) }}">

                        </div>

                    </div>

                    @endforeach

                    <!-- Jawaban Benar -->
                    <div class="col-span-12">

                        <label class="form-label">
                            Jawaban Benar
                        </label>

                        <select
                            class="form-select"
                            id="e_jawaban_benar"
                            name="jawaban_benar">

                            <option value="">Pilih Jawaban</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        data-tw-dismiss="modal"
                        class="btn btn-outline-secondary">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>



