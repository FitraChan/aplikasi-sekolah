<div id="modal-add-pengumuman" class="modal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg">

    <div class="modal-content">

        <div class="modal-header">
            <h2 class="font-medium text-base mr-auto">
                Tambah Pengumuman
            </h2>
        </div>

        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

            <div class="col-span-12">
                <label class="form-label">
                    Kategori
                </label>

                <select
                    id="add_kategori_id"
                    class="form-control">

                    <option value="">
                        Pilih Kategori
                    </option>

                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-span-12 sm:col-span-6">
    <label class="form-label">
        Target Pengumuman
    </label>

    <select
        id="add_target_type"
        class="form-control"
        onchange="ubahTargetPengumuman('add')">

        <option value="semua">
            Semua Pengguna
        </option>

        <option value="siswa">
            Siswa Tertentu
        </option>

        <option value="kelas">
            Kelas Tertentu
        </option>

        <option value="orang_tua">
            Semua Orang Tua
        </option>

        <option value="guru">
            Semua Guru
        </option>

        <option value="calon_siswa">
            Semua Calon Siswa
        </option>

        <option value="pendaftar">
            Calon Siswa Tertentu
        </option>

        <option value="gelombang_pendaftaran">
            Gelombang Pendaftaran
        </option>

        <option value="jalur_pendaftaran">
            Jalur Pendaftaran
        </option>

        <option value="status_pendaftaran">
            Status Pendaftaran
        </option>

    </select>
</div>

<div
    id="add_target_id_container"
    class="col-span-12 sm:col-span-6 hidden">

    <label
        id="add_target_id_label"
        class="form-label">

        Target ID

    </label>

    <input
        type="number"
        id="add_target_id"
        class="form-control"
        placeholder="Masukkan ID target">

</div>

            <div class="col-span-12">
                <label class="form-label">
                    Judul
                </label>

                <input
                    type="text"
                    id="add_judul"
                    class="form-control"
                    placeholder="Masukkan judul pengumuman">
            </div>

            <div class="col-span-12">
                <label class="form-label">
                    Isi Pengumuman
                </label>

                <textarea
                    id="add_isi"
                    class="form-control"
                    rows="5"
                    placeholder="Masukkan isi pengumuman"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">
                    Prioritas
                </label>

                <select
                    id="add_prioritas"
                    class="form-control">

                    <option value="normal">
                        Normal
                    </option>

                    <option value="penting">
                        Penting
                    </option>

                    <option value="darurat">
                        Darurat
                    </option>

                </select>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">
                    Status
                </label>

                <select
                    id="add_status"
                    class="form-control">

                    <option value="draft">
                        Draft
                    </option>

                    <option value="published">
                        Published
                    </option>

                    <option value="archived">
                        Archived
                    </option>

                </select>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">
                    Tanggal Publish
                </label>

                <input
                    type="datetime-local"
                    id="add_publish_at"
                    class="form-control">
            </div>

            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">
                    Tanggal Berakhir
                </label>

                <input
                    type="datetime-local"
                    id="add_expired_at"
                    class="form-control">
            </div>

            <div class="col-span-12">
                <label class="form-label">
                    Lampiran
                </label>

                <input
                    type="file"
                    id="add_lampiran"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
            </div>

            <div class="col-span-12">
                <div class="form-check">

                    <input
                        id="add_is_pinned"
                        class="form-check-input"
                        type="checkbox"
                        value="1">

                    <label
                        class="form-check-label"
                        for="add_is_pinned">

                        Tampilkan di posisi paling atas

                    </label>

                </div>
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
                type="button"
                onclick="saveData()"
                class="btn btn-primary">

                Simpan

            </button>

        </div>

    </div>

</div>
</div>



