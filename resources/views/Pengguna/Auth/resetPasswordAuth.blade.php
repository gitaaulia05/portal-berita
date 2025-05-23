@extends($layout)
    @section('container-main')

    <form action="{{ url ('/auth/store-newPassword/' . $token)}}" method="POST" enctype="multipart/form-data">
       @csrf
        @method('PATCH')
  <h1 class="text-center pb-2">UBAH PASSWORD</h1>
         @if(session()->has('message-success') || session()->has('message-error')) 

                                <div class="alert {{session('message-success') ? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
                                  <strong>{{session('message-success') ?? session('message-error')}}</strong> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif  

  <div class="row">
        <div class="form-group col-md-6">
        {{-- Password --}}
        <div class="form-group">
            <label for="inputPassword">Password Baru</label>
            <input type="password" 
                  class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Ulangi Password --}}
        <div class="form-group">
            <label for="inputPasswordConfirmation">Ulangi Password</label>
            <input type="password" 
                  class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="inputPasswordConfirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>


        <div class="form-group col-md-6 mt-md-0 mt-5">
               <p class="mb-2">Persyaratan Kata Sandi</p>
                  <p class="small text-muted mb-2"> Untuk membuat kata sandi baru, Anda harus memenuhi semua persyaratan berikut: </p>
                  <ul class="small text-muted pl-4 mb-0">
                    <li> Minimal 8 karakter </li>
                    <li>Minimal satu karakter khusus</li>
                    <li>Minimal satu angka</li>
                    <li>Minimal satu Huruf Besar</li>
                  </ul>         
          </div>
        </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    @endsection