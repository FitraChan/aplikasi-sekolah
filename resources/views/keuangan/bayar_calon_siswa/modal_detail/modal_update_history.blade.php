<div id="modal-update-history-form" class="modal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="form-bayar">

                <input type="hidden" id="id_bayar_history" name="id_bayar">
                <input type="hidden" id="id_siswa" name="id_siswa">

                <div class="modal-header">
                    <h2 class="font-medium text-base">
                        Data Pembayaran
                    </h2>
                </div>

                <div class="modal-body">

                    <div class="grid grid-cols-12 gap-4">

                        <!-- Tanggal Bayar -->
                        <div class="col-span-12">
                            <label class="form-label">
                                Tanggal Bayar
                            </label>

                            <input
                                type="date"
                                id="tgl_bayar_history"
                                name="tgl_bayar"
                                class="form-control">
                        </div>

                        <!-- No Kwitansi -->
                        <div class="col-span-12">
                            <label class="form-label">
                                No Kwitansi
                            </label>

                            <input
                                type="text"
                                id="no_kwitansi_history"
                                name="no_kwitansi"
                                class="form-control"
                                placeholder="Masukkan nomor kwitansi">
                        </div>

                        <!-- Keterangan -->
                        <div class="col-span-12">
                            <label class="form-label">
                                Keterangan
                            </label>

                            <textarea
                                id="keterangan"
                                name="keterangan"
                                rows="3"
                                class="form-control"
                                placeholder="Masukkan keterangan"></textarea>
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
                        class="btn btn-primary"
                        onclick="saveHistoryBayar()">

                        <i data-lucide="save" class="w-4 h-4 mr-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>