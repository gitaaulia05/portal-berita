<div>
   <div class="col-md-12 my-4">

                  <h2 class="h4 mb-1">Tabel Berita</h2>
                  @if(session()->has('message-success'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong class="text-center">{{session('message-success')}}</strong> 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif

                    <div class="card shadow">
                    <div class="card-body">
                      <div class="toolbar">
                        <form class="form">
                          <div class="form-row">
                            <div class="form-group col-auto mr-auto">
                              <label class="my-1 mr-2 sr-only" for="inlineFormCustomSelectPref1">Show</label>
                              <select class="custom-select mr-sm-2" id="inlineFormCustomSelectPref1">
                                <option value="">...</option>
                                <option value="1">12</option>
                                <option value="2" selected>32</option>
                                <option value="3">64</option>
                                <option value="3">128</option>
                              </select>
                            </div>

                            <div class="form-group col-auto">
                              <label for="search" class="sr-only" >Cari Nama Jurnalis</label>
                              <input type="text" class="form-control" wire:model.live="search"  placeholder="Cari Nama Jurnalis">
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- table -->
                      <table class="table table-borderless table-hover">
                        <thead>
                          <tr>
                            <th>NO</th>
                            <th class="w-25">Foto</th>
                            <th class="w-25">Nama jurnalis</th>
                            <th>Status Aktif</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $d)
            
                          <tr>

                           <td>
                          <span>1</span>
                            </td>

                            <td>
                              <div class="avatar avatar-md">
                                <img src="{{!empty($d['gambar']) ? $url.'/storage/'.$d['gambar'] : asset('assets/avatars/face-1.jpg') }}" alt="..." class="avatar-img rounded-lg">
                              </div>
                            </td>
                            <td class="w-25">
                             <small class="text-muted">{{$d['nama']}}</small>
                            </td>
                            <td>
                             <p>{{$d['active']}}</p>
                            </td>
                            <td>  
                              <a href="/akun-jurnalis/{{$d['slug']}}" class="badge badge-primary py-2 px-2">Detail Data</a>
                           </td>
                          </tr>

                        @endforeach
                        </tbody>
                      </table>
                      <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-center mb-0">
                          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div> <!-- customized table -->

</div>
