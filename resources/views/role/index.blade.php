@extends('layout.main')

@section('tittle')
Dashboard
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Dashboard</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">
    <!-- Bagian Tombol Aksi -->
    <div class="flex gap-2 mb-3">
        <button class="btn btn-primary" data-tw-toggle="modal" data-tw-target="#modal-add-role">
            + Tambah Role
        </button>
        <button class="btn btn-primary" data-tw-toggle="modal" data-tw-target="#modal-add-user">
            + Tambah User
        </button>
    </div>

    <!-- Sistem Grid untuk membagi tabel menjadi sebelah-menyebelah -->
    <!-- md:grid-cols-3 artinya membagi halaman menjadi 3 kolom saat layar komputer/tablet -->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- Kolom Kiri: Tempat Table User (Kita beri porsi lebih besar, mengambil 2 kolom) -->
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> Daftar User</h2>

                </div>

                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div id="table-user"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Tempat Table Role (Mengambil 1 kolom saja karena biasanya isinya lebih sedikit) -->
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> Daftar Role</h2>

                </div>

                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div id="table-role"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



{{-- Memanggil komponen modal dari folder terpisah --}}
@include('role.modals.add-role')
@include('role.modals.add-user')
@include('role.modals.edit-user')

<!-- MODAL DI LUAR BOX -->

<script>
    var table = new Tabulator("#table-user", {
        ajaxURL: "{{ route('role.data') }}",
        layout: "fitColumns",
        pagination: true,
        paginationSize: 10,
        movableColumns: true,
        columns: [
            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 80,
            },

            {
                title: "Nama",
                field: "name"
            },

            {
                title: "Email",
                field: "email"
            },

            {
                title: "Role",
                field: "role"
            },

            {
                title: "Aksi",
                field: "action",
                hozAlign: "left",
                formatter: function(cell) {
                    let row = cell.getData();
                    return `
                            <a href="javascript:;"
                            data-tw-toggle="modal"
                            data-tw-target="#modal-edit-user"
                            onclick="editUser(
                                    ${row.id}               
                            )"
                            class="btn btn-primary">
                                Edit User
                            </a>
                        `;

                }
            },
        ],
    });


    var tableRole = new Tabulator("#table-role", {
    // Silakan sesuaikan nama route Laravel Anda untuk mengambil data khusus role
    ajaxURL: "{{ route('role.dataRole') }}", 
    layout: "fitColumns",
    pagination: true,
    paginationSize: 10,
    movableColumns: true,
    columns: [
        {
            title: "No",
            formatter: "rownum",
            hozAlign: "center",
            width: 60, // Sedikit diperkecil agar hemat ruang di kolom kanan
        },

        {
            title: "Id",
            field: "id", // Mengambil data id role
            width: 60, // Sedikit diperkecil agar hemat ruang di kolom kanan
        },
        {
            title: "Nama Role",
            field: "name" // Mengambil data nama role (misal: admin, guru, bendahara)
        },
        {
            title: "Aksi",
            field: "action",
            hozAlign: "center",
            width: 120,
            formatter: function(cell) {
                let row = cell.getData();
                return `
                    <a href="javascript:;"
                       data-tw-toggle="modal"
                       data-tw-target="#modal-edit-role"
                       onclick="deleteRole(${row.id})"
                       class="btn btn-danger btn-sm text-white">
                        Delete
                    </a>
                `;
            }
        },
    ],
});

