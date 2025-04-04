@extends('Pengguna.Main.main')

@section('container-main')


    <div class="lg:grid lg:grid-cols-3 gap-4 lg:max-h-fit overflow-auto" id="header-top">

        <div id="controls-carousel col-span-2 z-[-999]" class="relative w-full col-span-2" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
             @foreach ($headerNews as $hn)

                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{$url.'/storage/'.$hn['gambar']['0']['gambar_berita']}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="caraousel-caption  relative mb-3">
                        <div class="lg:max-w-2xs max-w-[10rem] overflow-auto lg:max-h-[20rem] max-h-[10rem] p-6 absolute left-5 lg:top-15 top-4  bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="#">
                                <h5 class="mb-2 lg:text-lg text-2xs font-bold tracking-tight text-gray-900 ">{{$hn['judul_berita']}}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 lg:text-sm text-[0.50rem]"> {{ \Illuminate\Support\Str::words($hn['deks_berita'], 10) }} <span class="text-[#B03440]">{{$hn['updated_at']}}</span></p>
                            <a href="/berita/{{$hn['kategori_berita'][0]['kategori']}}/{{$hn['slug']}}" class="inline-flex items-center px-3 py-2 lg:text-sm text-[0.60rem] font-medium text-center text-white bg-[#C95C66] rounded-lg hover:bg-opacity-25 focus:ring-4 focus:outline-none focus:ring-blue-30">
                                Baca Selengkapnya
                            </a>
                        </div>
                       
                    </div>
                </div>

             @endforeach
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
                                <h1 class="lg:text-md">  {{ \Illuminate\Support\Str::words($sn['judul_berita'], 7) }} <a href="/berita/{{$sn['kategori_berita'][0]['kategori']}}/{{$sn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></h1>
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
            {{-- END GRID NEWS --}}
            <div>
            </div>

        {{-- END CARD NEWS --}}
        </div>

    </div>

    <div class="Berita Terbaru pt-8 mb-20" id="berita-terbaru">
        <h1 class="pb-3 font-bold text-3xl">BERITA TERBARU</h1>

        <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 lg:gap-5 gap-2 pt-2">
        @foreach ($newNews as $nn)
            <div class="header-card-content cursor-pointer">
                <img src="{{$url . '/storage/' . $nn['gambar'][0]['gambar_berita']}}" class="hover:opacity-50 transition duration-700">
                   <div class="logo-top-news flex gap-3 pt-2">
                            <img src="{{asset('assets/images/logo.png')}}" class="w-6 h-6 rounded-full border-1">
                            <p class="font-semibold">WinniCode</p>
                    </div>
                <p>{{$sn['judul_berita']}} <a href="/berita/{{$nn['kategori_berita'][0]['kategori']}}/{{$nn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></p>
                <div class="text-footer">
                    <p class="font-semibold text-[#C95C66] pt-1">{{$sn['kategori_berita'][0]['kategori']}}</p>
                </div>
            </div> 
   @endforeach

        </div>

    </div>

    <div class="lg:grid lg:grid-cols-3 pb-8 gap-4" id="header-second">

        <div id="controls-carousel col-span-2 z-[-999]" class="relative w-full col-span-2 mx-0" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('assets/images/flooding.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="caraousel-caption  relative mb-3">
                        <div class="lg:max-w-2xs max-w-[10rem] overflow-auto lg:max-h-[20rem] max-h-[10rem] p-6 absolute left-5 lg:top-15 top-4  bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="#">
                                <h5 class="mb-2 lg:text-lg text-2xs font-bold tracking-tight text-gray-900 ">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 lg:text-sm text-[0.50rem]">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order <a href="#" class="text-[#B03440]">3 menit yang laluu</a></p>
                            <a href="#" class="inline-flex items-center px-3 py-2 lg:text-sm text-[0.60rem] font-medium text-center text-white bg-[#C95C66] rounded-lg hover:bg-opacity-25 focus:ring-4 focus:outline-none focus:ring-blue-30">
                                Baca Selengkapnya
                            </a>
                        </div>
                       
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('assets/images/flooding.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="caraousel-caption  relative mb-3">
                        <div class="lg:max-w-2xs max-w-[10rem] overflow-auto lg:max-h-[20rem] max-h-[10rem] p-6 absolute left-5 lg:top-15 top-4  bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="#">
                                <h5 class="mb-2 lg:text-lg text-2xs font-bold tracking-tight text-gray-900 ">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 lg:text-sm text-[0.50rem]">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order <a href="#" class="text-[#B03440]">3 menit yang laluu</a></p>
                            <a href="#" class="inline-flex items-center px-3 py-2 lg:text-sm text-[0.60rem] font-medium text-center text-white bg-[#C95C66] rounded-lg hover:bg-opacity-25 focus:ring-4 focus:outline-none focus:ring-blue-30">
                                Baca Selengkapnya
                            </a>
                        </div>
                       
                    </div>
                </div>
                <!-- Item 3 -->
               
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('assets/images/flooding.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="caraousel-caption  relative mb-3">
                        <div class="lg:max-w-2xs max-w-[10rem] overflow-auto lg:max-h-[20rem] max-h-[10rem] p-6 absolute left-5 lg:top-15 top-4  bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="#">
                                <h5 class="mb-2 lg:text-lg text-2xs font-bold tracking-tight text-gray-900 ">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 lg:text-sm text-[0.50rem]">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order <a href="#" class="text-[#B03440]">3 menit yang laluu</a></p>
                            <a href="#" class="inline-flex items-center px-3 py-2 lg:text-sm text-[0.60rem] font-medium text-center text-white bg-[#C95C66] rounded-lg hover:bg-opacity-25 focus:ring-4 focus:outline-none focus:ring-blue-30">
                                Baca Selengkapnya
                            </a>
                        </div>
                       
                    </div>
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{asset('assets/images/flooding.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="caraousel-caption  relative mb-3">
                        <div class="lg:max-w-2xs max-w-[10rem] overflow-auto lg:max-h-[20rem] max-h-[10rem] p-6 absolute left-5 lg:top-15 top-4  bg-white border border-gray-200 rounded-lg shadow-sm">
                            <a href="#">
                                <h5 class="mb-2 lg:text-lg text-2xs font-bold tracking-tight text-gray-900 ">Noteworthy technology acquisitions 2021</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 lg:text-sm text-[0.50rem]">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order <a href="#" class="text-[#B03440]">3 menit yang laluu</a></p>
                            <a href="#" class="inline-flex items-center px-3 py-2 lg:text-sm text-[0.60rem] font-medium text-center text-white bg-[#C95C66] rounded-lg hover:bg-opacity-25 focus:ring-4 focus:outline-none focus:ring-blue-30">
                                Baca Selengkapnya
                            </a>
                        </div>
                       
                    </div>
                </div>
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

                 <div class="grid grid-cols-3 max-h-36 overflow-auto gap-1">

                    <div class="image-news">
                    <img src="{{asset('assets/images/flooding.jpg')}}" class="rounded-sm">
                    </div>

                    <div class="header-top-news col-span-2 ">
                        <div class="logo-top-news flex gap-3">
                            <img src="{{asset('assets/images/logo.png')}}" class="w-6 h-6 rounded-full border-1">
                            <p class="font-semibold">WinniCode</p>
                        </div>
                         <div class="hot-judul-news">
                            <h1 class="lg:text-md">Lorem Ipsum is simply dummy text of the printing 
                            and typesetting industry. <a href="#" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></h1>
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
          
            {{-- END GRID NEWS --}}
            <div>
            </div>

        {{-- END CARD NEWS --}}
        </div>

    </div>

    <div class="Berita Terbaru pt-8 mb-20" id="berita-terpopuler-weeks">
        <h1 class="pb-3 font-bold text-3xl">BERITA TERPOPLER MINGGU INI</h1>

        <div class="card-new-news grid lg:grid-cols-4 grid-cols-2 gap-2 pt-2">
            <div class="header-card-content hover:scale-105 transition duration-700">
                <img src="{{asset('assets/images/image.png')}}">
                   <div class="logo-top-news flex gap-3 pt-2">
                            <img src="{{asset('assets/images/logo.png')}}" class="w-6 h-6 rounded-full border-1">
                            <p class="font-semibold">WinniCode</p>
                    </div>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="#" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></p>
                <div class="text-footer">
                    <p class="font-semibold text-[#C95C66] pt-1">Ekonomi</p>
                </div>
            </div> 
        </div>

    </div>
@endsection