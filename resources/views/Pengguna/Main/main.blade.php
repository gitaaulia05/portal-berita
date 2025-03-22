<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       @vite('resources/css/app.css')

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Portal Berita | WinniCode</title>
  </head>
  <body>

<h1 class="font-light">HMMM</h1>

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
  <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">Default</span>
  <div class="container notify-message pt-5">
    @if(session()->has('message-error') || session()->has('message-success') ) 
           <div class="alert {{ session('message-success') ? 'alert-success' : 'alert-danger'}}" role="alert"> {{session('message-success') ?? session('message-error')  }} </div>
        
          @endif 
        
  </div>
    <div class="main-container px-8">
    @yield('container')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
   
  </body>
</html>