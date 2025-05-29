<div>
   <div class="col-md-12 my-4">

                  <h2 class="h4 mb-1">Tabel Jurnalis</h2>
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
                      <div class="toolbar row items-align-center">
                        <form class="form col-6">
                          <div class="form-row">
                        
                            <div class="form-group col-auto">
                              <label for="search" class="sr-only" >Cari Nama Jurnalis</label>
                              <input type="text" class="form-control" wire:model.live="search"  placeholder="Cari Nama Jurnalis">
                            </div>

                          </div>
                        </form>
                        <div class="col-6">
                        <p class="text-danger"> Total Belum Aktif {{$total}}</p>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-borderless table-hover">
                        <thead>
                          <tr>
                            <th>NO</th>
                            <th class="w-25">Foto</th>
                            <th class="w-25">Nama jurnalis</th>
                            <th>Tanggal Daftar Akun</th>
                            <th>Status Aktif</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $d)
            
                          <tr>

                           <td>
                          <span> 
                            {{ $loop->iteration }}
                          </span>
                            </td>

                            <td>
                              <div class="avatar avatar-md">
                                <img src="{{($d['gambar']) ? $url.'/storage/'.$d['gambar'] : asset('assets/avatars/face-1.png') }}" alt="..." class="avatar-img rounded-lg">
                              </div>
                            </td>

                            <td class="w-25">
                             <small class="text-muted">{{$d['nama']}}</small>
                            </td>

                            <td class="w-25">
                             <small class="text-muted">{{$d['created_at']}}</small>
                            </td>

                            <td>
                             <p>{{$d['active'] == 1 ? 'Aktif' : 'Non-Aktif'}}</p>
                            </td>
                            <td>  
                              <a href="/akun-jurnalis/{{$d['slug']}}" class="badge badge-primary py-2 px-2">Detail Data</a>
                           </td>
                          </tr>

                        @endforeach
                        </tbody>
                      </table>

                      <nav aria-label="Table Paging" class="mb-0 text-muted">
                        <ul class="pagination justify-content-center mb-0" style="cursor:pointer;">
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
