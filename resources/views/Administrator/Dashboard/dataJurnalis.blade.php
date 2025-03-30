@extends('Template.aside')

@section('container-main')

    @if (session()->has('message-success') || session()->has('message-error'))

          <div class="alert {{session('message-success') ? 'alert-success' : (session('message-error') ? 'alert-danger' : 'alert-warning')}} alert-dismissible fade show" role="alert">
            <strong>{{session('message-success') ?? session('message-error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      
    @endif

    <form method="post" Action="/aktif-akun/{{$data['slug']}}">
    @csrf
     <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Detail Akun Jurnalis</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12  d-flex justify-content-center">
                            <img src="{{ !empty($data['gambar']) ? $url . '/storage/' . $data['gambar'] : asset('assets/avatars/face-1.jpg') }}" class="rounded-lg w-75">

                            </div>
                            <div class="col-md-6 col-12">
                               <div class="form-row">
                                 <div class="form-group col-md-12">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" value="{{$data['email']}}" readonly class="form-control" id="inputEmail5">
                                   </div>
                                 <div class="form-group col-md-12">
                                        <label for="inputPassword4">nama</label>
                                        <input type="text" value="{{$data['nama']}}" readonly class="form-control" id="inputPassword5">
                                    </div>
                                  
                                    <div class="form-group col-md-12">
                                        <select id="inputState" name="activeAccount" class="form-control">
                                         <option value="1" {{ (isset($data['active']) && $data['active'] == 1) ? 'selected' : '' }}>Aktif</option>
                                          <option value="0" {{ (isset($data['active']) && (string) $data['active'] === '0') ? 'selected' : '' }}>Non-Aktif</option>
                                        </select>
                                     </div>

                                         <button type="submit" class="btn btn-primary">Simpan</button>
                                  </div>
                            </div>
                         
                          </div>
                   
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- /. end-section -->
    </form>
@endsection