<div>
   <div class="col-md-12 my-4">

                  <h2 class="h4 mb-1">Tabel Berita</h2>
                  @if(session()->has('message-success') || session()->has('message-error'))
                     <div class="alert {{ session()->has('message-success')? 'alert-success' : 'alert-danger '}} alert-dismissible fade show" role="alert">
                      <strong class="text-center">{{session('message-success') ?? session('message-error') }}</strong> 
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
                          
                            <div class="form-group col-auto">
                                <div class="bg-primary opacity-50 text-white h-75 rounded-sm" wire:click="toogleTayang" style="cursor: pointer; background-color: {{ $is_trash === 1 ? '#3D7EFF' : '#1b68ff' }};">
                                  <p class="mx-2 pt-2">Berita Tayang</p>
                                </div>
                            </div>

                                <div class="form-group col-auto">
                                  <div class=" text-white h-75 rounded-sm" wire:click="toogleSoftDelete" style="cursor: pointer;    background-color: {{ $is_trash === 2 ? '#ED6370' : '#dc3545' }};">
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
                                <img src="{{($b['gambar']) ? $url . '/storage/'. $b['gambar'][0]['gambar_berita'] : asset('assets/images/image.png')}}" alt="..." class="avatar-img rounded-circle">
                              </div>
                            </td>
                            <td class="w-25">
                             <small class="text-muted">{{$b['judul_berita']}}</small>
                            </td>
                            <td>
                             <p>{{$b['kategori_berita']}}</p>
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
                                   <a class="dropdown-item" data-toggle="modal" data-target="#softDelete{{ $b['slug']}}" style="cursor: auto;">Hapus Dalam 30 Hari</a>
                                @endif

                                @if ($b['is_tayang'] == 2)
                                    <form action="/berita/restore/{{ $b['slug'] }}" method="POST">
                                      @csrf
                                      <button type="submit" class="dropdown-item">Restore Berita</button>
                                    </form>
                                   <a class="dropdown-item" data-toggle="modal" data-target="#Delete{{ $b['slug']}}" href="#" style="cursor: auto;">Hapus Berita</a>
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
                                              <button type="button" class="btn btn-secondary"  data-dismiss="modal">Tutup</button>
                                              <form action="/berita/softHapus/{{ $b['slug'] }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary text-white" type="submit"> 
                                              {{-- Teks tombol normal, tersembunyi saat loading --}}
                                              <span wire:loading.remove wire:target="delete('{{ $b['slug'] }}')">
                                                  Ya, Hapus {{ $b['slug'] }}
                                              </span>
                                          
                                              {{-- Spinner + teks loading, hanya tampil saat aksi delete dipanggil --}}
                                              <span wire:loading wire:target="delete('{{ $b['slug'] }}')">
                                                  <i class="spinner-border spinner-border-sm"></i>
                                                  Menghapus...
                                              </span>
                                            </button>
                                          </form>
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
                                              <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
                                              <form action="/berita/delete/{{ $b['slug'] }}" method="POST">
                                                @csrf
                                               <button class="btn btn-primary text-white" type="submit">Ya, Hapus {{$b['judul_berita']}}</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                        @endforeach
                        </tbody>
                      </table>
                                <nav aria-label="Table Paging" class="mb-0 text-muted">
                                  <ul class="pagination justify-content-center mb-0">
                                        @foreach ($meta['links'] as $link)
                                          @if ($link['url'])
                                              <li class="page-item {{ $link['label'] == $currentPage ? 'active' : '' }}"><a class="page-link " wire:click="goToPage({{ is_numeric($link['label']) ? $link['label'] : ($link['label'] == 'pagination.previous' ? $currentPage-1 : $currentPage+1  )  }})">{{is_numeric($link['label']) ? $link['label'] : ($link['label'] == 'pagination.previous' ? 'Halaman sebelumnya' : 'Halaman Selanjutnya') }}</a></li>
                                          @endif
                                       @endforeach

                                  </ul>
                                </nav>
                              
                    </div>
                  </div>
                </div> <!-- customized table -->

            
</div>
