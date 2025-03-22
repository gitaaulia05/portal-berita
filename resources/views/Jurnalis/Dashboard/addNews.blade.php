   @extends('Template.asideJ')

   @section('container-main')

       <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Form row</strong>
                    </div>
                    <div class="card-body">
                      <form action="/simpan-berita" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="gambar_utama">Gambar Utama</label>
                            <input type="file" name="gambar" class="form-control" id="gambar_utama">

                             <label for="deks_gambar" class="pt-3">Deksripsi Gambar Utama</label>
                            <input type="text" name="keterangan_gambar" class="form-control w-20" id="deks_gambar" required>
                          </div>
                               <div class="form-group col-md-6">
                            <label for="deks_gamabar">Gambar Tambahan</label>
                            <input type="file" name="gambar2" class="form-control" id="deks_gambar">

                            <label for="deks_gambar2" class="pt-3">Deksripsi Gambar Tambahan</label>
                            <input type="text" name="keterangan_gambar2" class="form-control" id="deks_gambar2" required>
                          </div>
                        </div>
                        <div class="form-group">

                          <label for="inputAddress">Judul Berita</label>
                          <input type="text" name="judul_berita" class="form-control" id="inputAddress5" required>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2">Deksripsi Berita</label>
                          <textarea  name="deks_berita" class="form-control" row="7" cols="50" id="inputAddress6" required></textarea>
                        </div>

                           <div class="form-group">
                          <label for="inputState">Kategori Berita</label>
                          <select id="inputState" name="kategori" class="form-control">
                            <option value="Ekonomi" selected>Ekonomi</option>
                            <option value="Politik">Politik</option>
                            <option value="Teknologi">Teknologi</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Hiburan">Hiburan</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Berita</button>
                      </form>
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- /. end-section -->

   @endsection