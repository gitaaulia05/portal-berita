@extends('Template.asideJ')

@section('container-main')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="h3 mb-4 page-title">Profile</h2>
              <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <img src="{{ empty($jurnalis['gambar']) ? asset('assets/avatars/face-1.jpg') : $Url . '/storage/' . $jurnalis['gambar']}}" alt="..." class="avatar-img rounded-sm">
                  </div>
                </div>
                <div class="col">
                  <div class="row align-items-center">
                    <div class="col-md-7">
                      <h4 class="mb-1">{{$jurnalis['nama']}}</h4>
                      <p class="small mb-3"><span class="badge badge-dark">Jurnalis</span></p>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-7">
                      <p class="text-muted"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea dictumst. Cras urna quam, malesuada vitae risus at, pretium blandit sapien. </p>
                    </div>
                    <div class="col">
                      <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                      <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                      <p class="small mb-0 text-muted">(537) 315-1481</p>
                    </div>
                  </div>
                </div>
              </div>

           @if(session()->has('message-success') || session()->has('message-error')) 

                                <div class="alert {{session('message-success') ?? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
                                  <strong>{{session('message-success') ?? session('message-error')}}</strong> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            @endif  
                             
              <div class="row my-4">
                <div class="col-md-4">
                  <div class="card mb-4 shadow">
                    <div class="card-body my-n3">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-lg bg-light">
                            <i class="fe fe-shield fe-24 text-primary"></i>
                          </span>
                        </div> <!-- .col -->
                        <div class="col">
                          <a href="#">
                            <h3 class="h5 mt-4 mb-1">Keamanan Akun</h3>
                          </a>
                          <p class="text-muted">Ganti Password dapat dilakukan di halaman login, Anda harus logout terlebih dahulu.</p>
                        </div> <!-- .col -->
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                    <div class="card-footer">
                   
                      <a href="/lupa-passwordAuth" class="d-flex justify-content-between text-muted">Ganti password</a>

                    </div> <!-- .card-footer -->
                  </div> <!-- .card -->
                </div> <!-- .col-md-->
                <div class="col-md-4">
                  <div class="card mb-4 shadow">
                    <div class="card-body my-n3">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-lg bg-light">
                         <i class="fe fe-user fe-24 text-primary"></i>
                          </span>
                        </div> <!-- .col -->
                        <div class="col">
                          <a href="#">
                            <h3 class="h5 mt-4 mb-1">Update Akun</h3>
                          </a>
                          <p class="text-muted">Perubahan Informasi akun dapat dilakukan dengan link dibawah.</p>
                        </div> <!-- .col -->
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                    <div class="card-footer">
                   
                   
                      <a href="/jurnalis/update-profile/{{$jurnalis['slug']}}" class="d-flex justify-content-between text-muted">Update Akun</a>

                    </div> <!-- .card-footer -->
                  </div> <!-- .card -->
                </div> <!-- .col-md-->
             
              </div> <!-- .row-->
            </div> <!-- /.col-12 -->
          </div> <!-- .row -->
        </div>
@endsection