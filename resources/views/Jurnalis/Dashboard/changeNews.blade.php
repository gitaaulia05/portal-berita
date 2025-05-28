   @extends('Template.asideJ')

   @section('container-main')

       <div class="row">

                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Form Ubah Berita</strong>
                    </div>
                    <div class="card-body">
                      <form action="/update-berita/{{$data['slug']}}" method="POST" enctype="multipart/form-data">
                      @csrf 
                          @if(session()->has('message-error')) 
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong>{{session('message-error')}}</strong> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif  
          
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="uploadGambarUtama">Gambar Utama</label>
                                <input
                                  type="file"
                                  id="uploadGambarUtama"
                                  name="gambar"
                                  class="form-control @error('gambar') is-invalid @enderror"
                                  accept="image/*"
                                >
                                @error('gambar')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                                <img src="{{ $gambar }}" id="previewGambar" class="w-25 pt-1">
                            
                                <input type="hidden" name="gambar_lama" value="{{ $gambar }}">
                            
                                <label for="keterangan_gambar" class="pt-3">Deskripsi Gambar Utama</label>
                                <input
                                  type="text"
                                  name="keterangan_gambar" 
                                  class="form-control @error('keterangan_gambar') is-invalid @enderror"
                                  value="{{ old('keterangan_gambar', $data['gambar'][0]['keterangan_gambar'] ?? '') }}"
                                  required
                                >
                                @error('keterangan_gambar')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                            
                              @if(! empty($data['gambar'][1]))
                                <div class="form-group col-md-6 mt-md-0 mt-5">
                                  <label for="uploadGambarTambahan">Gambar Tambahan</label>
                                  <input
                                    type="file"
                                    id="uploadGambarTambahan"
                                    name="gambar2"
                                    class="form-control @error('gambar2') is-invalid @enderror"
                                    accept="image/*"
                                  >
                                  @error('gambar2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                 
                                  <img src="{{ $gambar2 }}" id="previewGambar2" class="w-25">
                              
                                  <input type="hidden" name="gambar_lama2" value="{{ $data['gambar'][1]['gambar_berita'] }}"  id="gambar2">
                            
                                  <label for="keterangan_gambar2" class="pt-3">Deskripsi Gambar Tambahan</label>
                                  <input
                                  type="text"
                                   id="deks_gambar2"
                                  name="keterangan_gambar2"
                                  class="form-control @error('keterangan_gambar2') is-invalid @enderror"
                                  value="{{ old('keterangan_gambar2', $data['gambar'][1]['keterangan_gambar'] ?? '') }}"
                                 
                                >

                                  @error('keterangan_gambar2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                            
                                  <div class="my-2">
                                    <button type="button" class="btn btn-danger" onclick="removeImage()">
                                      Hapus Gambar Tambahan
                                    </button>
                                  </div>
                                </div>
                              @endif
                            </div>
                            
                            <div class="form-group mt-md-0 mt-5">
                              <label for="inputAddress5">Judul Berita</label>
                              <input
                                type="text"
                                name="judul_berita"
                                class="form-control @error('judul_berita') is-invalid @enderror"
                                id="inputAddress5"
                                value="{{ old('judul_berita', $data['judul_berita'] ?? '') }}"
                                required
                              >
                              @error('judul_berita')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            
                            <div class="form-group">
                              <label for="deks_berita" >Deksripsi Berita</label>
                              <input id="deks_berita" type="hidden" value="{{old('deks_berita' ,  $data['deks_berita']  ?? '') }}" name="deks_berita" required>
                              <trix-editor input="deks_berita" class="@error('deks_berita') is-invalid @enderror"></trix-editor>
                              @error('deks_berita')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                            </div>
                          
                            <div class="form-group">
                              <label for="inputState">Kategori Berita</label>
                              <select
                                id="inputState"
                                name="kategori"
                                class="form-control @error('kategori') is-invalid @enderror"
                              >
                                @foreach($kategori as $kat)                  
                                  <option
                                    value="{{ $kat['kategori'] }}"
                                    {{ old('kategori', $data['kategori_berita']) == $kat['kategori'] ? 'selected' : '' }}
                                  >
                                    {{ $kat['kategori'] }}
                                  </option>
                                @endforeach
                              </select>
                              @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            
                        <button type="submit" class="btn btn-primary">Ubah Berita</button>
                      </form>
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- /. end-section -->

   @endsection

   @section('script')
   <script>
        function removeImage(){
          const keterangan = document.getElementById('deks_gambar2');
          const imagePreview = document.getElementById('previewGambar2');
          const imageHidden = document.getElementById('gambar2');
          imagePreview.src='';
          imagePreview.value='';
          keterangan.src='';
          if(imageHidden) {
            imageHidden.value='';
          }
          if (keterangan) {
          keterangan.value = ''; // Kosongkan deskripsi juga
        }
         
        }
   </script>

   @endsection
