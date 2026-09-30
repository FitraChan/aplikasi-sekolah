<div id="modal-tambah-form" class="modal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form id="form-item">

                <input type="hidden" id="id_bayar" name="id_bayar">
                <input type="hidden" id="id_detail" name="id_detail">

                <div class="modal-header">
                    <h2 class="font-medium text-base">
                        Item Pembayaran
                    </h2>
                </div>

                <div class="modal-body">

                    <div class="grid grid-cols-12 gap-4">

                        <!-- Item Bayar -->
                        <div class="col-span-12">
                            <label class="form-label">
                                Item Pembayaran
                            </label>
                             <select
                                id="id_item"
                                name="id_item"
                                class="form-control">

                                <option value="">Pilih Item Pembayaran</option>
                                @foreach ($itemBayar as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kewajiban -->
                        <div class="col-span-12 md:col-span-4">
                            <label class="form-label">
                                Kewajiban Bayar
                            </label>

                            <input
                                type="number"
                                id="kwajiban_bayar"
                                name="kwajiban_bayar"
                                class="form-control"
                                placeholder="Jumlah">
                        </div>

                        <!-- Jumlah Bayar -->
                        <div class="col-span-12 md:col-span-4">
                            <label class="form-label">
                                Jumlah Bayar
                            </label>

                            <input
                                type="number"
                                id="jml_bayar"
                                name="jml_bayar"
                                class="form-control"
                                placeholder="Jumlah">
                        </div>

                        <!-- Potongan -->
                        <div class="col-span-12 md:col-span-4">
                            <label class="form-label">
                                Potongan
                            </label>

                            <input
                                type="number"
                                id="potongan"
                                name="potongan"
                                class="form-control"
                                placeholder="Potongan">
                        </div>

                        <!-- Cicilan -->
                        <div class="col-span-12 md:col-span-3">
                            <label class="form-label">
                                Cicilan Ke
                            </label>

                            <input
                                type="number"
                                id="id_cicilan"
                                name="id_cicilan"
                                class="form-control"
                                placeholder="Cicilan">
                        </div>

                        <!-- Keterangan -->
                        <div class="col-span-12 md:col-span-9">
                            <label class="form-label">
                                Keterangan
                            </label>

                            <input
                                type="text"
                                id="keterangan"
                                name="keterangan"
                                class="form-control"
                                placeholder="Masukkan keterangan">
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
                        onclick="saveItemBayar()">

                        <i data-lucide="save" class="w-4 h-4 mr-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>