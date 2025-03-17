   @extends('Template.aside')
   @section('container-main')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="h3 mb-4 page-title">Profile</h2>
              <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                </div>
                <div class="col">
                  <div class="row align-items-center">
                    <div class="col-md-7">
                      <h4 class="mb-1">{{$admin['nama']}}</h4>
                      <p class="small mb-3"><span class="badge badge-dark">@if ($admin['role'] == 1)
                          Administrator
                          @else
                          Jurnalis
                      @endif</span></p>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-7">
                      <p class="text-muted"><span class="text-dark font-weight-bold">{{$greetings}}</span>  {{$admin['nama']}} Happy Working </p>
                    </div>
                  </div>
                </div>
              </div>
           
            
            </div> <!-- /.col-12 -->
          </div> <!-- .row -->
        </div>
   @endsection