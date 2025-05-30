@extends($layout)

@section('container-main')

  <form action="/administrator/simpan-update-profile/{{$data['slug']}}" method="POST" enctype="multipart/form-data">
  @csrf

<h1 class="text-center pb-2">Update Data Akun</h1>
       
       @php
         $success = session('message-success');
         $error = session('message-error');
       @endphp
         @if($success || $error) 

                                <div class="alert {{$success ? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
                                  <strong>{{$success ?? $error}}</strong> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif  
     <div class="row">
    <!-- Input Nama -->
    <div class="form-group col-md-6">
        <label for="inputAddress5">Nama Lengkap</label>
        <input type="text" 
               name="nama" 
               class="form-control @error('nama') is-invalid @enderror" 
               id="inputAddress5" 
               value="{{ old('nama', $data['nama'] ?? '') }}" 
               required>
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Input Gambar -->
    <div class="form-group col-md-6 mt-md-0 mt-5">
        <label for="uploadGambarJurnalis">Foto</label>
        <input type="file" 
               id="uploadGambarJurnalis" 
               name="gambar" 
               class="form-control @error('gambar') is-invalid @enderror" 
               accept="image/*">
        <img src="{{ ($data['gambar']) ? $url . '/storage/' . $data['gambar'] : asset('assets/avatars/face-1.png') }}" 
             id="previewGambarJurnalis" 
             class="w-25 pt-2">
        @error('gambar')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
        <input type="hidden" name="gambar_lama" value="{{ $gambar }}">
    </div>
</div>

   <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
                
@endsection