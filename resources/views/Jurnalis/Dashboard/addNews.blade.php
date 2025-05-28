   @extends('Template.asideJ')

   @section('container-main')

       <div class="row">
           <a class="dropdown-item" href="/tambah-berita">Tambah Berita</a>
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Form row</strong>
                    </div>
                    <div class="card-body">
                      <form action="/simpan-berita" method="POST" enctype="multipart/form-data">
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
              <label for="gambar_utama">Gambar Utama</label>
              <input
                type="file"
                name="gambar"
                class="form-control @error('gambar') is-invalid @enderror"
                id="gambar_utama">
              @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          
              <label for="deks_gambar" class="pt-3">Deskripsi Gambar Utama</label>
              <input
                type="text"
                name="keterangan_gambar"
                class="form-control @error('keterangan_gambar') is-invalid @enderror"
                id="deks_gambar"
                value="{{ old('keterangan_gambar') }}"
                required>
              @error('keterangan_gambar')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="form-group col-md-6">
              <label for="gambar2">Gambar Tambahan</label>
              <input
                type="file"
                name="gambar2"
                class="form-control @error('gambar2') is-invalid @enderror"
                id="gambar2"
              >
              @error('gambar2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          
              <label for="deks_gambar2" class="pt-3">Deskripsi Gambar Tambahan</label>
              <input
                type="text"
                name="keterangan_gambar2"
                class="form-control @error('keterangan_gambar2') is-invalid @enderror"
                id="deks_gambar2"
                value="{{ old('keterangan_gambar2') }}"
                
              >
              @error('keterangan_gambar2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputAddress5">Judul Berita</label>
            <input
              type="text"
              name="judul_berita"
              class="form-control @error('judul_berita') is-invalid @enderror"
              id="inputAddress5"
              value="{{ old('judul_berita') }}"
              required
            >
            @error('judul_berita')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
              <label for="deks_berita" >Deksripsi Berita</label>
              <input id="deks_berita" type="hidden" value="{{ old('deks_berita') }}" name="deks_berita" required>
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
                <option value="{{ $kat['kategori'] }}" {{ old('kategori') === $kat['kategori']? 'selected' : '' }}>
                  {{ $kat['kategori'] }}
                </option>
              @endforeach
            </select>
            @error('kategori')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
                        <button type="submit" class="btn btn-primary">Tambah Berita</button>
                      </form>
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- /. end-section -->

   @endsection
