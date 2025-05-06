@extends('Pengguna.Main.main')

@section('container-main')

{{-- @dd($headerNews) --}}

    <div class="lg:grid lg:grid-cols-3 gap-4 lg:max-h-fit overflow-auto" id="header-top">

        <div id="controls-carousel col-span-2 z-[-999]" class="relative w-full col-span-2" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
             @if (!empty($headerNews))
                    @foreach ($headerNews as $hn)
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>

                            <img src="{{ $hn['gambar'][0]['gambar_berita'] ? $url.'/storage/'.$hn['gambar'][0]['gambar_berita'] : asset('assets/images/bpd.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                            <div class="caraousel-caption  relative mb-3">
                                <div class="lg:max-w-2xs max-w-[10rem] overflow-auto lg:max-h-[20rem] max-h-[10rem] p-6 absolute left-5 lg:top-15 top-4  bg-white border border-gray-200 rounded-lg shadow-sm">
                                    <a href="#">
                                        <h5 class="mb-2 lg:text-lg text-2xs font-bold tracking-tight text-gray-900 ">{{$hn['judul_berita']}}</h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 lg:text-sm text-[0.50rem]"> {!! Illuminate\Support\Str::words($hn['deks_berita'], 10)  !!} <span class="text-[#B03440]">{{$hn['updated_at']}}</span></p>
                                    <a href="/berita/{{$hn['kategori_berita']}}/{{$hn['slug']}}" class="inline-flex items-center px-3 py-2 lg:text-sm text-[0.60rem] font-medium text-center text-white bg-[#C95C66] rounded-lg hover:bg-opacity-25 focus:ring-4 focus:outline-none focus:ring-blue-30">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

        <div class="card-news-top-news lg:mt-0 mt-3">
            @if(!empty($sideNews))
               @foreach ($sideNews as $sn)
                 <div class="grid grid-cols-3 max-h-36  gap-1 pb-5">
        
                        <div class="image-news">                
                                   <img src="{{$url . '/storage/'  . $sn['gambar'][0]['gambar_berita']}}" class="rounded-sm">
                        </div>

                        <div class="header-top-news col-span-2 ">
                            <div class="logo-top-news flex gap-3">
                                <img src="{{asset('assets/images/logo.png')}}" class="w-6 h-6 rounded-full border-1">
                                <p class="font-semibold">WinniCode</p>
                            </div>
                            <div class="hot-judul-news">
                                <h1 class="lg:text-md">  {{ \Illuminate\Support\Str::words($sn['judul_berita'], 7) }} <a href="/berita/{{$sn['kategori_berita']}}/{{$sn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></h1>
                            </div>
                            <div class="footer-top-news pt-[0.20rem]">
                                <div class="flex gap-3">
                                <p class="text-[#C95C66]">Olahraga</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  class="w-3 pt-1"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" class=" fill-[#A5A5A5]"/></svg>
                                <p class="text-sm pt-1">3 Menit yang lalu</p>
                                </div>
                            </div>
                        </div>
                  
                {{-- END COLS GRID --}}
                </div>
                 @endforeach
            @endif
            {{-- END GRID NEWS --}}
            <div>
            </div>

        {{-- END CARD NEWS --}}
        </div>

    </div>

    <div class="Berita Terbaru pt-8 mb-20 font-roboto" id="berita-terbaru">
        <h1 class="pb-3 font-medium text-3xl">Berita Terbaru</h1>

        <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 lg:gap-5 gap-2 pt-2">
        @if (!empty($newNews))
            @foreach ($newNews as $nn)
                <div class="header-card-content cursor-pointer">
                    <img src="{{$url . '/storage/' . $nn['gambar'][0]['gambar_berita']}}" class="rounded-lg hover:opacity-50 transition duration-700">
                    <p>{{$sn['judul_berita']}} <a href="/berita/{{$nn['kategori_berita']}}/{{$nn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></p>
                    <div class="text-footer">
                        <p class="font-semibold text-[#C95C66] pt-1">{{$sn['kategori_berita']}}</p>
                    </div>
                </div> 
            @endforeach
        @endif
        </div>

    </div>


    <div class="pt-8 mb-20" id="berita-pilihan">
        <h1 class="text-2xl font-semibold mb-7">TOPIK PILIHAN</h1>
             <div class="grid lg:grid-cols-5 grid-cols-1 lg:gap-5 gap-3">
                @foreach ($topicSelected as $kategori => $beritaList)
                 @php
                     $beritaUtama  = $beritaList[0] ?? null;
                     $sisaBerita = array_slice($beritaList, 1);
                 @endphp
                    <div class="card-topik-pilihan">
                        @if($beritaUtama)
                            <figure class="relative max-w-sm cursor-pointer">
                            <a href="#">
                                {{-- <img class="rounded-lg" src="{{$url . '/storage/' . $beritaUtama['gambar'][0]['gambar_berita'] }}" alt="image description"> --}}
                            </a>
                            <figcaption class="absolute px-4 text-lg text-white bottom-0 bg-black opacity-70">
                                <p class="text-xs">{{$beritaUtama['judul_berita']}}</p>
                            </figcaption>
                            </figure>

                        @endif
                        <ul>
                        @foreach ($sisaBerita as $sb)
                            <li class="cursor-pointer"><a class="hover:text-slate-950 font-semibold">{{$sb['judul_berita']}}</a></li>
                            <hr class="mb-3">
                        @endforeach
                        </ul>
                    </div>
                      
                @endforeach
             </div>

    </div>



    {{-- <div class=" pt-8 mb-20" id="berita-terpopuler-weeks">
        <h1 class="pb-3 font-bold text-3xl">BERITA TERPOPLER MINGGU INI</h1>

            <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 gap-2 pt-2">
              @foreach ($popularNews as $pn)
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
        
    </div> --}}
@endsection