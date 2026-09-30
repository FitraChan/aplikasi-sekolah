<div id="modal-detail-form" class="modal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <input type="hidden" id="id_detail">

            <div class="modal-header">
                <h2 class="font-medium text-base">
                    Detail Template Bayar
                </h2>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Item Bayar</label>

                    <select
                        id="id_item"
                        class="form-select">

                        <option value="">
                            -- Pilih Item Bayar --
                        </option>

                        @foreach($itemBayar as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->nama_item }}
                            </option>
                        @endforeach

                    </select>
                </div>

               

                <div class="mb-3">
                    <label>Jumlah Bayar</label>

                    <input
                        type="number"
                        id="jml_bayar"
                        class="form-control"
                        placeholder="Masukkan jumlah bayar">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>

                    <textarea
                        id="ket_bayar"
                        class="form-control"
                        rows="3"
                        placeholder="Masukkan keterangan"></textarea>
                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="saveDetail()">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>