<div class="intro-y box mt-5">
    <div class="p-5">

        @foreach($soals as $index => $soal)

        <div class="border rounded-md p-5 mb-5">

            <div class="flex items-center">
                <h5 class="font-medium text-base">
                    No. {{ $index + 1 }}
                </h5>

                <div class="ml-auto flex gap-2">
                    <a href="javascript:void(0)"
                        class="btn btn-sm btn-outline-primary"
                        onclick="editSoal({{ $soal['soal_id'] }})">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </a>

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-danger btn-hapus"
                        onclick="deleteSoal({{ $soal['id'] }})">

                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-success btn-update-up"
                        data-id="{{ $soal['id'] }}">
                        <i data-lucide="arrow-up" class="w-4 h-4"></i>
                    </button>

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-success btn-update-down"
                        data-id="{{ $soal['id'] }}">
                        <i data-lucide="arrow-down" class="w-4 h-4"></i>
                    </button>

                </div>

            </div>

            <div class="mb-3">
                {!! $soal['soal'] !!}
            </div>

            @if($soal['jenis_soal_id'] == 1)

            <ol style="list-style-type: upper-alpha; padding-left:25px;">
                <li>{!! $soal['jawaban_a'] !!}</li>
                <li>{!! $soal['jawaban_b'] !!}</li>
                <li>{!! $soal['jawaban_c'] !!}</li>
                <li>{!! $soal['jawaban_d'] !!}</li>

                @if(!empty($soal['jawaban_e']))
                <li>{!! $soal['jawaban_e'] !!}</li>
                @endif

            </ol>

            @endif

            <div class="mt-4">
                <span class="font-medium text-success">
                    Jawaban Benar :
                    {{ $soal['jawaban_benar'] }}
                </span>
            </div>

        </div>

        @endforeach

    </div>
</div>



<script>
    async function editSoal(id) {

        try {

            document.getElementById("form_mode").value = "edit";

            document.querySelector("#modal-add-ujian .modal-header h2").innerHTML =
                "Edit Soal";

            const response = await fetch("{{ url('pbm/cariSoal') }}/" + id);

            if (!response.ok) {
                throw new Error("Gagal mengambil data");
            }

            const res = await response.json();
            console.log(res);

            const row = res.row || {};

            // ======================
            // INPUT
            // ======================
            document.getElementById("e_id").value = row.id ?? '';
            document.getElementById("e_judul_soal").value = row.judul_soal ?? '';
            document.getElementById("e_smt").value = row.smt ?? '';

            document.getElementById("e_jawaban_a").value = row.jawaban_a ?? '';
            document.getElementById("e_jawaban_b").value = row.jawaban_b ?? '';
            document.getElementById("e_jawaban_c").value = row.jawaban_c ?? '';
            document.getElementById("e_jawaban_d").value = row.jawaban_d ?? '';
            document.getElementById("e_jawaban_e").value = row.jawaban_e ?? '';

            document.getElementById("e_jawaban_benar").value = row.jawaban_benar ?? '';

            // ======================
            // CKEDITOR
            // ======================
            CKEDITOR.instances.e_editor.setData(row.soal ?? '');

            // ======================
            // JENIS SOAL
            // ======================
            const jenis = document.getElementById("e_jenis_soal_id");
            jenis.innerHTML = '<option value="">Pilih Jenis Soal</option>';

            res.jenis_soal.forEach(item => {

                jenis.innerHTML += `
                <option value="${item.id}"
                    ${item.id == row.jenis_soal_id ? 'selected' : ''}>
                    ${item.jenis_soal}
                </option>
            `;

            });

            // ======================
            // MAPEL
            // ======================
            const mapel = document.getElementById("e_mapel_id");
            mapel.innerHTML = '<option value="">Pilih Mapel</option>';

            res.mapel.forEach(item => {

                mapel.innerHTML += `
                <option value="${item.id_mapel}"
                    ${item.id_mapel == row.mapel_id ? 'selected' : ''}>
                    ${item.mapel.nama_mapel}
                </option>
            `;

            });

            // ======================
            // PREVIEW GAMBAR
            // ======================
            // const preview = document.getElementById("preview_soal");

            // if (row.url_soal) {
            //     preview.src = "{{ asset('storage') }}/" + row.url_soal;
            //     preview.style.display = "block";
            // } else {
            //     preview.src = "";
            //     preview.style.display = "none";
            // }

            // ======================
            // MODAL
            // ======================
            const modal = tailwind.Modal.getOrCreateInstance(
                document.getElementById("modal-add-ujian")
            );

            modal.show();

        } catch (err) {

            console.error(err);
            alert("Gagal mengambil data");

        }

    }

    async function deleteSoal(id) {

        const result = await Swal.fire({
            title: 'Hapus Soal?',
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d'
        });

        if (!result.isConfirmed) {
            return;
        }
        console.log('delete',id);

        const formData = new FormData();
        formData.append("id", id);

        

        try {

            const response = await fetch("{{ route('pbm.deleteDetUjian') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: formData
            });

            const res = await response.json();

            if (response.ok && res.success) {

                await Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                location.reload();

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: res.message ?? 'Gagal menghapus data.'
                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan pada server.'
            });

        }

    }
</script>