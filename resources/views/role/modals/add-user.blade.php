<div
    id="modal-add-user"
    class="hidden fixed inset-0 z-[9999]
           items-center justify-center
           bg-slate-900/50
           p-4"
    tabindex="-1"
    aria-hidden="true"
>

    <div
        class="w-full max-w-lg
               bg-white
               rounded-xl
               shadow-xl
               overflow-hidden"
    >

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="flex items-center justify-between
                   px-6 py-4
                   border-b border-slate-200"
        >

            <h2 class="text-lg font-semibold text-slate-800">
                Tambah User Baru
            </h2>

            <button
                type="button"
                onclick="closeModalAddUser()"
                class="inline-flex items-center justify-center
                       w-8 h-8
                       rounded-lg
                       text-slate-400
                       hover:text-slate-600
                       hover:bg-slate-100
                       transition-colors"
                aria-label="Tutup"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        {{-- =====================================================
            BODY
        ====================================================== --}}
        <div class="px-6 py-5">

            {{-- Nama --}}
            <div class="mb-5">

                <label
                    for="new_user_name"
                    class="block mb-2
                           text-sm font-medium
                           text-slate-700"
                >
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="new_user_name"
                    placeholder="Nama lengkap user"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

            </div>


            {{-- Email --}}
            <div class="mb-5">

                <label
                    for="new_user_email"
                    class="block mb-2
                           text-sm font-medium
                           text-slate-700"
                >
                    Email
                </label>

                <input
                    type="email"
                    id="new_user_email"
                    placeholder="user@email.com"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

            </div>


            {{-- Password --}}
            <div class="mb-5">

                <label
                    for="new_user_password"
                    class="block mb-2
                           text-sm font-medium
                           text-slate-700"
                >
                    Password
                </label>

                <input
                    type="password"
                    id="new_user_password"
                    placeholder="Minimal 6 karakter"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

            </div>


            {{-- Role --}}
            <div>

                <label
                    for="new_user_role"
                    class="block mb-2
                           text-sm font-medium
                           text-slate-700"
                >
                    Pilih Role
                </label>

                <select
                    id="new_user_role"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

                    <option value="">
                        -- Pilih Role --
                    </option>

                    @foreach ($roles as $role)

                        <option value="{{ $role->name }}">
                            {{ ucfirst($role->name) }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>


        {{-- =====================================================
            FOOTER
        ====================================================== --}}
        <div
            class="flex flex-col-reverse
                   sm:flex-row sm:justify-end
                   gap-2
                   px-6 py-4
                   bg-slate-50
                   border-t border-slate-200"
        >

            {{-- Batal --}}
            <button
                type="button"
                onclick="closeModalAddUser()"
                class="inline-flex items-center justify-center
                       px-4 py-2.5
                       rounded-lg
                       border border-slate-300
                       bg-white
                       text-sm font-medium
                       text-slate-700
                       hover:bg-slate-100
                       transition-colors"
            >
                Batal
            </button>


            {{-- Simpan --}}
            <button
                type="button"
                onclick="addUser()"
                class="inline-flex items-center justify-center
                       gap-2
                       px-4 py-2.5
                       rounded-lg
                       bg-[#02BC9C]
                       hover:bg-[#00B686]
                       text-white
                       text-sm font-medium
                       shadow-sm
                       transition-colors"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12l4 4L19 6"
                    />
                </svg>

                Simpan

            </button>

        </div>

    </div>

</div>