@extends('Pengguna.Main.main')

@section('container-main')
    <div class="Berita Terbaru pt-8 mb-20" id="berita-terbaru">
        <h1 class="pb-3 font-bold text-3xl">BERITA TERPOPLER MINGGU INI</h1>

            <div class="card-new-news w-6xl  grid lg:grid-cols-5 grid-cols-2 gap-2 pt-2">
              @foreach ($kategori as $k)
                    <div class="header-card-content  ">
                    <a href="/berita/{{$k['kategori_berita']}}/{{$k['slug']}}">
                        <img src="{{$url . '/storage/' . $k['gambar'][0]['gambar_berita']}}">
                        <p>{{$k['judul_berita']}} <a href="/berita/{{$k['kategori_berita']}}/{{$k['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapya</a></p>
                        <div class="text-footer">
                            <p class="font-semibold text-[#C95C66] pt-1">{{$k['kategori_berita']}}</p>
                        </div>
                    </a>
                    </div> 
                 @endforeach
            </div>
        
    </div>

   
@endsection