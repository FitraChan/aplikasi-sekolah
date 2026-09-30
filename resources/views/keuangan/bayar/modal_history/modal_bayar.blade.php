<div id="modal-bayar-form" class="modal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <input type="hidden" id="id_siswa">

            <div class="modal-header">
                <h2 class="font-medium text-base">
                    Pembayaran Siswa
                </h2>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Tanggal Bayar</label>

                    <input
                        type="date"
                        id="tgl_bayar"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>No Kwitansi</label>

                    <input
                        type="text"
                        id="no_kwitansi"
                        class="form-control"
                        placeholder="Masukkan nomor kwitansi">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>

                    <textarea
                        id="keterangan"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan keterangan pembayaran"></textarea>
                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-tw-dismiss="modal">

                    Batal

                </button>

             <button
                    type="button"
                    id="btn-save-bayar"
                    class="btn btn-success"
                    onclick="saveBayar()">

                    <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
                    Simpan Pembayaran

                </button>
            </div>

        </div>

    </div>

</div>