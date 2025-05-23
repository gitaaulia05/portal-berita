   
   @extends($layout)
   @section('container-main')

    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center">
          <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center">
              <img src="{{ asset('assets/images/logo.png') }}" class="h-8" alt="Winni Code Logo">
            </a>
            <h4 class="my-3">Reset Password Berhasil</h4>
          </div>
          <div class="alert alert-success" role="alert">{{$message1}} <strong>{{$email}}</strong>. {{$message2}} </div>
          <a href="{{ isset($auth) && $auth['role'] === 1 ? url('/dashboard') : (isset($auth) && $auth['role'] === 2 ? url('/dashboard-jurnalis') : url('/')) }}" 
   class="btn btn-lg btn-primary btn-block">
   {{ isset($auth) ? 'Kembali ke profile' : 'Kembali Kehalaman Login' }}
</a>
          <p class="mt-5 mb-3 text-muted">© 2025</p>
        </form>
      </div>
    </div>   
    
    @endsection