 <div class="intro-y flex flex-col sm:flex-row items-center mt-5 mb-5">
     <h2 class="text-lg font-medium mr-auto">
         Data Ujian
     </h2>



     <button
         class="btn btn-primary"
         data-tw-toggle="modal"
         data-tw-target="#modal-add-ujian">

         + Tambah Ujian

     </button>
 </div>
 <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
     <table class="table table-report -mt-2">
         <thead>
             <tr>
                 <th class="whitespace-nowrap">IMAGES</th>
                 <th class="whitespace-nowrap">JUDUL</th>
                 <th class="text-center whitespace-nowrap">TANGGAL QUIZ</th>
                 <th class="text-center whitespace-nowrap">TANGGAL MULAI</th>
                 <th class="text-center whitespace-nowrap">TANGGAL SELESAI</th>
                 <th class="text-center whitespace-nowrap">ACTIONS</th>
             </tr>
         </thead>
<tbody id="tbody-ujian">    
             @foreach($ujian as $row)

             <tr class="intro-x" id="row-{{ $row->id }}">
                 <td class="w-40">
                     <div class="flex">
                         <div class="w-10 h-10 image-fit zoom-in">
                             <img alt="#" class="tooltip rounded-full" src="{{asset('public/dist/images/logo.png')}}" title="Uploaded at 9 April 2022">
                         </div>
                         <div class="w-10 h-10 image-fit zoom-in -ml-5">
                             <img alt="#" class="tooltip rounded-full" src="{{asset('public/dist/images/logo.png')}}" title="Uploaded at 9 April 2022">
                         </div>
                         <div class="w-10 h-10 image-fit zoom-in -ml-5">
                             <img alt="#" class="tooltip rounded-full" src="{{asset('public/dist/images/logo.png')}}" title="Uploaded at 9 April 2022">
                         </div>
                     </div>
                 </td>
                 <td>
                     <a href="" class="font-medium whitespace-nowrap">{{ $row->judul }}</a>
                     <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Ujian</div>
                 </td>
                 <td class="text-center">{{ \Carbon\Carbon::parse($row->tgl_quiz)->translatedFormat('d F Y') }}</td>
                 <td class="text-center">{{ \Carbon\Carbon::parse($row->tgl_mulai)->format('d-m-Y H:i') }}</td>
                 <td class="text-center">{{ \Carbon\Carbon::parse($row->tgl_selesai)->format('d-m-Y H:i') }}</td>


                 <td class="table-report__action w-56">
                     <div class="flex justify-center items-center">
                         <a class="flex items-center mr-3" href="{{ url('pbm/dataDetQuiz/' . $row->id) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                         <a href="javascript:void(0)"
                             class="flex items-center text-danger"
                             onclick="deleteUjian({{ $row->id }})">

                             <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                             Delete

                         </a>
                     </div>
                 </td>
             </tr>
             @endforeach
         </tbody>
     </table>
 </div>


 @include('guru.materi_pbm.ujian.modal-tambah')

 <script>
    async function deleteUjian(id) {

    const result = await Swal.fire({
        title: 'Hapus Data?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d'
    });

    if (!result.isConfirmed) return;

    try {

        const response = await fetch("{{ url('pbm/deleteUjian') }}/" + id, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {

            await Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.msg,
                timer: 1500,
                showConfirmButton: false
            });

            // Hapus baris dari tabel
            document.getElementById('row-' + id).remove();

        } else {

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.msg
            });

        }

    } catch (error) {

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan pada server.'
        });

        console.error(error);

    }

}
 </script>