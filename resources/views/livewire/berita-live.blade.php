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
                                <div class="bg-primary opacity-50 text-white h-75 rounded-sm" wire:click="toogleTayang" style="cursor: pointer;">
                                  <p class="mx-2 pt-2">Berita Tayang</p>
                                </div>
                            </div>

                                <div class="form-group col-auto">
                            <div class="bg-danger text-white h-75 rounded-sm" wire:click="toogleSoftDelete" style="cursor: pointer;">
                               <p class="mx-2 pt-2">Berita Dihapus</p>
                            </div>
                              </div>

                            <div class="form-group col-auto">
                              <label for="search" class="sr-only" >Cari Judul Berita</label>
                              <input type="text" class="form-control" wire:model.live="search"  placeholder="Cari Judul Berita">
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- table -->
                      <table class="table table-borderless table-hover">
                        <thead>
                          <tr>
                            <th>NO</th>
                            <th class="w-25">Judul Berita</th>
                            <th>Kategori Berita</th>
                            <th>Status Tayang</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($berita as $b)
            
                          <tr>

                            <td>
                              <div class="avatar avatar-md">
                                <img src="./assets/avatars/face-3.jpg" alt="..." class="avatar-img rounded-circle">
                              </div>
                            </td>
                            <td class="w-25">
                             <small class="text-muted">{{$b['judul_berita']}}</small>
                            </td>
                            <td>
                             <p>{{$b['kategori_berita'][0]['kategori']}}</p>
                            </td>
                            <td>  

                            <a href="#" class="badge {{$b['is_tayang'] == 1 ? 'badge-primary' : ($b['is_tayang'] == 2 ? 'badge-danger' : 'badge-warning')}}
                            "> {{$b['is_tayang'] == 1 ? 'Tayang' : ($b['is_tayang'] == 2 ? 'Sudah Dihapus' : 'Draft')}}</a>
                            </td>
                           
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted sr-only">Action</span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/ubah-berita/{{$b['slug']}}" wire:navigate>Edit</a>
                                @if ($b['is_tayang'] == 1)
                                   <a class="dropdown-item" data-toggle="modal" data-target="#softDelete{{ $b['slug']}}">Hapus Dalam 30 Hari</a>
                                @endif

                                @if ($b['is_tayang'] == 2)
                                   <a class="dropdown-item" wire:click="restore('{{$b['slug']}}')">Restore Berita</a>
                                   <a class="dropdown-item"  data-toggle="modal" data-target="#Delete{{ $b['slug']}}" href="#">Hapus Berita</a>
                                @endif
                               
                              </div>
                           </td>
                          </tr>

                           <!-- Modal SOFT DELETE -->
                                      <div class="modal fade" id="softDelete{{ $b['slug']}}" tabindex="-1" aria-labelledby="modalLabel{{ $b['slug']}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="modalLabel{{ $b['slug']}}">Hapus Berita</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Item Akan dihapus dan dapat di <bold>RECOVERY</bold> Dalam 30 Hari</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                              <a wire:click="softDelete('{{$b['slug']}}')" class="btn btn-primary">Ya Hapus {{ $b['slug'] }}</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                             <!-- Modal  DELETE PERMANEN -->
                                   <div class="modal fade" id="Delete{{ $b['slug']}}" tabindex="-1" aria-labelledby="labelDelete{{ $b['slug']}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="labelDelete{{ $b['slug']}}">Hapus Berita</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Item Akan dihapus dan <bold>Tidak Dapat di Recovery</bold></p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                              <a wire:click="delete('{{$b['slug']}}')" class="btn btn-primary">Ya Hapus {{ $b['slug'] }}</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

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
