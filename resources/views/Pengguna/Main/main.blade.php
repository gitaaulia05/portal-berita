<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Portal Berita | WinniCode</title>
     @vite('resources/css/app.css')
     <style>
      div#social-links {
          margin: 0 auto;
          max-width: 500px;
      }
      div#social-links ul li {
          display: inline-block;
      }          
      div#social-links ul li a {
          padding: 20px;
          border: 1px solid #ccc;
          margin: 1px;
          font-size: 30px;
          color: #222;
          background-color: #ccc;
      }
  </style>
  </head> 
  <body>

<nav class="bg-black">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('assets/images/logo.png') }}" class="h-8" alt="Winni Code Logo" />
      <div class="flex flex-col items-start space-y-1">
        <div class="flex flex-row gap-0">
          <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#FF66C4]">Winni</span>
          <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#5271FF]">Code</span>
        </div>
        <p class="text-white mr-5">Garuda Teknologi</p>
      </div>
    </a>

    @if(!empty($auth))
      <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
            @if(!empty($auth['data']['gambar']))
          <img class="w-8 h-8 rounded-full" src="{{$url . '/storage/' . $auth['data']['gambar']}}" alt="user photo">
            @else
              <img class="w-8 h-8 rounded-full" src="{{asset('assets/avatars/face-1.jpg')}}" alt="user photo">
          @endif
        </button>

        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-black divide-y divide-gray-600 rounded-lg shadow-sm text-white" id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-white">{{$auth['data']['nama']}}</span>
            <span class="block text-sm text-gray-400 truncate">{{$auth['data']['email']}}</span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li><a href="/profile/pengguna" class="block px-4 py-2 text-sm hover:bg-gray-700">Profile</a></li>
              <form action="/logout" method="POST">
              @csrf
              @method('DELETE')
               <li><button type="submit" class="block px-4 py-2 text-sm hover:bg-gray-700">Logout</button></li>
              </form>
          </ul>
        </div>

        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
        </button>
      </div>
      @else
      <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse mx-5 cursor-pointer">
        <a class="text-white hover:text-[#FF66C4]" href="/login">Masuk Akun</a>
      </div>
  @endif

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
      <ul class="flex flex-col text-white font-medium p-4 md:p-0 mt-4 border border-gray-700 rounded-lg bg-black md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-black">
        <li><a href="/berita/Politik" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Politik</a></li>
        <li><a href="/berita/Teknologi" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Teknologi</a></li>
        <li><a href="/berita/Ekonomi" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Ekonomi</a></li>
        <li><a href="/berita/Olahraga" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Olahraga</a></li>
        <li><a href="/berita/Hiburan" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Hiburan</a></li>
      </ul>
    </div>
  </div>
</nav>



    <div class="main-container px-12 pt-10">
    @yield('container-main')
    </div>

    <footer class="bg-black text-white pb-10 pt-5 px-20 text-base">
        <div class="flex lg:flex-row flex-col-reverse lg:gap-36 gap-10 cursor-pointer" id="utama-grid">

          <div id="Tautan">
              <ul class="cursor-pointer">
                <li>
                  TAUTAN
                </li>
                <li>
                  <a class="flex gap-1" href="http://www.winnicode.com/">
                    <span>
                      <i class="fa-solid fa-globe"></i>
                    </span>
                    www.winnicode.com
                  </a>
                </li>
                <li class=" text-white">
                  <a class="flex gap-1" href="https://www.instagram.com/winnicodeofficial/">
                    <span>
                      <i class="fa-brands fa-instagram"></i>
                    </span>
                    Instagram
                  </a>
                </li>
              </ul>
          </div>

          <div id="Sitemap">
                <ul class="cursor-pointer ">
                  <li>SITEMAP</li>
                  <li><a href="https://winnicode.com/">Beranda</a></li>
                  <li><a href="https://winnicode.com/explore/berita">Berita</a></li>
                  <li><a href="https://winnicode.com/kontak-kami">Kontak Kami</a></li>
                  <li><a href="https://winnicode.com/privasi-policy">Privasi & Policy</a></li>
                  <li><a href="https://winnicode.com/tentang">Tentang</a></li>
              </ul>
          </div>

          <div id="Kontak">
            <ul>
              <li>KONTAK KAMI</li>
              <li><span class="font-semibold">E-Mail:</span> winnicodegarudaofficial@gmail.com</li>
              <li><span class="font-semibold">Call Center</span> 6285159932501 (24 Jam)</li>
              <li><span class="font-semibold">Alamat (Cabang Bandung):</span> Jl. Asia Afrika No.158, Kb. Pisang, Kec. Sumur Bandung,
                Kota Bandung, Jawa Barat 40261</li>
              <li><span class="font-semibold">Alamat (Cabang Yogyakarta):</span> Bantul, Yogyakarta</li>
              <li><span class="font-semibold">Alamat (Cabang Jakarta):</span> Bekasi, Jawa Barat</li>
              <li><span class="font-semibold">Administrasi Berkas:</span> Hubungi Admin Telp: +6285159932501</li>
          </ul>
      </div>


          <div id="logo">
            <div class="flex flex-row justify-center gap-3 lg:pt-0 pt-5">
              <img src="{{asset('assets/images/banner-logo.png')}}" class="lg:w-md w-3xs">
              <img src="{{asset('assets/images/bpd.png')}}" class="lg:w-[7rem] w-[7rem]">
            </div>
            <p class="hover:text-[#FF66C4]">
              Jurnalistik Program winnicode adalah program pengembangan sumber daya manusia yang ditujukan bagi pemuda pemudi yang berkarir di dunia report.
            </p>
          </div>

        </div>
        <hr class="bg-white mt-3">
        <p class="font-thin text-sm pt-5">Copyright © 2024 PT. WINNICODE GARUDA TEKNOLOGI</p>
    </footer>

 <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  @yield('scripts')
   
  </body>
</html>