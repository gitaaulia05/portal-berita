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
 {{-- @if (isset($auth))
            <p class="mt-2">{{$auth['nama']}}</p>
             <form action="/logout" method="POST">
           @csrf
           @method('DELETE')
           <button type="submit">Logout</button>
           </form>
            <a href="/lupa-passwordAuth" class="mt-2">Lupa Password<p>
          
         @else
           <a class="nav-link" href="/login">
          login
        </a>
        
          @endif --}}
          

<nav class="bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
  </a>
  <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

      <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Get started</button>
       
       @if (isset($auth))
            <p class="mt-2">{{$auth['nama']}}</p>
             <form action="/logout" method="POST">
           @csrf
           @method('DELETE')
           <button type="submit">Logout</button>
           </form>
            <a href="/lupa-passwordAuth" class="mt-2">Lupa Password<p>
          
         @else
           <a class="nav-link" href="/login">
          login
        </a>
        
          @endif

      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
    <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
      <li>
        <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">About</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Services</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Contact</a>
      </li>
    </ul>
  </div>
  </div>
</nav>



  <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">Default</span>
  <div class="container notify-message pt-5">
    @if(session()->has('message-error') || session()->has('message-success') ) 
           <div class="alert {{ session('message-success') ? 'alert-success' : 'alert-danger'}}" role="alert"> {{session('message-success') ?? session('message-error')  }} </div>
        
          @endif 
        
  </div>
    <div class="main-container px-8 pt-10">
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
   
  </body>
</html>