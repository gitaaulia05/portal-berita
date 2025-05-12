<div>
     <div class="card shadow">
  <div class="card-body">
    <div class="toolbar">
      <form class="form">
        <div class="form-row">

              <div class="form-group col-auto">
                <div class=" text-white h-75 rounded-sm" wire:click="toogleSoftDelete" style="cursor: pointer; ">
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
          <th>Jurnalis</th>
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
           <p>{{$b['kategori_berita']}}</p>
          </td>

          <td>
            <p>{{$b['nama_jurnalis']}}</p>
           </td>

          <td>  

            <span class="badge badge-pill {{ $b['is_tayang'] == 2 ? 'badge-danger' : 'badge-primary' }}">{{ $b['is_tayang'] == 2 ? 'Dihapus' : 'tayang' }}</span>
          </td>
         
          <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="text-muted sr-only">Action</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
    
              @if ($b['is_tayang'] == 1)
                 <a class="dropdown-item" data-toggle="modal"data-target="#softDelete{{ $b['slug']}}" style="cursor: auto;">Hapus Dalam 30 Hari</a>
                 <a class="dropdown-item" href="/beritaAdmin/{{ $b['kategori_berita'] }}/{{ $b['slug'] }}" style="cursor: auto;">Detail Data</a>
              @endif

              @if ($b['is_tayang'] == 2)
              <form action="/berita/restore/{{$b['slug']}}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item" style="cursor: auto;">Restore Berita</button>
              </form>
              <a class="dropdown-item" data-toggle="modal" data-target="#Delete{{ $b['slug']}}" style="cursor: auto;">Hapus Permanen</a>
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
                            
                            <form action="/berita/softHapus/{{ $b['slug'] }}" Method="POST">
                              @csrf
                                <button type="submit" href="/berita/softHapus/{{ $b['slug']}}"
                                  class="btn btn-primary text-white"
                                  type="button">
                                  Ya, Hapus
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
                            <form action="/berita/delete/{{$b['slug']}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary text-white">Ya, Hapus</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

      @endforeach
      </tbody>
    </table>
    <nav aria-label="Table Paging" class="mb-0 text-muted">
      <ul class="pagination justify-content-center mb-0" style="cursor: pointer;">
        @if(!empty($meta))
         @foreach ($meta['links'] as $link)
             @if ($link['url'])
                <li class="page-item {{ $link['label'] == $currentPage ? 'active' : '' }}"><a class="page-link " wire:click="goToPage({{ is_numeric($link['label']) ? $link['label'] : ($link['label'] == 'pagination.previous' ? $currentPage-1 : $currentPage+1  )  }})">{{is_numeric($link['label']) ? $link['label'] : ($link['label'] == 'pagination.previous' ? 'Halaman sebelumnya' : 'Halaman Selanjutnya') }}</a></li>
                @endif
            @endforeach
         @endif
      </ul>
    </nav>
  </div>
</div>
</div> <!-- customized table -->
</div>
