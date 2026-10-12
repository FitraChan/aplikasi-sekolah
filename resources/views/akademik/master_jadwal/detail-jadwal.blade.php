<style>
    .ts-control {
        font-size: 16px !important;
    }

    .ts-dropdown .option {
        font-size: 16px !important;
        padding: 10px 12px !important;
    }
</style>
<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">
    <!-- Breadcrumb & Header Title -->
    <div class="mb-8" data-purpose="page-heading">
        <nav class="flex items-center gap-2 text-sm text-slate-500 font-medium mb-3">
            <a href="Dashboard_Data_Kelas.html" class="hover:text-slate-800 transition">Daftar Kelas</a>
            <span>›</span>
            <span class="text-slate-800">Penjadwalan</span>
        </nav>
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Penjadwalan</h1>
        <p class="text-sm text-slate-500 mt-1">Lengkapi informasi di bawah untuk penjadwalan kelas</p>
    </div>
    <!-- Navigation Tabs -->
    <div class="border-b border-slate-200 mb-6 flex gap-8 text-sm font-semibold" data-purpose="section-tabs">

        <a href="Dashboard_Data_Kelas_Penjadwalan_Data_Mapel.html" class="text-[#02BC9C] relative pb-2.5 border-b-2 border-[#02BC9C] font-bold">
            Data Mapel
        </a>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">

        {{-- Tahun Ajaran --}}
        <div>
            <label
                for="filter_tahun"
                class="mb-1.5 block text-xs font-semibold text-slate-600">
                Tahun Ajaran
            </label>

            <select
                id="filter_tahun_detail"
                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                <option value="">
                    Semua Tahun Ajaran
                </option>

                @foreach($tahun as $item)
                <option value="{{ $item->id }}">
                    {{ $item->thn_ajaran }}
                </option>
                @endforeach

            </select>
        </div>


        {{-- Jurusan --}}
        <div>
            <label
                for="filter_jurusan"
                class="mb-1.5 block text-xs font-semibold text-slate-600">
                Jurusan
            </label>

            <select
                id="filter_jurusan_detail"
                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                <option value="">
                    Semua Jurusan
                </option>

                @foreach($jurusan as $item)
                <option value="{{ $item->id }}">
                    {{ $item->nama_jurusan }}
                </option>
                @endforeach

            </select>
        </div>


        {{-- Kelas --}}
        <div>
            <label
                for="filter_kelas"
                class="mb-1.5 block text-xs font-semibold text-slate-600">
                Kelas
            </label>

            <select
                id="filter_kelas_detail"
                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                <option value="">
                    Semua Kelas
                </option>

                @foreach($kelas as $item)
                <option value="{{ $item->idx }}">
                    {{ $item->nama_kelas }}
                </option>
                @endforeach

            </select>
        </div>


        {{-- Semester --}}
        <div>
            <label
                for="filter_semester"
                class="mb-1.5 block text-xs font-semibold text-slate-600">
                Semester
            </label>

            <select
                id="filter_semester_detail"
                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                <option value="">
                    Semua Semester
                </option>

                <option value="1">
                    Ganjil
                </option>

                <option value="0">
                    Genap
                </option>

            </select>
        </div>

        <div>
    <label
        for="filter_nama_pelajaran_detail"
        class="mb-1.5 block text-xs font-semibold text-slate-600">
        Nama Pelajaran
    </label>

    <input
        type="text"
        id="filter_nama_pelajaran_detail"
        placeholder="Cari nama pelajaran..."
        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">
