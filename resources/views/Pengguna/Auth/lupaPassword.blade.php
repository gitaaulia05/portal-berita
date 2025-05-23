@extends($layout)
    @section('container-main')
  <div class="wrapper vh-100">

      <div class="row align-items-center h-100 mt-0">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" Action="{{ !empty($auth) ?  '/auth/lupa-password' :  '/lupa-password-email'}}" Method="POST" >
        @csrf
          <div class="mx-auto text-center my-4">
            @if (empty($auth))
               <img src="{{ asset('assets/images/logo.png') }}" class="h-8" alt="Winni Code Logo">
            @endif
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