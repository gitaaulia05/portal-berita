@extends('Pengguna.Main.main')

@section('container-main')

<div class="header-profile">

    <div class="notif-profile w-11/12 bg-[#F4F6F8] py-2 px-5 rounded-lg mb-13 font-semibold mx-auto" id="profile-notif">
        <div class="flex flex-row gap-2" id="content-profile-notif">
            <p class="text-[#C95C66] ">Profile</p>
            <i class="fa-solid fa-circle text-xs text-[#96CBFE] my-auto "></i>
            <p class="text-[#868686] ">Ganti Password Anda Dengan Ketentuan Dibawah</p>
        </div>
    </div>

    @if (session()->has('message-success') ||session()->has('message-error') )
            <div id="alert-3" class="flex items-center p-4 mb-4 {{session('message-success') ? 'text-green-800 bg-green-50' : 'text-red-800 bg-red-50'}}rounded-lg" role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
        {{session('message-success') ?? session('message-error')}}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    @endif

       <div class="header-change-password grid lg:grid-cols-3 grid-cols-1 gap-5 mb-3">
          <div class="header-images lg:block hidden">
            <img src={{!empty($auth['data']['gambar']) ? $auth['url'] . '/storage/' . $auth['data']['gambar'] : asset('assets/avatars/face-1.jpg')}} class="rounded-md w-md">
            <p class="font-semibold capitalize pt-4">{{$auth['data']['nama']}}</p>
            </div>
      
            <div class="col-span-2 mx-auto">
              <form method="POST" Action="/auth/store-newPassword/{{$token}}">
                @csrf
                @method('PATCH')
                <div class="flex flex-row justify-between">
                     <label for="password1" class="block my-3 text-sm font-medium text-gray-900">Password Baru</label>
                       <span class="flex flex-row gap-2 pt-2 cursor-pointer " id="eyeslash1" onclick="toogleColor(this, 'password1' , 'showEyelash1')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                        <span id="showEyelash1">Show</span>
                    </span>
                </div>

                <input type="password" id="password1" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block lg:w-xs w-full p-2.5" name="password" required />

                                <div class="flex flex-row justify-between">
                     <label for="password2" class="block my-3 text-sm font-medium text-gray-900">Konfirmasi Password Baru</label>
                       <span class="flex flex-row gap-2 pt-2 cursor-pointer " id="eyeslash2" onclick="toogleColor(this, 'password2', 'showEyelash2')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                        <span id="showEyelash2">Show</span>
                    </span>
                </div>
              
                <input type="password" id="password2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block lg:w-xs w-full p-2.5" name="password_confirmation" required />


                <div class="button-password my-5">
                    <button type="submit" class="bg-[#0E7CC9] py-1 px-3 text-white hover:scale-105 hover:opacity-90 transition duration-700 rounded-md lg:w-fit w-full">SIMPAN</button>
                </div>
             </form>
            </div>
  

       </div>

</div>
@endsection


    @section('scripts')
    <script>
        const eyelashState = {};
            function toogleColor(element, idInput) {
            eyelashState[idInput] = !eyelashState[idInput];

             element.classList.toggle("text-[#0E7CC9]");
             element.classList.toggle("fill-[#0E7CC9]");
             console.log(idInput);
             const pass1 = document.getElementById(idInput);
                pass1.type =eyelashState[idInput] ? 'text' : 'password'
            }
    </script>
    @endsection