</div>


        {{-- Tombol Cari --}}
        <div class="flex items-end">
            <button
                type="button"
                onclick="loadDetailData()"
                class="w-full inline-flex items-center justify-center gap-2
                   rounded-xl
                   bg-[#02BC9C]
                   px-4 py-2.5
                   text-sm font-semibold text-white
                   shadow-sm
                   hover:bg-[#00AF8F]
                   transition">

                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />

                </svg>

                Cari
            </button>
        </div>


        {{-- Tombol Reset --}}
        <div class="flex items-end">
            <button
                type="button"
                onclick="resetFilterJadwal()"
                class="w-full inline-flex items-center justify-center gap-2
                   rounded-xl
                   border border-slate-300
                   bg-white
                   px-4 py-2.5
                   text-sm font-semibold text-slate-700
                   hover:bg-slate-50
                   transition">

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 4v5h5M20 20v-5h-5M5.5 9A7.5 7.5 0 0118 6.5M18.5 15A7.5 7.5 0 016 17.5" />

                </svg>

                Reset Filter
            </button>
        </div>

    </div>
    <!-- Schedule Management Container Card -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden flex flex-col" data-purpose="schedule-card-container">
        <div class="flex flex-1 min-h-[460px]">
            <!-- Day Selector Column -->
            <div class="w-44 border-r border-slate-200/80 shrink-0 select-none" data-purpose="day-sidebar">
                <!-- Senin (Active) -->
                <div id="tab-senin" onclick="switchDay('senin')" class="day-tab px-5 py-4 bg-[#f0f4f9] text-slate-900 font-bold text-sm flex items-center justify-between border-b border-slate-200/70 cursor-pointer transition">
                    <span class="text-lg font-semibold">Senin</span>
                    <span class="active-indicator w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
                <!-- Selasa -->
                <div id="tab-selasa" onclick="switchDay('selasa')" class="day-tab px-5 py-4 text-slate-700 font-medium text-sm flex items-center justify-between border-b border-slate-200/70 hover:bg-slate-50 cursor-pointer transition">
                    <span class="text-lg font-semibold">Selasa</span>
                    <span class="active-indicator hidden w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
                <!-- Rabu -->
                <div id="tab-rabu" onclick="switchDay('rabu')" class="day-tab px-5 py-4 text-slate-700 font-medium text-sm flex items-center justify-between border-b border-slate-200/70 hover:bg-slate-50 cursor-pointer transition">
                    <span class="text-lg font-semibold">Rabu</span>
                    <span class="active-indicator hidden w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
                <!-- Kamis -->
                <div id="tab-kamis" onclick="switchDay('kamis')" class="day-tab px-5 py-4 text-slate-700 font-medium text-sm flex items-center justify-between border-b border-slate-200/70 hover:bg-slate-50 cursor-pointer transition">
                    <span class="text-lg font-semibold">Kamis</span>
                    <span class="active-indicator hidden w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
                <!-- Jumat -->
                <div id="tab-jumat" onclick="switchDay('jumat')" class="day-tab px-5 py-4 text-slate-700 font-medium text-sm flex items-center justify-between border-b border-slate-200/70 hover:bg-slate-50 cursor-pointer transition">
                    <span class="text-lg font-semibold">Jumat</span>
                    <span class="active-indicator hidden w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
                <!-- Sabtu -->
                <div id="tab-sabtu" onclick="switchDay('sabtu')" class="day-tab px-5 py-4 text-slate-700 font-medium text-sm flex items-center justify-between border-b border-slate-200/70 hover:bg-slate-50 cursor-pointer transition">
                    <span class="text-lg font-semibold">Sabtu</span>
                    <span class="active-indicator hidden w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
                <!-- Minggu -->
                <div id="tab-minggu" onclick="switchDay('minggu')" class="day-tab px-5 py-4 text-slate-700 font-medium text-sm flex items-center justify-between hover:bg-slate-50 cursor-pointer transition">
                    <span class="text-lg font-semibold">Minggu</span>
                    <span class="active-indicator hidden w-2 h-2 rounded-full bg-blue-600 inline-block"></span>
                </div>
            </div>

            <!-- Schedule List Container for Selected Day -->

            <div class="flex-1" data-purpose="day-schedule-container">

                <!-- SENIN -->
                <div id="day-senin"
                    class="day-schedule divide-y divide-slate-100" data-id-hari="1">
                </div>

                <!-- SELASA -->
                <div id="day-selasa"
                    class="day-schedule divide-y divide-slate-100 hidden" data-id-hari="2">
                </div>

                <!-- RABU -->
                <div id="day-rabu"
                    class="day-schedule divide-y divide-slate-100 hidden" data-id-hari="3">
                </div>

                <!-- KAMIS -->
                <div id="day-kamis"
                    class="day-schedule divide-y divide-slate-100 hidden" data-id-hari="4">
                </div>

                <!-- JUMAT -->
                <div id="day-jumat"
                    class="day-schedule divide-y divide-slate-100 hidden" data-id-hari="5">
                </div>

                <!-- SABTU -->
                <div id="day-sabtu"
                    class="day-schedule divide-y divide-slate-100 hidden" data-id-hari="6">
                </div>

                <!-- MINGGU -->
                <div id="day-minggu"
                    class="day-schedule hidden flex-col items-center justify-center py-16 px-6 text-center min-h-[420px]" data-id-hari="7">
                </div>

            </div>


        </div>
        <!-- Bottom Action Bar within Card -->
        <div class="p-5 bg-white border-t border-slate-100 flex justify-end" data-purpose="card-footer-action">
            <button type="button" onclick="openMapelModal('add')" id="btn-tambah-jam" class="bg-[#1d5bd8] hover:bg-[#174ab8] text-white font-semibold text-sm px-5 py-2.5 rounded-xl flex items-center gap-2 shadow transition-all duration-150 active:scale-95 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Tambah Jam Pelajaran</span>
            </button>
        </div>
    </div>

    <div id="mapel-modal"
        class="fixed inset-0 z-50 hidden overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true">

        <!-- Backdrop -->
        <div id="mapel-modal-backdrop"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
            onclick="closeMapelModal()">
        </div>

        <!-- Modal -->



        <!-- FORM -->

        @include('akademik.master_jadwal.modal-detail-jadwal')


        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                loadDetailData();
            });
            const hariMap = {
                1: 'senin',
                2: 'selasa',
                3: 'rabu',
                4: 'kamis',
                5: 'jumat',
                6: 'sabtu',
                7: 'minggu'
            };

            async function loadDetailData() {

                const idTahun =
                    document.getElementById('filter_tahun_detail')?.value || '';

                const idKelas =
                    document.getElementById('filter_kelas_detail')?.value || '';

                const idJurusan =
                    document.getElementById('filter_jurusan_detail')?.value || '';

                const semester =
                    document.getElementById('filter_semester_detail')?.value ?? '';

                const namaPelajaran =
                    document.getElementById('filter_nama_pelajaran_detail')?.value.trim() || '';


                console.log({
                    id_tahun: idTahun,
                    id_kelas: idKelas,
                    id_jurusan: idJurusan,
                    semester: semester,
                    nama_pelajaran: namaPelajaran
                });


                const params =
                    new URLSearchParams();


                if (idTahun) {

                    params.append(
                        'id_tahun',
                        idTahun
                    );

                }


                if (idKelas) {

                    params.append(
                        'id_kelas',
                        idKelas
                    );

                }


                if (idJurusan) {

                    params.append(
                        'id_jurusan',
                        idJurusan
                    );

                }


                /*
                 * Semester Genap = 0
                 * Jadi jangan menggunakan:
                 *
                 * if (semester)
                 *
                 * karena nilai 0 akan dianggap false.
                 */

                if (semester !== '') {

                    params.append(
                        'semester',
                        semester
                    );

                }


                /*
                 * Filter nama pelajaran
                 */

                if (namaPelajaran !== '') {

                    params.append(
                        'nama_pelajaran',
                        namaPelajaran
                    );

                }


                try {

                    const response =
                        await fetch(
                            `{{ route('detail-jadwal.data') }}?${params.toString()}`, {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            }
                        );


                    if (!response.ok) {

                        throw new Error(
                            'Gagal mengambil data jadwal'
                        );

                    }


                    const data =
                        await response.json();


                    console.log(
                        'Data jadwal:',
                        data
                    );


                    renderSchedule(data);


                } catch (error) {

                    console.error(
                        'Gagal load jadwal:',
                        error
                    );

                }

            }


            function scheduleItem(item) {




                const jam = item.jam_awal && item.jam_akhir ?
                    `${item.jam_awal} – ${item.jam_akhir}` :
                    '-';

                return `
                    <div
                        class="p-6 flex items-center justify-between hover:bg-slate-50/50 transition"
                        data-id="${item.id}"
                        data-idpenjadwalan="${item.idpenjadwalan}"
                        data-id-hari="${item.id_hari}"
                        data-id-gtk="${item.id_gtk}"
                        data-id-mapel="${item.id_mapel}"
                        data-id-jam="${item.id_jam}"

                    >

                        <!-- MAPEL -->
                        <div class="w-48">
                            <div class="text-xs font-semibold text-slate-900 uppercase tracking-wider mb-1">
                                Jam ${item.jam_ke || '-'}
                            </div>

                            <div class="text-base font-bold text-slate-900">
                                ${escapeHtml(item.nama_mapel || '-')}
                            </div>
                        </div>

                        <!-- JAM -->
                        <div>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-semibold bg-slate-100 text-slate-800">
                                ${escapeHtml(jam)}
                            </span>
                        </div>

                        <!-- STATUS -->
                        <div>
                            <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-medium bg-[#e6f8f1] text-[#059669]">
                                Aktif
                            </span>
                        </div>

                        <!-- GURU / KELAS -->
                        <div class="w-60 text-right pr-4">

                            <div class="text-sm font-bold text-slate-800">
                                ${escapeHtml(item.nama_gtk || '-')}
                            </div>

                            <div class="text-sm text-slate-600 font-semibold mt-1">
                                ${escapeHtml(item.nama_kelas || '-')}
                            </div>

                        </div>

                        <!-- ACTION -->
                        <div class="flex items-center gap-3 text-slate-400">

                        <button
                                type="button"
                                onclick="editSlot(this)"
                                class="hover:text-[#02BC9C] text-slate-400 transition p-1 inline-block cursor-pointer"
                                title="Edit Mapel"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </button>
                        

                            <button
                                type="button"
                                onclick="deleteSlot(this)"
                                class="hover:text-red-500 transition p-1 cursor-pointer"
                                title="Hapus Mapel"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3M4 7h16"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </button>

                        </div>

                    </div>
                `;
            }


            function escapeHtml(value) {

                if (value === null || value === undefined) {
                    return '';
                }

                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function emptySchedule() {

                return `
                <div class="flex flex-col items-center justify-center py-16 px-6 text-center min-h-[420px]">

                    <div class="w-16 h-16 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center mb-4 border border-slate-200">

                        <svg
                            class="w-8 h-8"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                            />
                        </svg>

                    </div>

                    <h4 class="text-base font-bold text-slate-800 mb-1">
                        Tidak Ada Jadwal
                    </h4>

                    <p class="text-xs text-slate-500 max-w-md leading-relaxed">
                        Belum ada mata pelajaran yang dijadwalkan pada hari ini.
                    </p>

                </div>
            `;
            }



            function renderSchedule(data) {


                Object.values(hariMap).forEach(day => {

                    const container = document.getElementById(`day-${day}`);

                    if (container) {
                        container.innerHTML = '';
                    }

                });

                data.forEach(item => {

                    const dayName = hariMap[item.id_hari];

                    if (!dayName) return;

                    const container = document.getElementById(`day-${dayName}`);

                    if (!container) return;

                    container.insertAdjacentHTML(
                        'beforeend',
                        scheduleItem(item)
                    );

                });

                // Hari yang tidak mempunyai data
                Object.values(hariMap).forEach(day => {

                    const container = document.getElementById(`day-${day}`);

                    if (
                        container &&
                        container.innerHTML.trim() === ''
                    ) {
                        container.innerHTML = emptySchedule();
                    }

                });
            }



            window.currentEditingSlot = null;

            function openMapelModal(mode = 'add', data = null) {
                const modal = document.getElementById('mapel-modal');
                if (!modal) return;

                const urutanJamSelect = document.getElementById('modal-urutan-jam');

                const mapelSelect = document.getElementById('modal-mapel');
                const pengajarSelect = document.getElementById('modal-pengajar');

                console.log('data', data);


                if (mode === 'edit' && data) {

                    // Simpan data slot yang sedang diedit
                    currentEditingSlot = {
                        id: data.id,
                        idGtk: data.idGtk,
                        idHari: data.idHari,
                        idJam: data.idJam,
                        idMapel: data.idMapel,
                        idPenjadwalan: data.idPenjadwalan,
                        mode: 'edit'
                    };
                    // Isi select
                    setSelectValue(urutanJamSelect, data.idJam);

                    setSelectValue(mapelSelect, data.id);
                    setSelectValue(pengajarSelect, data.idGtk);

                } else {

                    const activeDayContainer =
                        document.querySelector('.day-schedule:not(.hidden)');

                    const idHari =
                        activeDayContainer?.dataset.idHari || '';

                    console.log('ID HARI:', idHari);


                    currentEditingSlot = {

                        mode: 'tambah',

                        idHari: idHari
                    };

                }

                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function setSelectValue(select, value) {
                if (!select || value === null || value === undefined || value === '') {
                    return;
                }

                const val = String(value).trim();

                // Jika menggunakan Tom Select
                if (select.tomselect) {
                    const ts = select.tomselect;

                    // Pastikan option tersedia
                    if (ts.options[val]) {
                        ts.setValue(val, true);



                        return;
                    }

                    console.warn(
                        'Value TomSelect tidak ditemukan:',
                        val,
                        select.id
                    );

                    return;
                }

                // Select biasa
                const option = Array.from(select.options).find(
                    option => String(option.value).trim() === val
                );

                if (option) {
                    select.value = option.value;



                    return;
                }

                console.warn(
                    'Value tidak ditemukan:',
                    val,
                    select.id
                );
            }

            function closeMapelModal() {
                const modal = document.getElementById('mapel-modal');
                if (!modal) return;
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                currentEditingSlot = null;
            }

            function editSlot(btn) {
                const slot = btn.closest('.p-6');
                if (!slot) return;
                currentEditingSlot = slot;

                const w48 = slot.querySelector('.w-48');
                const w60 = slot.querySelector('.w-60');
                const timeSpan = slot.querySelector('.bg-slate-100');

                const idHari = slot.dataset.idHari || '';


                openMapelModal('edit', {

                    idHari: slot.dataset.idHari,

                });
            }



            async function reloadSchedule() {

                try {

                    const response = await fetch(
                        "{{ route('detail-jadwal.data') }}", {
                            headers: {
                                'Accept': 'application/json'
                            }
                        }
                    );

                    const result = await response.json();

                    renderSchedule(result);

                } catch (error) {

                    console.error(
                        'Gagal reload schedule:',
                        error
                    );

                    showToast(
                        error.message ||
                        'Gagal memuat ulang jadwal.',
                        'error'
                    );
                }
            }

            function showToast(message) {
                let toast = document.getElementById('mapel-toast');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'mapel-toast';
                    toast.className = 'fixed bottom-5 right-5 z-50 bg-emerald-600 text-white text-sm font-medium px-5 py-3 rounded-xl shadow-lg flex items-center gap-2 transform transition-all duration-300 translate-y-20 opacity-0 pointer-events-none';
                    document.body.appendChild(toast);
                }
                toast.innerHTML = `
                        <svg class="w-5 h-5 text-white shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>${message}</span>
                        `;
                toast.classList.remove('translate-y-20', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
                setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-20', 'opacity-0');
                }, 3000);
            }

            function switchDay(day) {
                const days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                days.forEach(d => {
                    const tab = document.getElementById(`tab-${d}`);
                    const content = document.getElementById(`day-${d}`);
                    const indicator = tab ? tab.querySelector('.active-indicator') : null;
                    if (d === day) {
                        if (tab) {
                            tab.classList.remove('text-slate-700', 'font-medium');
                            tab.classList.add('bg-[#f0f4f9]', 'text-slate-900', 'font-bold');
                        }
                        if (indicator) indicator.classList.remove('hidden');
                        if (content) content.classList.remove('hidden');
                    } else {
                        if (tab) {
                            tab.classList.remove('bg-[#f0f4f9]', 'text-slate-900', 'font-bold');
                            tab.classList.add('text-slate-700', 'font-medium');
                        }
                        if (indicator) indicator.classList.add('hidden');
                        if (content) content.classList.add('hidden');
                    }
                });

                const addBtn = document.getElementById('btn-tambah-jam');
                if (addBtn) {
                    if (day === 'minggu') {
                        addBtn.classList.add('opacity-50', 'pointer-events-none');
                        addBtn.setAttribute('tabindex', '-1');
                    } else {
                        addBtn.classList.remove('opacity-50', 'pointer-events-none');
                        addBtn.removeAttribute('tabindex');
                    }
                }
            }

            function deleteSlot(btn) {
                if (confirm('Apakah Anda yakin ingin menghapus jam pelajaran ini?')) {
                    const slot = btn.closest('.p-6');
                    if (slot) {
                        slot.style.transition = 'all 0.2s ease-out';
                        slot.style.opacity = '0';
                        slot.style.transform = 'scale(0.98)';
                        setTimeout(() => slot.remove(), 200);
                    }
                }
            }
        </script>
</main>