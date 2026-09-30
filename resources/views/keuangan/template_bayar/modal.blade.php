<div id="modal-form" class="modal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <input type="hidden" id="id">

            <div class="modal-header">
                <h2 class="font-medium text-base">
                    Template Bayar
                </h2>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Tahun Ajaran</label>

                    <select
                        id="id_tahun"
                        class="form-select"
                    >
                        @foreach($tahun as $itemTahun)
                            <option value="{{ $itemTahun->id ?? 0 }}">
                                {{ $itemTahun->thn_ajaran  ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Pilihan Jurusan</label>

                    <select
                        id="tipe_jurusan"
                        class="form-select"
                        onchange="toggleJurusan()"
                    >
                        <option value="semua">
                            Semua Jurusan
                        </option>

                        <option value="perjurusan">
                            Pilih Per Jurusan
                        </option>
                    </select>
                </div>

                <div
                    id="field-jurusan"
                    class="mb-3 hidden"
                >
                    <label>Jurusan</label>

                    <select
                        id="id_jurusan"
                        class="form-select"
                    >
                        <option value="">
                            Pilih Jurusan
                        </option>

                        @foreach($jurusan as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Gelombang</label>

                    <select
                        id="id_gelombang"
                        class="form-select"
                    >
                        @foreach($gelombang as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->nama_gelombang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelas</label>

                    <select
                        id="jns_kelas"
                        class="form-select"
                    >
                        <option value="1">
                            Reguler
                        </option>

                        <option value="2">
                            Karyawan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>

                    <input
                        type="text"
                        id="keterangan"
                        class="form-control"
                    >
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select
                        id="sts"
                        class="form-select"
                    >
                        <option value="1">
                            Aktif
                        </option>

                        <option value="0">
                            Tidak Aktif
                        </option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    onclick="saveData()"
                    class="btn btn-primary"
                >
                    Simpan
                </button>

            </div>

        </div>

    </div>

</div>

<script>
    function toggleJurusan()
    {
        const tipeJurusan = document
            .getElementById('tipe_jurusan')
            .value;

        const fieldJurusan = document
            .getElementById('field-jurusan');

        const idJurusan = document
            .getElementById('id_jurusan');

        if (tipeJurusan === 'semua') {
            fieldJurusan.classList.add('hidden');

            idJurusan.value = '';
            idJurusan.removeAttribute('required');
        } else {
            fieldJurusan.classList.remove('hidden');

            idJurusan.setAttribute('required', 'required');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleJurusan();
    });
</script>