
<form action="{{ route('calon-siswa.update.upload', $rows->id ?? 0) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="px-5 sm:px-6 py-5 border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl
                            bg-[#00B686]/10
                            text-[#00B686]
                            flex items-center justify-center">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 16V4"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m8 8 4-4 4 4"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 12v7a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-7"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Upload Dokumen
                    </h2>

                    <p class="text-sm text-slate-500 mt-0.5">
                        Upload dan kelola dokumen persyaratan calon siswa
                    </p>

                </div>

            </div>

        </div>


        <!-- =====================================================
             BODY
        ====================================================== -->

        <div class="p-5 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                <!-- =================================================
                     FOTO SISWA
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-blue-50 text-blue-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <rect x="3" y="3"
                                      width="18"
                                      height="18"
                                      rx="2"/>

                                <circle cx="8.5" cy="8.5" r="1.5"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m21 15-5-5L5 21"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                Foto Siswa
                            </label>

                            <p class="text-xs text-slate-500">
                                Format gambar
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="foto_siswa"
                           accept="image/*"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->foto_siswa))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Foto saat ini
                            </p>

                            <img
                                src="{{ asset('storage/app/public/' . $rows->foto_siswa) }}"
                                alt="Foto Siswa"
                                class="w-32 h-32 object-cover
                                       rounded-xl border border-slate-200
                                       shadow-sm"
                            >

                        </div>

                    @endif

                </div>


                <!-- =================================================
                     KK
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-amber-50 text-amber-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 3h9l3 3v15H6z"/>

                                <path stroke-linecap="round"
                                      d="M9 13h6M9 17h4"/>

                                <path stroke-linecap="round"
                                      d="M9 9h3"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                Kartu Keluarga (KK)
                            </label>

                            <p class="text-xs text-slate-500">
                                PDF atau gambar
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="kk"
                           accept=".pdf,image/*"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->kk))

                        @php
                            $ext = pathinfo($rows->kk, PATHINFO_EXTENSION);
                        @endphp

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Dokumen saat ini
                            </p>

                            @if(in_array(strtolower($ext), ['jpg','jpeg','png']))

                                <img
                                    src="{{ asset('storage/app/public/' . $rows->kk) }}"
                                    alt="KK"
                                    class="w-32 h-32 object-cover
                                           rounded-xl border border-slate-200
                                           shadow-sm"
                                >

                            @else

                                <a href="{{ asset('storage/app/public/' . $rows->kk) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2
                                          px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-slate-50
                                          text-sm font-semibold
                                          text-slate-700
                                          hover:bg-slate-100
                                          transition-colors">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                    </svg>

                                    Lihat KK

                                </a>

                            @endif

                        </div>

                    @endif

                </div>


                <!-- =================================================
                     AKTA KELAHIRAN
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-purple-50 text-purple-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 3h9l3 3v15H6z"/>

                                <path stroke-linecap="round"
                                      d="M9 13h6M9 17h4"/>

                                <path stroke-linecap="round"
                                      d="M9 9h3"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                Akta Kelahiran
                            </label>

                            <p class="text-xs text-slate-500">
                                PDF atau gambar
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="akta_kelahiran"
                           accept=".pdf,image/*"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->akta_kelahiran))

                        @php
                            $ext = pathinfo($rows->akta_kelahiran, PATHINFO_EXTENSION);
                        @endphp

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Dokumen saat ini
                            </p>

                            @if(in_array(strtolower($ext), ['jpg','jpeg','png']))

                                <img
                                    src="{{ asset('storage/app/public/' . $rows->akta_kelahiran) }}"
                                    alt="Akta Kelahiran"
                                    class="w-32 h-32 object-cover
                                           rounded-xl border border-slate-200
                                           shadow-sm"
                                >

                            @else

                                <a href="{{ asset('storage/app/public/' . $rows->akta_kelahiran) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2
                                          px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-slate-50
                                          text-sm font-semibold
                                          text-slate-700
                                          hover:bg-slate-100
                                          transition-colors">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                    </svg>

                                    Lihat Akta

                                </a>

                            @endif

                        </div>

                    @endif

                </div>


                <!-- =================================================
                     IJAZAH
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-emerald-50 text-emerald-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M4 19.5V5.5A1.5 1.5 0 0 1 5.5 4H20v16H5.5A1.5 1.5 0 0 1 4 18.5Z"/>

                                <path stroke-linecap="round"
                                      d="M8 8h8M8 12h6"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                Ijazah
                            </label>

                            <p class="text-xs text-slate-500">
                                Format PDF
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="ijazah"
                           accept=".pdf"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->ijazah))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Dokumen saat ini
                            </p>

                            <a href="{{ asset('storage/app/public/' . $rows->ijazah) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2
                                      px-4 py-2.5
                                      rounded-lg
                                      border border-slate-200
                                      bg-slate-50
                                      text-sm font-semibold
                                      text-slate-700
                                      hover:bg-slate-100
                                      transition-colors">

                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                </svg>

                                Lihat Ijazah

                            </a>

                        </div>

                    @endif

                </div>


                <!-- =================================================
                     RAPORT
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-cyan-50 text-cyan-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M4 19.5V5.5A1.5 1.5 0 0 1 5.5 4H20v16H5.5A1.5 1.5 0 0 1 4 18.5Z"/>

                                <path stroke-linecap="round"
                                      d="M8 8h8M8 12h6"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                Raport
                            </label>

                            <p class="text-xs text-slate-500">
                                Format PDF
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="raport"
                           accept=".pdf"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->raport))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Dokumen saat ini
                            </p>

                            <a href="{{ asset('storage/app/public/' . $rows->raport) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2
                                      px-4 py-2.5
                                      rounded-lg
                                      border border-slate-200
                                      bg-slate-50
                                      text-sm font-semibold
                                      text-slate-700
                                      hover:bg-slate-100
                                      transition-colors">

                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                </svg>

                                Lihat Raport

                            </a>

                        </div>

                    @endif

                </div>


                <!-- =================================================
                     KTP AYAH
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-indigo-50 text-indigo-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <rect x="3" y="5"
                                      width="18"
                                      height="14"
                                      rx="2"/>

                                <circle cx="8" cy="11" r="2"/>

                                <path stroke-linecap="round"
                                      d="M13 10h5M13 14h4"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                KTP Ayah
                            </label>

                            <p class="text-xs text-slate-500">
                                PDF atau gambar
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="ktp_ayah"
                           accept=".pdf,image/*"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->ktp_ayah))

                        @php
                            $ext = pathinfo($rows->ktp_ayah, PATHINFO_EXTENSION);
                        @endphp

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Dokumen saat ini
                            </p>

                            @if(in_array(strtolower($ext), ['jpg','jpeg','png']))

                                <img
                                    src="{{ asset('storage/app/public/' . $rows->ktp_ayah) }}"
                                    alt="KTP Ayah"
                                    class="w-32 h-20 object-cover
                                           rounded-xl border border-slate-200
                                           shadow-sm"
                                >

                            @else

                                <a href="{{ asset('storage/app/public/' . $rows->ktp_ayah) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2
                                          px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-slate-50
                                          text-sm font-semibold
                                          text-slate-700
                                          hover:bg-slate-100
                                          transition-colors">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                    </svg>

                                    Lihat KTP Ayah

                                </a>

                            @endif

                        </div>

                    @endif

                </div>


                <!-- =================================================
                     KTP IBU
                ================================================== -->

                <div class="rounded-xl border border-slate-200 p-4
                            hover:border-[#00B686]/40
                            transition-colors">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-lg
                                    bg-pink-50 text-pink-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 viewBox="0 0 24 24">

                                <rect x="3" y="5"
                                      width="18"
                                      height="14"
                                      rx="2"/>

                                <circle cx="8" cy="11" r="2"/>

                                <path stroke-linecap="round"
                                      d="M13 10h5M13 14h4"/>

                            </svg>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold text-slate-800">
                                KTP Ibu
                            </label>

                            <p class="text-xs text-slate-500">
                                PDF atau gambar
                            </p>

                        </div>

                    </div>


                    <input type="file"
                           name="ktp_ibu"
                           accept=".pdf,image/*"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-[#00B686]/10
                                  file:text-[#008f70]
                                  file:font-semibold
                                  hover:file:bg-[#00B686]/20
                                  cursor-pointer">


                    @if(!empty($rows->ktp_ibu))

                        @php
                            $ext = pathinfo($rows->ktp_ibu, PATHINFO_EXTENSION);
                        @endphp

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                Dokumen saat ini
                            </p>

                            @if(in_array(strtolower($ext), ['jpg','jpeg','png']))

                                <img
                                    src="{{ asset('storage/app/public/' . $rows->ktp_ibu) }}"
                                    alt="KTP Ibu"
                                    class="w-32 h-20 object-cover
                                           rounded-xl border border-slate-200
                                           shadow-sm"
                                >

                            @else

                                <a href="{{ asset('storage/app/public/' . $rows->ktp_ibu) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2
                                          px-4 py-2.5
                                          rounded-lg
                                          border border-slate-200
                                          bg-slate-50
                                          text-sm font-semibold
                                          text-slate-700
                                          hover:bg-slate-100
                                          transition-colors">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                    </svg>

                                    Lihat KTP Ibu

                                </a>

                            @endif

                        </div>

                    @endif

                </div>

            </div>


            <!-- =====================================================
                 BUTTON
            ====================================================== -->

            <div class="flex justify-end mt-6 pt-5 border-t border-slate-100">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-6 py-3
                           rounded-xl
                           bg-[#02BC9C]
                           hover:bg-[#02a387]
                           text-white
                           text-sm font-semibold
                           shadow-sm
                           hover:shadow-md
                           transition-all duration-200"
                >

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 12l4 4L19 6"/>

                    </svg>

                    Simpan Dokumen

                </button>

            </div>

        </div>

    </div>

</form>

