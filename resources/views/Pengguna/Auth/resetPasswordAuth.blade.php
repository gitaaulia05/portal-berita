@extends($layout)
    @section('container-main')
    <div class="wrapper vh-100">
  
      <div class="row align-items-center h-100">

      <div class="col-lg-3 col-md-4 col-10 mx-auto text-center">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg>
          </a>
          <h1 class="h6 mb-3">Reset Password</h1>
          @if(session()->has('message-error')) 
           <div class="alert alert-danger" role="alert"> {{session('message-error')}} </div>
          @endif  

        <form Action="{{ url ('/auth/store-newPassword/' . $token)}}" Method="POST">
        @csrf
        @method('PATCH')
     
       <div class="form-row">

          <hr class="my-4">
          <div class="row mb-4">
            <div class="col-md-6">
            <div class="form-group">
                  <label for="inputPassword5">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword5" required>
                  @error('password')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
          </div>
              <div class="form-group">
                <label for="inputPassword6">Ulangi Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="inputPassword6" required>
            </div>
          </div>
            <div class="col-md-6">
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
            <button class="btn btn-lg btn-primary btn-block" type="submit">Simpan</button>
            <p class="mt-5 mb-3 text-muted text-center">© 2025</p>

    </div>
        </form>
      </div>

           
        
      </div>
    </div>
    
    @endsection