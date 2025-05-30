 @extends('Pengguna.Main.main')

@section('container-main')

    <div class="Berita Terbaru pt-8 mb-20" id="berita-terbaru">
            <div class="card-new-news w-6xl  grid lg:grid-cols-5 grid-cols-2 gap-2 pt-2">
              @foreach ($kategori as $k)
                    <div class="header-card-content hover:scale-95 transition duration-700">
                    <a href="/berita/{{$k['kategori_berita']}}/{{$k['slug']}}">
                        <img src="{{ ($k['gambar']) ? $url . '/storage/' . $k['gambar'][0]['gambar_berita'] : asset('assets/images/dummy.jpg')}}">
                        <p>{{$k['judul_berita']}} <a href="/berita/{{$k['kategori_berita']}}/{{$k['slug']}}" class="text-[#C95C66] hover:text-[#B03440]">Baca Selengkapya</a></p>
                        <div class="text-footer">
                            <p class="font-semibold text-[#C95C66] pt-1">{{$k['kategori_berita']}}</p>
                        </div>
                    </a>
                    </div> 
                 @endforeach
            </div>
          
    </div>

   
     <nav aria-label="Page navigation example" class="flex justify-center mb-4">
            <ul class="inline-flex -space-x-px text-sm">
             @foreach ($meta['links'] as $link)
                @if ($link['url'])
                    <li>
                    <a href="/beritaKategori/{{$slug}}/{{$link['label']}}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500  border border-gray-300 hover:bg-gray-100 hover:text-gray-700  {{ $link['label'] == $page ? 'bg-gray-100' : 'bg-white' }}">{{is_numeric($link['label']) ? $link['label'] : ($link['label'] == 'pagination.previous' ? 'Halaman sebelumnya' : 'Halaman Selanjutnya') }}</a>
                    </li>
                @endif
            @endforeach
            </ul>
    </nav>

@endsection