    @extends('Pengguna.Template.nav')

    @section('container')
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">

        <form class="col-lg-6 col-md-8 col-10 mx-auto" Method="POST" action="/simpan-akun">
        @csrf
          <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <img src="{{asset('assets/images/logo.png')}}" class="">
            </a>
            <h2 class="my-3">Register</h2>
          </div>
        <div class="form-group">
    <label for="inputEmail4">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail4" value="{{ old('email') }}" required>
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
          <div class="form-row">
           <div class="form-group">
    <label for="firstname">Nama Lengkap</label>
    <input type="text" id="firstname" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
           
          </div>
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
              <p class="mb-2">Password requirements</p>
              <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
              <ul class="small text-muted pl-4 mb-0">
                <li> Minimum 8 character </li>
                <li>At least one special character</li>
                <li>At least one number</li>
                <li>Can’t be the same as a previous password </li>
              </ul>
            </div>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
          <p class="mt-5 mb-3 text-muted text-center">© 2025</p>
        </form>
      </div>
    </div>
