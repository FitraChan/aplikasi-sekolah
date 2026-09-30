<form
    action="{{ route('calon-siswa.pembayaran', $rows->id ?? 0) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Pembayaran Pendaftaran
                    </h2>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Silakan upload bukti pembayaran pendaftaran Anda.
                    </p>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6">

            <div class="grid grid-cols-12 gap-6">

                {{-- Upload Bukti --}}
                <div class="col-span-12">

                    <label
                        for="bukti_transfer"
                        class="block text-sm font-medium text-slate-700 mb-2"
                    >
                        Bukti Transfer
                    </label>

                    <div
                        class="rounded-xl border border-dashed border-slate-300
                               bg-slate-50 p-5
                               hover:border-emerald-400 hover:bg-emerald-50/30
                               transition"
                    >

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center
                                       rounded-xl bg-white border border-slate-200
                                       text-emerald-600 shadow-sm"
                            >
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>

                            <div class="flex-1">

                                <input
                                    id="bukti_transfer"
                                    type="file"
                                    name="bukti_transfer"
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full text-sm text-slate-600
                                           file:mr-4 file:rounded-lg
                                           file:border-0
                                           file:bg-emerald-50
                                           file:px-4 file:py-2
                                           file:text-sm file:font-medium
                                           file:text-emerald-700
                                           hover:file:bg-emerald-100
                                           cursor-pointer"
                                >

                                <p class="mt-2 text-xs text-slate-500">
                                    JPG, JPEG, PNG atau PDF. Maksimal 2 MB.
                                </p>

                                @error('bukti_transfer')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Bukti Transfer Saat Ini --}}
                @if(!empty($rows->bukti_transfer))

                    <div class="col-span-12">

                        <div
                            class="rounded-xl border border-slate-200
                                   bg-slate-50 p-4"
                        >

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center
                                               rounded-lg bg-blue-50 text-blue-600"
                                    >
                                        <i data-lucide="file-check-2" class="w-5 h-5"></i>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-slate-700">
                                            Bukti Transfer Saat Ini
                                        </p>

                                        <p class="text-xs text-slate-500 mt-0.5">
                                            File pembayaran yang telah diupload.
                                        </p>
                                    </div>

                                </div>

                                <a
                                    href="{{ asset('storage/' . $rows->bukti_transfer) }}"
                                    target="_blank"
                                    class="inline-flex items-center justify-center
                                           rounded-lg border border-slate-200
                                           bg-white px-4 py-2
                                           text-sm font-medium text-slate-700
                                           shadow-sm
                                           hover:bg-slate-50
                                           hover:text-emerald-600
                                           transition"
                                >
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    Lihat Bukti
                                </a>

                            </div>

                        </div>

                    </div>

                @endif

            </div>


            {{-- Action --}}
            <div
                class="mt-8 flex flex-col-reverse gap-3
                       border-t border-slate-100 pt-6
                       sm:flex-row sm:items-center sm:justify-between"
            >

                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           rounded-xl bg-emerald-600
                           px-5 py-2.5
                           text-sm font-semibold text-white
                           shadow-sm
                           hover:bg-emerald-700
                           focus:outline-none
                           focus:ring-2 focus:ring-emerald-500
                           focus:ring-offset-2
                           transition"
                >
                    <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                    Simpan Bukti Transfer
                </button>


                <a
                    href="javascript:void(0)"
                    data-tw-toggle="modal"
                    data-tw-target="#modal-add-kelas"
                    class="inline-flex items-center justify-center
                           rounded-xl bg-blue-600
                           px-5 py-2.5
                           text-sm font-semibold text-white
                           shadow-sm
                           hover:bg-blue-700
                           focus:outline-none
                           focus:ring-2 focus:ring-blue-500
                           focus:ring-offset-2
                           transition"
                >
                    <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                    Bayar via iPaymu
                </a>

            </div>

        </div>

    </div>

</form>