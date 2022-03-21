<x-admin-layout title="Siswa">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></div>
    </x-section-header>

<div class="section-body">
    <h1 class="section-title">Data Siswa</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Siswa</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table">
                <thead>
                  <tr>
                    <th class="text-center">
                      NISN
                    </th>
                    <th class="text-center">
                      NIS
                    </th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $row)
                    <tr>
                        <td class="text-center">
                          {{ $siswa->nisn }}
                        </td>
                        <td> {{ $siswa->nis }}</td>
                        <td> {{ $siswa->nama }}</td>
                        <td> {{ $siswa->kelas }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-none" id="siswadrop{{$row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v" type="button"></i></button>
                                <div class="dropdown-menu" aria-labelledby="siswadrop{{$row->id }}">
                                    <a class="dropdown-item" href="{{route("siswa.edit", $row->id) }}"><i class="fa fa-edit"></i>&nbsp; Edit Siswa</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modalsiswa{{$row->id }}" href="#"><i class="fa fa-eye"></i>&nbsp; Lihat Detail</a>
                                    <a class="dropdown-item btnhapus" data-id="{{$row->id }}" data-nama="{{ $row->nama }}" href="#"><i class="fa fa-trash"></i>&nbsp; Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
      $('#table').DataTable();
  </script>
@endpush
</x-admin-layout>
