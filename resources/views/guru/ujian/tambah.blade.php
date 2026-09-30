<div id="modal-add-ujian" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Tambah Ujian
                </h2>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="frm-tambah-ujian" method="post" enctype="multipart/form-data">

                    <!-- Judul Ujian -->
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            Judul Ujian
                        </div>

                        <input
                            type="text"
                            class="form-control"
                            name="judul"
                            id="judul"
                            placeholder="Masukkan Judul Ujian">
                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            Mata Pelajaran
                        </div>

                        <select
                            class="form-control"
                            name="master_kelas_id"
                            id="master_kelas_id">

                            <option value="">Pilih Mata Pelajaran</option>

                            <?php foreach ($mapel as $row) : ?>
                                <option value="<?= $row['id']; ?>">
                                    <?= $row['nama_mapel'] . ' - Kelas ' . $row['kelas'] . ' ' . $row['nama_kelas']; ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Durasi -->
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            Durasi
                        </div>

                        <input
                            type="number"
                            class="form-control"
                            name="durasi"
                            id="durasi"
                            placeholder="Durasi dalam menit">
                    </div>

                    <!-- Tanggal Ujian -->
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            Tanggal Ujian
                        </div>

                        <input
                            type="date"
                            class="form-control"
                            name="tgl_quiz"
                            id="tgl_quiz">
                    </div>

                    <!-- Mulai Ujian -->
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            Mulai Ujian
                        </div>

                        <input
                            type="datetime-local"
                            class="form-control"
                            name="tgl_mulai"
                            id="tgl_mulai">
                    </div>

                    <!-- Selesai Ujian -->
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            Selesai Ujian
                        </div>

                        <input
                            type="datetime-local"
                            class="form-control"
                            name="tgl_selesai"
                            id="tgl_selesai">
                    </div>

                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button
                    type="button"
                    data-tw-dismiss="modal"
                    class="btn btn-outline-secondary w-24 mr-2">
                    Batal
                </button>

                <button
                    type="button"
                    id="btn-save-ujian"
                    class="btn btn-primary w-24">
                    Simpan
                </button>
            </div>

        </div>
    </div>
</div>
<script>




</script>