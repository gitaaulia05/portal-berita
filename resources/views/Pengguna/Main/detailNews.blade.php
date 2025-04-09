@extends('Pengguna.Main.main')

@section('container-main')

        <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 pb-2">
            <div class="image-jumbotron col-span-2 flex justify-center">
            <div>
              <img src={{$url . '/storage/' . $dataNews['gambar'][0]['gambar_berita']}} class="rounded-lg w-full h-4/5">
              <p class="text-slate-500 text-center">{{$dataNews['gambar'][0]['keterangan_gambar']}}</p>
              </div>

            </div>
                    <div class="card-news-top-news lg:mt-0 mt-3">

                <div class="grid grid-cols-3 max-h-36 gap-5">
                @foreach ($sideNews as $sn)
                        <div class="image-news">
                                <img src="{{$url . '/storage/' . $sn['gambar'][0]['gambar_berita']}}" class="rounded-sm">
                            </div>
                        <div class="header-top-news col-span-2">
                            <div class="hot-judul-news">
                                <h1 class="lg:text-md">{{$sn['judul_berita']}} <a href="#" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></h1>
                            </div>
                            <div class="footer-top-news pt-[0.20rem]">
                                <div class="flex gap-3">
                                <p class="text-[#C95C66]">{{$sn['kategori_berita']}}</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  class="w-3 pt-1"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" class=" fill-[#A5A5A5]"/></svg>
                                <p class="text-sm pt-1">{{$sn['updated_at']}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- END COLS GRID --}}
                    </div>
            
                {{-- END GRID NEWS --}}
                <div>
                </div>

            {{-- END CARD NEWS --}}
            </div>

        </div>

        <div class="main-content pb-4">
            <h1 class="text-3xl pb-3">{{$dataNews['judul_berita']}}</h1>
            <span class="pb-3">{{$dataNews['kategori_berita']}} | {{$dataNews['updated_at']}}</span>
            <p>{{$dataNews['deks_berita']}}</p>
        </div>


    <div class="Berita Terbaru pt-8 mb-20" id="berita-relevan">
        <h1 class="pb-3 font-bold text-3xl">BERITA YANG RELEVAN DENGAN ARTIKEL INI</h1>

            <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 gap-2 pt-2">
              @foreach ($relatedNews as $rn)
                    <div class="header-card-content hover:scale-105 transition duration-700">
                    <a href="/berita/{{$rn['kategori_berita']}}/{{$rn['slug']}}">
                        <img src="{{$url . '/storage/' . $rn['gambar'][0]['gambar_berita']}}">
                        <p>{{$rn['judul_berita']}} <a href="/berita/{{$rn['kategori_berita']}}/{{$rn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></p>
                        <div class="text-footer">
                            <p class="font-semibold text-[#C95C66] pt-1">{{$rn['kategori_berita']}}</p>
                        </div>
                    </a>
                    </div> 
                 @endforeach
            </div>
    </div>


        <div class="Berita Terbaru pt-8 mb-20" id="berita-terbaru">
        <h1 class="pb-3 font-bold text-3xl">BERITA TERPOPLER MINGGU INI</h1>

            <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 gap-2 pt-2">
              @foreach ($newNews as $pn)
                    <div class="header-card-content hover:scale-105 transition duration-700">
                    <a href="/berita/{{$pn['kategori_berita']}}/{{$pn['slug']}}">
                        <img src="{{$url . '/storage/' . $pn['gambar'][0]['gambar_berita']}}">
                        <p>{{$pn['judul_berita']}} <a href="/berita/{{$pn['kategori_berita']}}/{{$pn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></p>
                        <div class="text-footer">
                            <p class="font-semibold text-[#C95C66] pt-1">{{$pn['kategori_berita']}}</p>
                        </div>
                    </a>
                    </div> 
                 @endforeach
            </div>
        
    </div>
@endsection