<div id="modal-add-ujian" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('pbm.simpanUjian') }}" method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Tambah Ujian
                    </h2>
                </div>

                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                    <input
                        type="hidden"
                        name="master_kelas_id"
                        value="{{ $id }}">

                    <!-- Judul -->
                    <div class="col-span-12">

                        <label class="form-label">
                            Judul Ujian
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            placeholder="Masukkan Judul Ujian"
                            required>

                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="col-span-12 sm:col-span-6">

                        <label class="form-label">
                            Mata Pelajaran
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $master->mapel->nama_mapel }}"
                            readonly>

                    </div>

                    <!-- Durasi -->
                    <div class="col-span-12 sm:col-span-6">

                        <label class="form-label">
                            Durasi (Menit)
                        </label>

                        <input
                            type="number"
                            name="durasi"
                            class="form-control"
                            placeholder="Contoh : 90"
                            required>

                    </div>

                    <!-- Tanggal Quiz -->
                    <div class="col-span-12 sm:col-span-4">

                        <label class="form-label">
                            Tanggal Quiz
                        </label>

                        <input
                            type="date"
                            name="tgl_quiz"
                            class="form-control"
                            required>

                    </div>

                    <!-- Mulai -->
                    <div class="col-span-12 sm:col-span-4">

                        <label class="form-label">
                            Tanggal Mulai
                        </label>

                        <input
                            type="datetime-local"
                            name="tgl_mulai"
                            class="form-control"
                            required>

                    </div>

                    <!-- Selesai -->
                    <div class="col-span-12 sm:col-span-4">

                        <label class="form-label">
                            Tanggal Selesai
                        </label>

                        <input
                            type="datetime-local"
                            name="tgl_selesai"
                            class="form-control"
                            required>

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
                        type="submit"
                        class="btn btn-primary w-24">

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>