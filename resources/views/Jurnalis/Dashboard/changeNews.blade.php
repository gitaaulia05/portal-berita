   @extends('Template.asideJ')

   @section('container-main')

       <div class="row">

                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Form Update News</strong>
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
                            <label for="deks_gambar">Gambar Utama</label>
                              <input type="file" id="uploadGambarUtama" name="gambar" class="form-control" accept="image/*">
                              <img src="{{$gambar}}" id="previewGambar" class="w-25 pt-1">
                                             {{-- Input hidden untuk menyimpan gambar lama --}}
                       <input type="hidden" name="gambar_lama" value="{{ $gambar }}">
                              <br>
                              <label for="keterangan_gambar"  class="pt-3">Deksripsi Gambar Utama</label>
                              <input type="text" name="keterangan_gambar" class="form-control w-20"  value="{{$data['gambar']['0']['keterangan_gambar']}}" required>
                          </div>

                          @if (!empty($data['gambar'][1]))
                          <div class="form-group col-md-6 mt-md-0 mt-5">
                              <label for="deks_gambar">Gambar Tambahan</label>
                              <input type="file" id="uploadGambarTambahan" name="gambar2" class="form-control"  accept="image/*">
                              <img src="{{$gambar2}}" id="previewGambar2" class="w-25">
                               <input type="hidden" name="gambar_lama2" value="{{ $gambar2 }}">
                              <br>
                             <label for="keterangan_gambar2" class="pt-3">Deksripsi Gambar Tambahan</label>
                            <input type="text" name="keterangan_gambar2" class="form-control" id="deks_gambar2" value="{{$data['gambar'][1]['keterangan_gambar']}}" required>
                          </div>
                          @endif


                        </div>
                        <div class="form-group mt-md-0 mt-5">

                          <label for="inputAddress">Judul Berita</label>
                          <input type="text" name="judul_berita" class="form-control" id="inputAddress5" value={{$data['judul_berita']}} required>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2">Deksripsi Berita</label>
                          <textarea  name="deks_berita" class="form-control" row="7" cols="50" id="inputAddress6"  required>{{$data['deks_berita']}}</textarea>
                        </div>

                           <div class="form-group">
                          <label for="inputState">Kategori Berita</label>
                          <select id="inputState" name="kategori" class="form-control">
                            <option value="Ekonomi" {{old ('kategori' , $data['kategori_berita'][0]['kategori'] ?? '') == 'Ekonomi'  ? 'selected' : ''}} selected>Ekonomi</option>
                            <option value="Politik" {{old('kategori' , $data['kategori_berita'][0]['kategori'] ?? '') == 'Politik' ? 'selected' : ''}}>Politik</option>
                            <option value="Teknologi" {{old('kategori' , $data['kategori_berita'][0]['kategori'] ?? '') == 'Teknologi' ? 'selected' : ''}}>Teknologi</option>
                            <option value="Olahraga" {{old('kategori' , $data['kategori_berita'][0]['kategori'] ?? '') == 'Olahraga' ? 'selected' : ''}}>Olahraga</option>
                            <option value="Hiburan" {{old('kategori' , $data['kategori_berita'][0]['kategori'] ?? '') == 'Hiburan' ? 'selected' : ''}}>Hiburan</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Berita</button>
                      </form>
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- /. end-section -->

   @endsection