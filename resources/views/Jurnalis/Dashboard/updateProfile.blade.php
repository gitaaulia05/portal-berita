@extends('Template.asideJ')

@section('container-main')


  <form action="/jurnalis/simpan-update-profile/{{$jurnalis['slug']}}" method="POST" enctype="multipart/form-data">
  @csrf

<h1 class="text-center pb-2">Update Data Akun</h1>
       
      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="inputAddress">Nama Lengkap</label>
                          <input type="text" name="nama" class="form-control" id="inputAddress5" value="{{$jurnalis['nama']}}" required>
                        </div>

                  <div class="form-group col-md-6 mt-md-0 mt-5">
                              <label for="deks_gambar">Foto</label>
                              <input type="file" id="uploadGambarJurnalis" name="gambar" class="form-control"  accept="image/*">
                              <img src="{{$gambar}}" id="previewGambarJurnalis" class="w-25 pt-2" >
                              <input type="hidden" name="gambar_lama" value="{{ $gambar }}">
                    </div>
      </div>
   <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
                
@endsection