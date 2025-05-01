<div>
    <h1 class="font-semibold text-xl my-10">BERITA TERSIMPAN</h1>
                         <div class="relative lg:w-md w-xs" id="search-input">
                             <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                             <input type="text" id="search" class="block w-full  p-1 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari Berita Tersimpan" required wire:model.live="search" />
                        </div>  

                            <div class="card-news-save grid lg:grid-cols-3 lg:gap-3 grid-cols-2" id="card-news-save">
                                @foreach ($data as $nn)
                                    <div class="card-new-news w-[10rem] pt-3">                                      
                                        <div class="header-card-content cursor-pointer ">
                                            <img src="{{$url . '/storage/' . $nn['gambar'][0]['gambar_berita']}}" class="rounded-lg hover:opacity-50 transition duration-700 h-md">
                                            <p class="text-black">{{$nn['judul_berita']}} <a href="/berita/{{$nn['kategori_berita']}}/{{$nn['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapnya</a></p>
                                            <div class="text-footer">
                                                <p class="font-semibold text-[#C95C66] pt-1">{{$nn['kategori_berita']}}</p>
                                            </div>
                                        </div> 
                                    </div>
                                    @endforeach
                            </div>
</div>
