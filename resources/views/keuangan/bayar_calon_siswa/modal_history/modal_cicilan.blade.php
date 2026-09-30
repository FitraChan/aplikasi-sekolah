<div id="modal-cicilan-form" class="modal" tabindex="-1">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base">
                    Input Pembayaran Cicilan
                </h2>
            </div>

            <div class="modal-body">

                <input type="hidden" id="id_calon_siswa_cicilan" name="id_csiswa">

                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">Tanggal Bayar</label>
                        <input
                            type="date"
                            id="tgl_bayar"
                            name="tgl_bayar"
                            class="form-control">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">No Kwitansi</label>
                        <input
                            type="text"
                            id="no_kwitansi"
                            name="no_kwitansi"
                            class="form-control"
                            placeholder="Masukkan nomor kwitansi">
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Keterangan</label>
                        <textarea
                            id="keterangan"
                            name="keterangan"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan keterangan"></textarea>
                    </div>

                    <div class="col-span-12 md:col-span-3">
                        <label class="form-label">Pendaftaran</label>
                        <input
                            type="number"
                            id="jml_pendaftaran"
                            name="jml_pendaftaran"
                            class="form-control"
                            value="0">
                    </div>

                    <div class="col-span-12 md:col-span-3">
                        <label class="form-label">DPP</label>
                        <input
                            type="number"
                            id="jml_dpp"
                            name="jml_dpp"
                            class="form-control"
                            value="0">
                    </div>

                    <div class="col-span-12 md:col-span-3">
                        <label class="form-label">MOS</label>
                        <input
                            type="number"
                            id="jml_mos"
                            name="jml_mos"
                            class="form-control"
                            value="0">
                    </div>

                    <div class="col-span-12 md:col-span-3">
                        <label class="form-label">Seragam</label>
                        <input
                            type="number"
                            id="jml_seragam"
                            name="jml_seragam"
                            class="form-control"
                            value="0">
                    </div>

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
                    id="btn-save-cicilan"
                    class="btn btn-success"
                    onclick="saveCicilan()"
                >
                    <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
                    <span id="text-save-cicilan">Simpan Pembayaran</span>
                </button>

            </div>

        </div>

    </div>

</div>