@extends('Pengguna.Main.main')

@section('container-main')
<div class="header-profile">

    <div class="notif-profile w-11/12 bg-[#F4F6F8] py-2 px-5 rounded-lg mb-13 font-semibold mx-auto" id="profile-notif">
        <div class="flex flex-row gap-2" id="content-profile-notif">
            <p class="text-[#C95C66] ">Profile</p>
            <i class="fa-solid fa-circle text-xs text-[#96CBFE] my-auto "></i>
            <p class="text-[#868686] ">Ubah Data Informasi Akun</p>
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

         <div class="header-change-password grid lg:grid-cols-3  md:grid-cols-3 grid-cols-1 gap-3 mb-3">
            <div class="mx-auto my-auto">
            <img src="{{!empty($auth['gambar']) ? $url . '/storage/' . $auth['gambar'] : asset('assets/avatars/face-1.png')}}" class="w-2xs ">
            <p class="font-semibold capitalize">{{$auth['data']['nama']}}</p>
            </div>
      
            <div class="col-span-2 lg:w-md  md:w-md w-xs mx-5 py-7">
              <form method="POST" Action="/profile/storeUpdate/{{$auth['data']['slug']}}" enctype="multipart/form-data">
                @csrf

             <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $auth['data']['nama']) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nama') border-red-500 @enderror" required />
            @error('nama')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 my-5">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $auth['data']['alamat'] )}}" placeholder="{{$auth['data']['alamat']}}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('alamat') border-red-500 @enderror" required />

                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="pendidikan_terakhir" class="block mb-2 text-sm font-medium text-gray-900 my-5">Pendidikan Terakhir</label>
                    <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $auth['data']['pendidikan_terakhir'] )}}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('pendidikan_terakhir') border-red-500 @enderror" required />

                    @error('pendidikan_terakhir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="pekerjaan" class="block mb-2 text-sm font-medium my-5">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $auth['data']['pekerjaan'] ?? '') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('pekerjaan') border-red-500 @enderror" required />
                    @error('pekerjaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Gambar</label>
                    <input type="file" id="gambar" name="gambar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('gambar') border-red-500 @enderror" />
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

               <button class="text-red-500 underline underline-offset-1 mt-3" >Hapus Foto Profile</button>

                <div class="button-password my-5 flex justify-center">
                    <button type="submit" class="bg-[#0E7CC9] px-17 py-1 mx-auto hover:opacity-75 transition duration-700 text-white rounded-md p">SIMPAN</button>
                </div>
             </form>
            </div>
  

       </div>
</div>

@endsection