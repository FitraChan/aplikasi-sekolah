<!-- Modal Import Soal -->
<div id="modal-import-soal" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                id="frm-import-soal"
                method="POST"
                enctype="multipart/form-data"
                action="{{ route('soalGuru.import') }}">

                @csrf

                <!-- Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Import Soal
                    </h2>
                </div>

                <!-- Body -->
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                    <!-- Mata Pelajaran -->
                    <div class="col-span-12">

                        <label class="form-label">
                            Mata Pelajaran
                        </label>

                        <select
                            name="mapel_id"
                            id="e_mapel_id_import"
                            class="form-select">

                            <option value="">Pilih Mata Pelajaran</option>

                            @foreach($mapel as $row)

                            <option value="{{ $row['id_mapel'] }}">
                                {{ $row['nama_mapel'] }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Download Template -->
                    <div class="col-span-12">

                        <a
                            href="{{ asset('public/template_soal.csv') }}"
                            target="_blank"
                            class="text-primary underline">

                            📥 Download Template CSV

                        </a>

                    </div>

                    <!-- Upload File -->
                    <div class="col-span-12">

                        <label class="form-label">
                            File CSV
                        </label>

                        <input
                            type="file"
                            name="filename"
                            id="file_soal"
                            class="form-control"
                            accept=".csv"
                            required>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer text-right">

                    <button
                        type="button"
                        data-tw-dismiss="modal"
                        class="btn btn-outline-secondary w-20 mr-2">

                        Batal

                    </button>

                    <button
                        type="submit"
                        id="btn-import-soal"
                        class="btn btn-primary w-32">

                        Import Soal

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>