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

                <div class="form-group col-auto">
                    <a data-toggle="modal" data-target="#tambahKategori" class="btn btn-primary text-white">Tambah Kategori Berita</a>
                </div>

                </div>
            </form>
            </div>
            <!-- table -->
            <table class="table table-borderless table-hover">
            <thead>
                <tr>
                <th class="w-25">Id Kategori Berita</th>
                <th>Kategori Berita</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $b)
                <tr>

                <td class="w-25">
                <small class="text-muted">{{$b['id_kategori_berita']}}</small>
                </td>
                <td>
                <p>{{$b['kategori']}}</p>
                </td>

                
                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-muted sr-only">Action</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/kategori-berita/{{ $b['id_kategori_berita'] }}"  style="cursor: auto;">Update Data</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#hapusModal{{ $b['id_kategori_berita']}}" style="cursor: auto;">Hapus Data</a>
                    </div>
                </td>
                </tr>
                
                <!-- Modal DELETE -->
                            <div class="modal fade" id="hapusModal{{ $b['id_kategori_berita']}}" tabindex="-1" aria-labelledby="modalLabel{{ $b['id_kategori_berita']}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $b['id_kategori_berita']}}">Hapus Berita</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Item Akan dihapus anda yakin hapus kategori {{$b['kategori']}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Tutup</button>
                                    
                                    <form action="/kategori-berita/{{ $b['id_kategori_berita'] }}" Method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" href="/berita/softHapus/{{ $b['id_kategori_berita']}}"
                                        class="btn btn-primary text-white"
                                        type="button">
                                        Ya, Hapus
                                        </button>
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



                    <div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="tambahKategori" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="tambahKategori">Tambah Kategori Berita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                             <form action="/kategori-berita" Method="POST">
                              @csrf
                          <div class="modal-body">
                                  <div class="form-group">
                                        <label for="kategoriBerita">Kategori</label>
                                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategoriBerita" required>
                                        @error('kategori')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-dismiss="modal">Tutup</button>
                           
                                <button type="submit" 
                                  class="btn btn-primary text-white"
                                  type="button">
                                 Simpan
                                </button>
                          </div>
                            </form>
                        </div>
                      </div>
                    </div>

</div>



