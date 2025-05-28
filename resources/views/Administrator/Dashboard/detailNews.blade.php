@extends('Template.aside')

@section('container-main')
<div class="row">

    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header">
          <strong class="card-title">Detail Data Berita</strong>
        </div>
        <div class="card-body">
       
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
                      accept="image/*"  readonly
                    >
                    @error('gambar')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                
                    <img src="{{ $gambar }}" id="previewGambar" class="w-25 pt-1">
                
                    <input type="hidden" name="gambar_lama" value="{{ $gambar }}"  readonly>
                
                    <label for="keterangan_gambar" class="pt-3">Deskripsi Gambar Utama</label>
                    <input
                      type="text"
                      name="keterangan_gambar"
                      class="form-control @error('keterangan_gambar') is-invalid @enderror"
                      value="{{ old('keterangan_gambar', $dataBerita['gambar'][0]['keterangan_gambar'] ?? '') }}"
                       readonly
                    >
                    @error('keterangan_gambar')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                
                  @if(! empty($dataBerita['gambar'][1]))
                    <div class="form-group col-md-6 mt-md-0 mt-5">
                      <label for="uploadGambarTambahan">Gambar Tambahan</label>
                      <input
                        type="file"
                        id="uploadGambarTambahan"
                        name="gambar2"
                        class="form-control @error('gambar2') is-invalid @enderror"
                        accept="image/*"  readonly
                      >
                      @error('gambar2')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                
                      <img src="{{ $gambar2 }}" id="previewGambar2" class="w-25">
                
                      <input type="hidden" name="gambar_lama2" value="{{ $gambar2 }}"  id="gambar2">
                
                      <label for="keterangan_gambar2" class="pt-3">Deskripsi Gambar Tambahan</label>

                      @error('keterangan_gambar2')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror

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
                    value="{{ old('judul_berita', $dataBerita['judul_berita'] ?? '') }}"
                     readonly
                  >
                  @error('judul_berita')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="form-group">
                  <label for="inputAddress6">Deskripsi Berita</label>
                  <textarea
                    name="deks_berita"
                    class="form-control @error('deks_berita') is-invalid @enderror"
                    id="inputAddress6"
                    rows="7"
                    readonly
                  >{{ old('deks_berita', $dataBerita['deks_berita'] ?? '') }}</textarea>
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
                 disabled>
                    @foreach(['Ekonomi','Politik','Teknologi','Olahraga','Hiburan'] as $kat)
                      <option
                        value="{{ $kat }}"
                        {{ old('kategori', $dataBerita['kategori_berita'][0]['kategori'] ?? '') === $kat ? 'selected' : '' }}
                      >
                        {{ $kat }}
                      </option>
                    @endforeach
                  </select>
                  @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

            <form action="/berita/softHapus/{{ $dataBerita['slug']}}" method="POST" >
                    @csrf 
                    <a class="btn btn-primary text-white" data-toggle="modal"data-target="#softDelete{{ $dataBerita['slug']}}" style="cursor: auto;">Hapus Dalam 30 Hari</a>
                    <div class="modal fade" id="softDelete{{ $dataBerita['slug']}}" tabindex="-1" aria-labelledby="modalLabel{{ $dataBerita['slug']}}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalLabel{{ $dataBerita['slug']}}">Hapus Berita</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>Item Akan dihapus dan dapat di <bold>RECOVERY</bold> Dalam 30 Hari</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary"  data-dismiss="modal">Tutup</button>
                
                                  <button type="submit" 
                                    class="btn btn-primary text-white"
                                    type="button">
                                    Ya, Hapus
                                  </button>

          </form>


        </div> <!-- /. card-body -->
      </div> <!-- /. card -->
    </div> <!-- /. col -->
  </div> <!-- /. end-section -->


@endsection