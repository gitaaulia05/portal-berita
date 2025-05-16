@extends('Template.aside')

@section('container-main')

<h2 class="h4 mb-1">Tabel Berita</h2>
        @if(session()->has('message-success') || session()->has('message-error'))
            <div class="alert {{ session()->has('message-success')? 'alert-success' : 'alert-danger '}} alert-dismissible fade show" role="alert">
                <strong class="text-center">{{session('message-success') ?? session('message-error') }}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

@livewire('kategori-berita-l')

        
@endsection

