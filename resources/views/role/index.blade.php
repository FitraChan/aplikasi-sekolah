@extends('layout.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full space-y-6 min-w-0">

    {{-- =========================================================
        HEADER
    ========================================================= --}}
    <section>
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola user dan role yang tersedia dalam sistem.
            </p>
        </div>

        {{-- =====================================================
            TOMBOL AKSI
        ===================================================== --}}
        <div class="flex flex-wrap gap-3">

            {{-- Tambah Role --}}
            <button
                type="button"
                onclick="openModalAddRole()"
                class="inline-flex items-center gap-2 px-4 py-2.5
                       rounded-lg
                       bg-[#02BC9C] hover:bg-[#00B686]
                       text-white text-sm font-medium
                       shadow-sm
                       transition-colors">

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4v16m8-8H4"/>
                </svg>

                Tambah Role
            </button>


            {{-- Tambah User --}}
            <button
                type="button"
                onclick="openModalAddUser()"
                class="inline-flex items-center gap-2 px-4 py-2.5
                       rounded-lg
                       bg-emerald-600 hover:bg-emerald-700
                       text-white text-sm font-medium
                       shadow-sm
                       transition-colors">

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 8v6m3-3h-6"/>
                </svg>

                Tambah User
            </button>

        </div>
    </section>


    {{-- =========================================================
        GRID USER & ROLE
    ========================================================= --}}
    <section>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


            {{-- =================================================
                DAFTAR USER
            ================================================= --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200">

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            Daftar User
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Daftar pengguna yang terdaftar dalam sistem.
                        </p>
                    </div>

                </div>


                {{-- Table --}}
                <div class="p-5">

                    <div class="overflow-x-auto">
                        <div id="table-user"></div>
                    </div>

                </div>

            </div>


            {{-- =================================================
                DAFTAR ROLE
            ================================================= --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200">

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            Daftar Role
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Role yang tersedia dalam sistem.
                        </p>
                    </div>

                </div>


                {{-- Table --}}
                <div class="p-5">

                    <div class="overflow-x-auto">
                        <div id="table-role"></div>
                    </div>

                </div>

            </div>

        </div>

    </section>

</main>


{{-- =============================================================
    MODAL
============================================================= --}}
@include('role.modals.add-role')
@include('role.modals.add-user')
@include('role.modals.edit-user')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    /* =========================================================
       TABLE USER
    ========================================================= */

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
                width: 60,
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
                hozAlign: "center",
                width: 100,

                formatter: function(cell) {

                    let row = cell.getData();

                    return `
                        <button
                            type="button"
                            onclick="editUser(${row.id})"
                            class="inline-flex items-center justify-center
                                   px-3 py-1.5
                                   rounded-lg
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-xs font-medium
                                   transition-colors">

                            Edit

                        </button>
                    `;
                }
            },

        ],
    });



    /* =========================================================
       TABLE ROLE
    ========================================================= */

    var tableRole = new Tabulator("#table-role", {

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
                width: 60,
            },

            {
                title: "ID",
                field: "id",
                width: 60,
            },

            {
                title: "Nama Role",
                field: "name"
            },

            {
                title: "Aksi",
                field: "action",
                hozAlign: "center",
                width: 100,

                formatter: function(cell) {

                    let row = cell.getData();

                    return `
                        <button
                            type="button"
                            onclick="deleteRole(${row.id})"
                            class="inline-flex items-center justify-center
                                   px-3 py-1.5
                                   rounded-lg
                                   bg-red-600 hover:bg-red-700
                                   text-white text-xs font-medium
                                   transition-colors">

                            Delete

                        </button>
                    `;
                }
            },

        ],
    });



    /* =========================================================
       MODAL TAMBAH ROLE
    ========================================================= */

    function openModalAddRole() {

        const modal = document.getElementById('modal-add-role');

        if (!modal) {
            console.error('Modal tambah role tidak ditemukan');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function closeModalAddRole() {

        const modal = document.getElementById('modal-add-role');

        if (!modal) return;

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }



    /* =========================================================
       MODAL TAMBAH USER
    ========================================================= */

    function openModalAddUser() {

        const modal = document.getElementById('modal-add-user');

        if (!modal) {
            console.error('Modal tambah user tidak ditemukan');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function closeModalAddUser() {

        const modal = document.getElementById('modal-add-user');

        if (!modal) return;

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }



    /* =========================================================
       MODAL EDIT USER
    ========================================================= */

    function openModalEditUser() {

        const modal = document.getElementById('modal-edit-user');

        if (!modal) {
            console.error('Modal edit user tidak ditemukan');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function closeModalEditUser() {

        const modal = document.getElementById('modal-edit-user');

        if (!modal) return;

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }



    /* =========================================================
       DELETE ROLE
    ========================================================= */

    function deleteRole(id) {

        Swal.fire({
            title: 'Hapus Role?',
            text: 'Role ini akan dihapus dari sistem.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b'
        }).then((result) => {

            if (!result.isConfirmed) {
                return;
            }

            const csrfToken =
                document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content');


            fetch(`{{ url('role/deleteRole') }}/${id}`, {

                method: 'DELETE',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }

            })

            .then(response => {

                if (!response.ok) {
                    throw new Error('Gagal menghapus role');
                }

                return response.json();

            })

            .then(data => {

                if (data.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    tableRole.replaceData();

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan'
                    });

                }

            })

            .catch(error => {

                console.error('Error:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menghapus data.'
                });

            });

        });

    }



    /* =========================================================
       EDIT ROLE
    ========================================================= */

    function editRole(id, name, role) {

        document.getElementById('user_id').value = id;

        document.getElementById('name').value = name;


        let select = document.getElementById('role');


        for (let i = 0; i < select.options.length; i++) {

            if (select.options[i].value === role) {

                select.selectedIndex = i;

                break;
            }

        }


        const modal =
            document.getElementById('warning-modal-preview');

        if (modal) {

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }

    }



    function closeModal() {

        const modal =
            document.getElementById('warning-modal-preview');

        if (!modal) return;

        modal.classList.remove('flex');
        modal.classList.add('hidden');

    }



    /* =========================================================
       UPDATE ROLE
    ========================================================= */

    function updateRole() {

        let id =
            document.getElementById('user_id').value;

        let role =
            document.getElementById('role').value;


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

            Swal.fire({
                icon: data.success ? 'success' : 'error',
                title: data.success ? 'Berhasil' : 'Gagal',
                text: data.message
            });

            if (data.success) {

                closeModal();

                table.replaceData();

            }

        })

        .catch(error => {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui role.'
            });

        });

    }



    /* =========================================================
       TAMBAH ROLE
    ========================================================= */

    function addRole() {

        let name =
            document.getElementById('role_name').value.trim();


        if (!name) {

            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nama role wajib diisi.'
            });

            return;
        }


        fetch("{{ url('role/store') }}", {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            body: JSON.stringify({
                name: name
            })

        })

        .then(res => res.json())

        .then(data => {

            if (data.success !== false) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                document.getElementById('role_name').value = '';

                closeModalAddRole();

                tableRole.replaceData();

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message || 'Gagal menambahkan role.'
                });

            }

        })

        .catch(error => {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan role.'
            });

        });

    }



    /* =========================================================
       TAMBAH USER
    ========================================================= */

    function addUser() {

        let name =
            document.getElementById('new_user_name').value.trim();

        let email =
            document.getElementById('new_user_email').value.trim();

        let password =
            document.getElementById('new_user_password').value;

        let role =
            document.getElementById('new_user_role').value;


        if (!name || !email || !password || !role) {

            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Semua bidang isian wajib diisi!'
            });

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

                return res.json().then(err => {
                    throw err;
                });

            }

            return res.json();

        })

        .then(data => {

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });


            document.getElementById('new_user_name').value = '';
            document.getElementById('new_user_email').value = '';
            document.getElementById('new_user_password').value = '';
            document.getElementById('new_user_role').value = '';


            closeModalAddUser();


            table.replaceData();

        })

        .catch(err => {

            console.error(err);

            if (err.errors) {

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: Object
                        .values(err.errors)
                        .flat()
                        .join('<br>')
                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat menyimpan data.'
                });

            }

        });

    }



    /* =========================================================
       EDIT USER
    ========================================================= */

    function editUser(id) {

        fetch(`{{ url('role/editUser') }}/${id}`, {

            method: 'GET',

            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }

        })

        .then(response => {

            if (!response.ok) {
                throw new Error('Gagal mengambil data user');
            }

            return response.json();

        })

        .then(data => {

            document.getElementById('edit_user_id').value =
                data.id;

            document.getElementById('edit_user_name').value =
                data.name;

            document.getElementById('edit_user_email').value =
                data.email;

            document.getElementById('edit_user_role').value =
                data.role;

            document.getElementById('edit_user_password').value =
                '';


            openModalEditUser();

        })

        .catch(error => {

            console.error('Error:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat mengambil data user.'
            });

        });

    }



    /* =========================================================
       UPDATE USER
    ========================================================= */

    function updateUser() {

        const id =
            document.getElementById('edit_user_id').value;

        const name =
            document.getElementById('edit_user_name').value.trim();

        const email =
            document.getElementById('edit_user_email').value.trim();

        const password =
            document.getElementById('edit_user_password').value;

        const role =
            document.getElementById('edit_user_role').value;


        const csrfToken =
            document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');


        if (!name || !email || !role) {

            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nama, Email, dan Role wajib diisi!'
            });

            return;
        }


        fetch(`{{ url('role/updateUser') }}/${id}`, {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },

            body: JSON.stringify({
                name: name,
                email: email,
                password: password,
                role: role
            })

        })

        .then(response => response.json())

        .then(data => {

            if (data.success) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'User berhasil diperbarui!',
                    timer: 1500,
                    showConfirmButton: false
                });


                closeModalEditUser();


                table.replaceData();

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message ||
                          'Terjadi kesalahan'
                });

            }

        })

        .catch(error => {

            console.error('Error:', error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui data.'
            });

        });

    }

</script>

@endsection