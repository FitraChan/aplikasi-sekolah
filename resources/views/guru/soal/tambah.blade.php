 @extends('layout.main')

 @section('tittle')
 Soal
 @endsection

 @section('top-nav')
 <ol class="breadcrumb">
     <li class="breadcrumb-item">Daftar Soal</li>
 </ol>
 @endsection

 @section('body')
 <div class="w-full max-w-none px-6 py-6">

     <div class="intro-y box">

         <div class="flex items-center p-5 border-b border-slate-200/60">
             <h2 class="font-medium text-base">
                 Daftar Soal
             </h2>
         </div>

         <div class="p-6">

         @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mb-3">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

             <form
                 method="POST"
                 enctype="multipart/form-data"
                 action="{{ $row ? route('soalGuru.update',$row->id) : route('soalGuru.store') }}">

                 @csrf

                 @if($row)
                 @method('PUT')
                 @endif
                 <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                     <input type="hidden" id="form_mode" value="add">
                     <input type="hidden" name="id" value="{{ $row->id ?? '' }}">

                     <!-- Judul -->
                     <div class="col-span-12">
                         <label class="form-label">Judul Soal</label>
                         <div class="input-group">
                             <div class="input-group-text">Judul</div>
                             <input
                                 type="text"
                                 class="form-control"
                                 id="e_judul_soal"
                                 name="judul_soal"

                                 placeholder="Masukkan Judul Soal"
                                 value="{{ old('judul_soal', $row->judul_soal ?? '') }}">
                         </div>
                     </div>

                     <!-- Jenis Soal -->
                     <div class="col-span-6">
                         <label class="form-label">Jenis Soal</label>

                         <select
                             class="form-select"
                             name="jenis_soal_id">

                             <option value="">Pilih Jenis Soal</option>

                             @foreach($jenis_soal as $item)

                             <option
                                 value="{{ $item->id }}"
                                 {{ old('jenis_soal_id', $row->jenis_soal_id ?? '') == $item->id ? 'selected' : '' }}>

                                 {{ $item->jenis_soal }}

                             </option>

                             @endforeach

                         </select>
                     </div>

                     <!-- Mata Pelajaran -->
                     <div class="col-span-6">
                         <label class="form-label">Mata Pelajaran</label>

                         <select
                             class="form-select"
                             name="mapel_id">

                             @foreach($mapel as $item)

                             <option
                                 value="{{ $item['id_mapel'] }}"
                                 {{ old('mapel_id', $row->mapel_id ?? '') == $item['id_mapel'] ? 'selected' : '' }}>

                                 {{ $item['nama_mapel'] }}

                             </option>

                             @endforeach

                         </select>
                     </div>

                     <!-- Semester -->
                     <div class="col-span-6">
                         <label class="form-label">Semester</label>

                         <input
                             type="text"
                             class="form-control"
                             id="e_smt"
                             name="smt"
                             value="{{ old('smt', $row->smt ?? $smt) }}"
                             placeholder="Masukkan Semester">
                     </div>

                     <!-- Jawaban Benar -->
                     <div class="col-span-6">
                         <label class="form-label">Jawaban Benar</label>

                         <select
                             class="form-select"
                             name="jawaban_benar">

                             @foreach(['A','B','C','D','E'] as $jwb)

                             <option
                                 value="{{ $jwb }}"
                                 {{ old('jawaban_benar', $row->jawaban_benar ?? '') == $jwb ? 'selected' : '' }}>

                                 {{ $jwb }}

                             </option>

                             @endforeach

                         </select>
                     </div>

                     <!-- Soal -->
                     <div class="col-span-12">
                         <label class="form-label">Soal</label>

                         <textarea
                             id="e_editor"
                             name="soal">{{ old('soal', $row->soal ?? '') }}</textarea>
                     </div>




                     <!-- Jawaban -->
                     @foreach(['a','b','c','d','e'] as $jwb)

                     <div class="col-span-6">

                         <label class="form-label">
                             Jawaban {{ strtoupper($jwb) }}
                         </label>

                         <div class="input-group">

                             <div class="input-group-text">
                                 {{ strtoupper($jwb) }}
                             </div>

                             <input
                                 type="text"
                                 class="form-control"
                                 id="e_jawaban_{{ $jwb }}"
                                 name="jawaban_{{ $jwb }}"
                                 value="{{ old('jawaban_'.$jwb, $row->{'jawaban_'.$jwb} ?? '') }}"
                                 placeholder="Masukkan Jawaban {{ strtoupper($jwb) }}">

                         </div>

                     </div>

                     @endforeach

                 </div>

                 <div class="modal-footer">

                     <a href="{{ route('soalGuru.index') }}"
                         class="btn btn-outline-secondary">
                         Kembali
                     </a>

                     <button
                         type="submit"
                         class="btn btn-primary">
                         Simpan
                     </button>

                 </div>

             </form>



         </div>
     </div>

 </div>

 </div>
 <script>
     CKEDITOR.replace('e_editor', {
         filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
         filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
         filebrowserUploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}",
         filebrowserUploadMethod: 'form',
         removePlugins: 'easyimage,cloudservices'

     });
 </script>
 @endsection