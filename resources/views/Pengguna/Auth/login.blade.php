@extends('Template.nav')
    @section('container')
    <div class="wrapper vh-100">
  
      <div class="row align-items-center h-100">

      <div class="col-lg-3 col-md-4 col-10 mx-auto text-center">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center">
               <img src="{{ asset('assets/images/logo.png') }}" class="h-8" alt="Winni Code Logo" />
          </a>
          <h1 class="h6 mb-3">Masuk AKun</h1>
          @if(session()->has('message-error')) 
           <div class="alert alert-danger" role="alert"> {{session('message-error')}} </div>
          @endif  

        <form Action="/authLogin" Method="Post">
        @csrf
          <div class="form-group">
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" name="email"  id="inputEmail" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
        </form>

        <div class>
         <p class="text-center text-muted font-weight-normal pt-2">Belum Punya Akun ? <a href="/register" class="text-dark font-weight-bold text-decoration-none">DAFTAR AKUN</a></p>
            <a href="/lupa-password" class="text-danger font-weight-bold text-decoration-none">LUPA PASSWORD</a>
            <p class="mt-2 mb-3 text-muted">© 2025</p>
        </div>

      </div>

           
        
      </div>
    </div>
    