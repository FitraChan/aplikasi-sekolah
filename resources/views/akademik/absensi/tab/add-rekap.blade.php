<div id="modalPertemuan" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Tambah Pertemuan
                </h2>
            </div>

            <form id="form1" method="post">

                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                    <div class="col-span-12 sm:col-span-6">
                        <label class="form-label">Pertemuan Ke</label>
                        <input type="number"
                               name="idpertemuan"
                               class="form-control">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date"
                               id="tgl_pbm"
                               name="tgl_pbm"
                               class="form-control">
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Materi Pembelajaran</label>
                        <textarea
                            name="materi"
                            rows="4"
                            class="form-control"></textarea>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Guru Pengganti</label>

                        <select
                            id="guru_pengganti"
                            name="guru_pengganti"
                            class="tom-select w-full">

                            <option value="">Pilih Guru</option>

                            @foreach($guru as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_gtk }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-span-12">
                        <label class="form-label">Keterangan</label>
                        <textarea
                            name="keterangan"
                            rows="4"
                            class="form-control"></textarea>
                    </div>

                  

                </div>

                <div class="modal-footer">
                    <button type="button"
                            data-tw-dismiss="modal"
                            class="btn btn-outline-secondary w-20 mr-1">
                        Batal
                    </button>

                    <button
                    type="button"
                    onclick="simpanData()"
                    class="btn btn-primary w-24">

                    Simpan

                </button>
                </div>

            </form>

        </div>
    </div>
</div>