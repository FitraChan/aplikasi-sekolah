<div id="modal-edit-pengumuman" class="modal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg">

    <div class="modal-content">

        <div class="modal-header">
            <h2 class="font-medium text-base mr-auto">
                Edit Pengumuman
            </h2>
        </div>

        <input
            type="hidden"
            id="edit_id">

        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

            <div class="col-span-12">
                <label class="form-label">
                    Kategori
                </label>

                <select
                    id="edit_kategori_id"
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

            <div class="col-span-12">
                <label class="form-label">
                    Judul
                </label>

                <input
                    type="text"
                    id="edit_judul"
                    class="form-control">
            </div>

            <div class="col-span-12">
                <label class="form-label">
                    Isi Pengumuman
                </label>

                <textarea
                    id="edit_isi"
                    class="form-control"
                    rows="5"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">
                    Prioritas
                </label>

                <select
                    id="edit_prioritas"
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
                    id="edit_status"
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
                    id="edit_publish_at"
                    class="form-control">
            </div>

            <div class="col-span-12 sm:col-span-6">
                <label class="form-label">
                    Tanggal Berakhir
                </label>

                <input
                    type="datetime-local"
                    id="edit_expired_at"
                    class="form-control">
            </div>

            <div class="col-span-12">
                <label class="form-label">
                    Ganti Lampiran
                </label>

                <input
                    type="file"
                    id="edit_lampiran"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
            </div>

            <div class="col-span-12">
                <div class="form-check">

                    <input
                        id="edit_is_pinned"
                        class="form-check-input"
                        type="checkbox"
                        value="1">

                    <label
                        class="form-check-label"
                        for="edit_is_pinned">

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

                Update

            </button>

        </div>

    </div>

</div>
</div>

