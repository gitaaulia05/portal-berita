@extends('Template.nav')
    @section('container-main')
    <div class="wrapper vh-100">
  
      <div class="row align-items-center h-100">

      <div class="col-lg-3 col-md-4 col-10 mx-auto text-center">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
            <img src="{{ asset('assets/images/logo.png') }}" class="h-8" alt="Winni Code Logo">
          </a>
          <h1 class="h6 mb-3">Sign in</h1>
          @if(session()->has('message-error')) 
           <div class="alert alert-danger" role="alert"> {{session('message-error')}} </div>
          @endif  

        <form Action="/authAdmin" Method="POST">
        @csrf
          <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email"  id="inputEmail" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
        </form>
      </div>

           
        
      </div>
    </div>
  @endsection