<div id="modal-bulanan-all-siswa" class="modal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base">
                    Generate Tagihan Bulanan
                </h2>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">
                        Tahun Angkatan
                    </label>

                    <select
                        id="id_thn_ajaran"
                        class="form-select">

                        <option value="">
                            Pilih Tahun Angkatan
                        </option>

                        @foreach($tahun as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->thn_ajaran }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="id_jurusan"
                        class="form-select">

                        <option value="">
                            Pilih Jurusan
                        </option>

                         <option value="all_jurusan">
                            Semua Jurusan
                        </option>

                        @foreach($jurusan as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->nama_jurusan }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Tahun Pembayaran
                    </label>

                   <input
                    type="number"
                    id="id_tahun"
                    name="id_tahun"
                    class="form-control"
                    placeholder="Masukkan Tahun"
                    min="1000"
                    max="9999"
                    required
                    oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4)">
                                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Bulan
                    </label>

                    <select
                        id="id_bulan"
                        class="form-select">

                           <option value="all_bulan">
                            Semua Bulan
                        </option>

                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>

                    </select>
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
                    onclick="saveDefBulan()"
                    id="btn-save-def-bulan"
                    class="btn btn-primary">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>