@extends('Pengguna.Main.main')

@section('container-main')

        <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 pb-2">
            <div class="image-jumbotron col-span-2 flex justify-center">
            <div>
              <img src="{{($dataNews['gambar'][0]['gambar_berita']) ? $url . '/storage/' .$dataNews['gambar'][0]['gambar_berita'] : asset('assets/images/dummy.jpg') }}" class="rounded-lg w-full h-4/5">
                @if(!empty($dataNews['gambar'][0]['keterangan_gambar']))
              <p class="text-slate-500 text-center">{{$dataNews['gambar'][0]['keterangan_gambar']}}</p>
              @endif
              </div>

            </div>
                    <div class="card-news-top-news lg:mt-0 mt-3">

                <div class="lg:grid lg:grid-cols-3 max-h-36 gap-5  hidden">
                    @if (!empty($sideNews))

                            @foreach ($sideNews as $sn)
                            <div class="image-news">
                                    <img src="{{!empty($sn['gambar'][0]['gambar_berita']) ? $url . '/storage/' .$sn['gambar'][0]['gambar_berita'] : asset('assets/images/dummy.jpg') }}" class="rounded-sm">
                                </div>
                            <div class="header-top-news col-span-2">
                                <div class="hot-judul-news">
                                    <h1 class="lg:text-md">{{$sn['judul_berita']}} <a href="/berita/{{$sn['kategori_berita']}}/{{$sn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></h1>
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
                    @endif
                    {{-- END COLS GRID --}}
                    </div>
            
                {{-- END GRID NEWS --}}
                <div>
                </div>

            {{-- END CARD NEWS --}}
            </div>

        </div>

        <div class="main-content pb-4">
            <h1 class="text-3xl pb-3 text-center  font-semibold">{{$dataNews['judul_berita']}}</h1>
            <span class="pb-3">{{$dataNews['kategori_berita']}} | {{$dataNews['updated_at']}}</span>
           
            {!! $dataNews['deks_berita'] !!}
        </div>

        <div class="share-news flex flex-row justify-end gap-3">
            <div class="simpan"></div>
        <form action="/profile/{{ $dataNews['simpanBerita'] ? 'deleteSaveNews':'saveNews' }}/{{ $dataNews['kategori_berita'] }}/{{ $dataNews['slug'] }}" method="POST">
                @csrf
                @if ($dataNews['simpanBerita'])
                @method('DELETE')    
                @endif
                <div class="share text-white"> <button type="submit" class="bg-[#0E7CC9] p-2 rounded-md hover:opacity-95 transition duration-700">
                    <span><svg class="w-6 h-6 text-gray-800  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="{{ $dataNews['simpanBerita'] ? 'currentColor' : 'none' }}" viewBox="0 0 14 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 19-6-5-6 5V2a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v17Z"/>
                    </svg></span>
                   Simpan Berita</button>
                    </div>
              </form>


        </div>

    <div class="Berita Terbaru pt-8 mb-20" id="berita-relevan">
        <h1 class="pb-3 font-bold text-3xl">BERITA YANG RELEVAN DENGAN ARTIKEL INI</h1>

                <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 gap-2 pt-2">
                    @foreach ($relateNews as $rn)


                        {{-- @if (isset($rn['slug']) && isset($rn['kategori_berita']) && isset($rn['judul_berita'])) --}}
                            <div class="header-card-content hover:scale-105 transition duration-700">
                                <a href="/berita/{{ $rn['kategori_berita'] ?? '' }}/{{ $rn['slug'] ??'' }}">
                                    <img src="{{ !empty($rn['gambar'][0]['gambar_berita']) ? $url . '/storage/' . $rn['gambar'][0]['gambar_berita'] : asset('assets/images/dummy.jpg')}}">
                                    <p>
                                        {{ $rn['judul_berita'] ??'' }} 
                                        <a href="/berita/{{ $rn['kategori_berita'] ??''}}/{{ $rn['slug'] ??''}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a>
                                    </p>
                                    <div class="text-footer">
                                        {{-- <p class="font-semibold text-[#C95C66] pt-1">{{ $rn['kategori_berita'] ?? '' }}</p> --}}
                                    </div>
                                </a>
                            </div>
                        {{-- @endif --}}
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