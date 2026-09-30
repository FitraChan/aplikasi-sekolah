<div id="modal-add-kelas" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form action="{{ url('calon-siswa/ipaymu') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Pembayaran iPaymu
                    </h2>
                </div>

                <div class="modal-body grid grid-cols-12 gap-4">

                    <section id="loading" class="col-span-12 hidden">
                        <div id="loading-content"></div>
                    </section>

                    <!-- NIM -->
                

                    <!-- Tanggal -->
                    <div class="col-span-6">
                        <label class="form-label">
                            Tanggal Transaksi
                        </label>

                        <input
                            type="datetime-local"
                            name="tgl_trans"
                            class="form-control"
                            value="{{ now()->format('Y-m-d\TH:i') }}">
                    </div>

                    <!-- Item -->
                    <div class="col-span-6">
                        <label class="form-label">
                            Item Pembayaran
                        </label>

                         <select
                                name="item"
                                class="form-select"
                                required>

                                <option value="">
                                    -- Pilih Item --
                                </option>

                                @foreach($itemBayar as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        {{ old('item') == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_item }}

                                    </option>
                                @endforeach

                            </select>
                    </div>

                    <!-- Nominal -->
                    <div class="col-span-6">
                        <label class="form-label">
                            Nominal Pembayaran
                        </label>

                        <input
                            type="text"
                            name="nominal"
                            id="currency-field"
                            class="form-control"
                            data-type="currency">
                    </div>

                    <!-- Keterangan -->
                    <div class="col-span-12">
                        <label class="form-label">
                            Keterangan
                        </label>

                        <input
                            type="text"
                            name="comments"
                            class="form-control"
                            placeholder="Masukkan keterangan">
                    </div>

                </div>

                <div class="modal-footer text-right">

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