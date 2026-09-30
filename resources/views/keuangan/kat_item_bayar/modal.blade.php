<div id="modal-form" class="modal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="formData">

                @csrf

                <input type="hidden" id="id" name="id">

                <div class="modal-header">
                    <h2 class="font-medium text-base" id="modal-title">
                        Tambah Kategori Item Bayar
                    </h2>
                </div>

                <div class="modal-body">

                    <div>
                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            id="nama_kategori"
                            name="nama_kategori"
                            class="form-control"
                            placeholder="Masukkan nama kategori">
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

            </form>

        </div>

    </div>

</div>