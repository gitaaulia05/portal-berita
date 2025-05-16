@extends('Template.aside')

@section('container-main')

  <form action="/kategori-berita/{{ $data['id_kategori_berita'] }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="container px-5">
        <h2 class="mb-3">FORM UBAH KATEGORI BERITA</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Ada kesalahan saat input data.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="idKategori">Id Kategori Berita</label>
            <input type="text" class="form-control" id="idKategori" value="{{ $data['id_kategori_berita'] }}" readonly>
        </div>

        <div class="form-group">
            <label for="kategoriBerita">Kategori</label>
            <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategoriBerita" value="{{ old('kategori', $data['kategori']) }}" required>
            @error('kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </div>
</form>


@endsection