<div id="modal-form" class="modal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <input type="hidden" id="id">

            <div class="modal-header">
                <h2 class="font-medium text-base">
                    Item Bayar
                </h2>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Nama Item</label>
                    <input type="text"
                           id="nama_item"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Kategori</label>

                    <select
                        id="id_kategori"
                        class="form-select">

                        @foreach($kategori as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->nama_kategori }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Periode</label>

                    <select
                        id="id_kat_periode"
                        class="form-select">

                        @foreach($periode as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->nama_kategori }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Default Value</label>

                    <input
                        type="number"
                        id="def_value"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>

                    <textarea
                        id="keterangan"
                        class="form-control"></textarea>
                </div>

            </div>

            <div class="modal-footer">

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