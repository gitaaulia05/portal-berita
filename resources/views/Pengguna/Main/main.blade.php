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

    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
      </button>

      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-black divide-y divide-gray-600 rounded-lg shadow-sm text-white" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-white">Bonnie Green</span>
          <span class="block text-sm text-gray-400 truncate">name@flowbite.com</span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li><a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700">Dashboard</a></li>
          <li><a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700">Settings</a></li>
          <li><a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700">Earnings</a></li>
          <li><a href="#" class="block px-4 py-2 text-sm hover:bg-gray-700">Sign out</a></li>
        </ul>
      </div>

      <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
      <ul class="flex flex-col text-white font-medium p-4 md:p-0 mt-4 border border-gray-700 rounded-lg bg-black md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-black">
        <li><a href="#" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Politik</a></li>
        <li><a href="#" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Teknologi</a></li>
        <li><a href="#" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Ekonomi</a></li>
        <li><a href="#" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Olahraga</a></li>
        <li><a href="#" class="block py-2 px-3 md:p-0 hover:text-[#FF66C4]">Hiburan</a></li>
      </ul>
    </div>
  </div>
</nav>



    <div class="main-container px-12 pt-10">
    @yield('container-main')
    </div>

    <footer class="bg-black text-white pb-10 pt-5 px-20">
        <div class="flex lg:flex-row flex-col-reverse lg:gap-36 gap-2" id="utama-grid">

          <div id="Tautan">
              <ul>
                <li>hm</li>
                <li>hm</li>
              </ul>
          </div>

          <div id="Sitemap">
                <ul>
                  <li>hm</li>
                  <li>hm</li>
              </ul>
          </div>

          <div id="Kontak">
                <ul>
                  <li>hm</li>
                  <li>hm</li>
              </ul>
          </div>

          <div id="logo">
            <div class="flex flex-row justify-center gap-3 lg:pt-0 pt-5">
              <img src="{{asset('assets/images/banner-logo.png')}}" class="lg:w-32 w-40">
              <img src="{{asset('assets/images/bpd.png')}}" class="lg:w-32 w-40">
            </div>
          </div>

        </div>
        <hr class="bg-white mt-3">
        <p class="font-thin text-sm pt-5">Copyright © 2024 PT. WINNICODE GARUDA TEKNOLOGI</p>
    </footer>

 <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  @yield('scripts')
   
  </body>
</html>