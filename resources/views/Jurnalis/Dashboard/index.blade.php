   @extends('Template.asideJ')

   @section('container-main')
      @if ($jurnalis['active'] == '0')
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-center">Akun Anda Belum Terverifikasi Admin !</strong> Belum Bisa Mengakses Menu Apapun.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
      </div>
      @endif
      
      <p>{{$jurnalis['nama']}}</p>
      <p>{{$jurnalis['email']}}</p>
      <p>{{$jurnalis['active']}}</p>
      @livewire('berita-live')
   @endsection