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

       <div class="header-change-password grid lg:grid-cols-3 grid-cols-1 gap-3 mb-3">
            <div class="bg-amber-100">
            <img src={{!empty($auth['gambar']) ? $url . '/storage/' . $auth['gambar'] : asset('assets/avatars/face-2.jpg')}}>
            <p class="font-semibold capitalize">{{$auth['nama']}}</p>
            </div>
      
            <div class="col-span-2 bg-amber-300">
              <form method="POST" Action="/auth/store-newPassword/{{$token}}">
                @csrf
                @method('PATCH')
                <label for="password1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password 1</label>
                <input type="password" id="password1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="password" required />

                <label for="password2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password 1</label>
                <input type="password" id="password2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="password_confirmation" required />


                <div class="button-password m-3">
                    <button type="submit" class="bg-[#0E7CC9] p-1 text-white">SIMPAN</button>
                </div>
             </form>
            </div>
  

       </div>


@endsection