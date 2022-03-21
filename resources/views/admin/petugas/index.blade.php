<x-admin-layout title="Petugas">

        <x-section-header>
            <div class="breadcrumb-item"><a href="{{ route('petugas.index') }}">Data Petugas</a></div>
        </x-section-header>

    <div class="section-body">
        <h1 class="section-title">Data Petugas</h1>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('petugas.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Petugas</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table">
                    <thead>
                      <tr>
                        <th class="text-center">
                          Id Petugas
                        </th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    @include('admin.lib.datatable');
    @push('script')
        <script>
          const log = "{{ Auth::user()->id_petugas }}"
        </script>
        <script src="{{ asset('assets/js/pages/petugas/index.js') }}"></script>
    @endpush
   </x-admin-layout>
   @foreach ($petugas as $row)
   <!-- Modal -->
   <div class="modal fade" id="modalpetugas{{ $row->id }}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="staticBackdropLabel">Detail Petugas</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <table class="table">
                       <tr>
                           <th class="table-active">Id Petugas</th>
                           <td>{{ $row->id_petugas }}</td>
                       </tr>
                       <tr>
                            <th class="table-active">Nama Petugas</th>
                            <td>{{ $row->nama_petugas }}</td>
                        </tr>
                       <tr>
                           <th class="table-active">Username</th>
                           <td>{{ $row->username }}</td>
                       </tr>
                       <tr>
                           <th class="table-active">Level</th>
                           <td><span class="badge {{ badgelevel($row->level) }}">{{ $row->level }}</span></td>
                       </tr>
                       <tr>
                           <th class="table-active">Bergabung</th>
                           <td>{{ $row->created_at->diffforhumans() }}</td>
                       </tr>
                   </table>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
               </div>
           </div>
       </div>
   </div>
 @endforeach