function deleteRole(id) {
    // Tampilkan konfirmasi browser sebelum menghapus
    if (confirm("Apakah Anda yakin ingin menghapus role ini?")) {
        // Ambil CSRF Token Laravel untuk keamanan
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Jalankan AJAX dengan method DELETE (atau POST jika route Anda menggunakan POST)
        fetch(`{{ url('role/deleteRole') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menghapus role');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message);
               // location.reload(); // Reload halaman untuk memperbarui tabel

                               tableRole.replaceData();

            } else {
                alert('Gagal menghapus: ' + (data.message || 'Terjadi kesalahan'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data.');
        });
    }
}

    function editRole(id, name, role) {

        document.getElementById('user_id').value = id;
        document.getElementById('name').value = name;

        let select = document.getElementById('role');

        for (let i = 0; i < select.options.length; i++) {

            if (select.options[i].value === role) {
                select.selectedIndex = i;
            }
        }

        document
            .getElementById('warning-modal-preview')
            .classList.remove('hidden');
    }

    function closeModal() {
        document
            .getElementById('warning-modal-preview')
            .classList.add('hidden');
    }

    function updateRole() {
        let id = document.getElementById('user_id').value;
        let role = document.getElementById('role').value;

        fetch("{{ url('role/update') }}/" + id, {
            

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({
                    role: role
                })

            })

            .then(response => response.json())

            .then(data => {

                alert(data.message);

                closeModal();

                table.replaceData();

            });

    }

    function addRole() {
        let name = document.getElementById('role_name').value;

        fetch("{{ url('role/store') }}", {

                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name
                })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);

                document
                    .getElementById('modal-add-role')
                    .classList.add('hidden');

                table.replaceData();



            });
    }

    function addUser() {
        let name = document.getElementById('new_user_name').value;
        let email = document.getElementById('new_user_email').value;
        let password = document.getElementById('new_user_password').value;
        let role = document.getElementById('new_user_role').value;

        // Proteksi validasi sederhana di front-end sebelum dikirim
        if (!name || !email || !password || !role) {
            alert('Semua bidang isian wajib diisi!');
            return;
        }

        fetch("{{ url('role/storeUser') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name,
                    email,
                    password,
                    role
                })
            })
            .then(res => {
                if (!res.ok) {
                    // Jika ada error validasi dari Laravel (misal email kembar)
                    return res.json().then(err => {
                        throw err;
                    });
                }
                return res.json();
            })
            .then(data => {
                alert(data.message);

                // Reset form input setelah sukses
                document.getElementById('new_user_name').value = '';
                document.getElementById('new_user_email').value = '';
                document.getElementById('new_user_password').value = '';
                document.getElementById('new_user_role').value = '';

                // Tutup modal secara otomatis
                document.querySelector('#modal-add-user [data-tw-dismiss="modal"]').click();

                // Refresh tabel Tabulator agar user baru langsung muncul
                table.replaceData();
            })
            .catch(err => {
                // Menampilkan pesan error validasi spesifik jika ada
                if (err.errors) {
                    alert(Object.values(err.errors).flat().join('\n'));
                } else {
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });
    }

    // 1. Fungsi untuk mengambil data user lama & menampilkan ke modal
    function editUser(id) {
        // Jalankan AJAX untuk mengambil data user berdasarkan ID
        fetch(`{{ url('role/editUser') }}/${id}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal mengambil data user');
                return response.json();
            })
            .then(data => {
                // Isikan data yang didapat dari server ke dalam input modal edit
                document.getElementById('edit_user_id').value = data.id;
                document.getElementById('edit_user_name').value = data.name;
                document.getElementById('edit_user_email').value = data.email;
                document.getElementById('edit_user_role').value = data.role; // sesuaikan jika format data role berbeda

                // Kosongkan field password karena ini proses edit (opsional)
                document.getElementById('edit_user_password').value = '';

                const el = document.querySelector("#modal-edit-user");
            
            // Periksa jika template Anda menggunakan global helper 'tailwind'
            if (typeof tailwind !== 'undefined' && tailwind.Modal) {
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            } else {
                // Alternatif jika library dipanggil langsung sebagai kelas (tergantung versi template Anda)
                // const modal = new Modal(el);
                // modal.show();
                
                // Jika template Anda murni manipulasi class CSS utility tanpa JS instance:
                el.classList.add("show");
                el.style.marginTop = "0px";
                el.style.marginLeft = "0px";
                el.style.paddingLeft = "0px";
                el.style.zIndex = "10000";
            }

                // Tampilkan modal edit user
                // Catatan: Sesuaikan baris di bawah ini dengan library modal yang Anda gunakan (misal: Tailwind Elements/Flowbite/Bukan/dll)
                // Contoh jika menggunakan Flowbite/Tailwind biasa (toggle class):
                // document.getElementById('modal-edit-user').classList.add('show');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data user.');
            });
    }

    // 2. Fungsi untuk mengirimkan perubahan data (Update) ke server
    function updateUser() {
        // Ambil data dari input modal
        const id = document.getElementById('edit_user_id').value;
        const name = document.getElementById('edit_user_name').value;
        const email = document.getElementById('edit_user_email').value;
        const password = document.getElementById('edit_user_password').value;
        const role = document.getElementById('edit_user_role').value;

        // Ambil CSRF Token (Wajib di Laravel untuk keamanan POST/PUT)
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Validasi sederhana sebelum dikirim
        if (!name || !email || !role) {
            alert('Nama, Email, dan Role wajib diisi!');
            return;
        }

        // Jalankan AJAX untuk update data
        fetch(`{{ url('role/updateUser') }}/${id}`, {
                method: 'POST', // Menggunakan method POST untuk update data
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    password: password, // Biarkan kosong jika tidak diisi di modal
                    role: role
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User berhasil diperbarui!');
                        const modal = tailwind.Modal.getOrCreateInstance(
                            document.querySelector("#modal-edit-user")
                        );
                    modal.hide();

                                    table.replaceData();


                   // location.reload(); // Reload halaman untuk melihat perubahan di tabel
                } else {
                    alert('Gagal memperbarui user: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui data.');
            });
    }
</script>

@endsection