@extends($layout)
    @section('container-main')
  <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" Action="{{ !empty($auth) ?  '/auth/lupa-password' :  '/lupa-password-email'}}" Method="POST" >
        @csrf
          <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
            
            <h2 class="my-3">Ganti Password</h2>
          </div>
          <p class="text-muted">MASUKKAN EMAIL YANG TERDAFTAR</p>
          @if (session()->has('message-error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('message-error')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          @endif
          
          <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control form-control-lg" name="email" placeholder="Email address" required="" autofocus="">
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Kirim Kode</button>
          <p class="mt-5 mb-3 text-muted">© 2025</p>
        </form>
      </div>
    </div>
  @endsection 