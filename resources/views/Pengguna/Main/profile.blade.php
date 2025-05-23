@extends('Pengguna.Main.main')

@section('container-main')
<div class="header-profile">

    <div class="notif-profile w-11/12 bg-[#F4F6F8] py-2 px-5 rounded-lg mb-13 font-semibold mx-auto" id="profile-notif">
        <div class="flex flex-row gap-2" id="content-profile-notif">
            <p class="text-[#C95C66]">Profile</p>
            <i class="fa-solid fa-circle text-xs text-[#96CBFE] my-auto"></i>
            <p class="text-[#868686]">Anda Bisa Melihat Berita yang tersimpan Disebelah Kanan dan Data Akun Pribadi Disebelah Kiri</p>
        </div>
    </div>

    @if (session()->has('message-success') || session()->has('message-error'))
        <div id="alert-3" class="flex items-center p-4 mb-4 {{ session('message-success') ? 'text-green-800 bg-green-50' : 'text-red-800 bg-red-50' }} rounded-lg" role="alert">
            <svg class="shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('message-success') ?? session('message-error') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif

    <div class="main-content grid lg:grid-cols-5 md:grid-cols-5 grid-cols-1 lg:gap-4 gap-3 pb-8" id="main-section">
        <div class="col-span-2">
            <div class="profile-header" id="first-profile">
                <img src="{{ $auth['data']['gambar'] ? $url .'/storage/'.$auth['data']['gambar']  : asset('assets/avatars/face-1.png') }}" class="rounded-md w-[10rem]">
                <h1 class="capitalize py-2 font-semibold">{{ $auth['data']['nama'] }}</h1>
                <a href="/profile/ganti-password" class="bg-[#C95C66] opacity-75 rounded-md px-1 py-1 w-fit text-white cursor-pointer text-md hover:opacity-100">Ganti password</a>
            </div>

            <div class="detail-akun cursor-default" id="account-detail">
                <div class="flex flex-row gap-2 pt-3" id="text-akun">
                    <span class="my-auto" id="logo">
                        <svg class="w-4 h-4 text-[#B7B7B7] border-2 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
                        </svg>
                    </span>
                    <p class="text-md font-semibold">Detail Akun</p>
                    <a href="/profile/ubah-data/{{ $auth['data']['slug'] }}" class="text-sm ms-10 bg-blue-300 rounded-md px-2 hover:scale-95 transition duration-700">Update Informasi Akun</a>
                </div>

                <div class="info-akun" id="primary-info">
                    <div class="flex flex-row gap-4 pt-2">
                        <div class="text-[#9E9E9E]">
                            <p>Email</p>
                            <p>Pekerjaan</p>
                            <p>Alamat</p>
                        </div>

                        <div class="font-medium">
                            <p class="text-[#8DADF2]">{{ $auth['data']['email'] }}</p>
                            <p class="{{ empty($auth['data']['pekerjaan']) ? 'text-[#C95C66]' : 'text-[#8DADF2]' }}">
                                {{ !empty($auth['data']['pekerjaan']) ? $auth['data']['pekerjaan'] : 'Lengkapi Pekerjaan Anda' }}
                            </p>
                            <p class="{{ empty($auth['data']['alamat']) ? 'text-[#C95C66]' : 'text-[#8DADF2]' }}">
                                {{ !empty($auth['data']['alamat']) ? $auth['data']['alamat'] : 'Lengkapi Alamat Anda' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BERITA TERSIMPAN -->
        <div class="berita-tersimpan col-span-3" id="save-news">
            @livewire('save-news')
        </div>
    </div>
</div>
@endsection
