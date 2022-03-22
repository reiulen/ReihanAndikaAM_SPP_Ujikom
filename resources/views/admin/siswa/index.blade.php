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
                    <th>ID SPP</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $row)
                    <tr>
                        <td class="text-center">
                          {{ $row->nisn }}
                        </td>
                        <td> {{ $row->nis }}</td>
                        <td> {{ $row->nama }}</td>
                        <td>{{ $row->kelas->nama_kelas }} {{ $row->kelas->kompetensi_keahlian }}</td>
                        <td>{{ $row->spp->id_spp . ' - ' .$row->spp->tahun }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-none" id="siswadrop{{$row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v" type="button"></i></button>
                                <div class="dropdown-menu" aria-labelledby="siswadrop{{$row->id }}">
                                    <a class="dropdown-item" href="{{route("siswa.edit", $row->id) }}"><i class="fa fa-edit"></i>&nbsp; Edit Siswa</a>
                                    <a class="dropdown-item" href="{{ route('siswa.show', $row->id) }}"><i class="fa fa-eye"></i>&nbsp; Lihat Detail</a>
                                    <a class="dropdown-item btnhapus" data-id="{{$row->id }}" data-nama="{{ $row->nama }}" href="#"><i class="fa fa-trash"></i>&nbsp; Hapus</a>
                                    <form action="{{ route('siswa.destroy', $row->id) }}" id="hapus{{ $row->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
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
      var table = $('#table').DataTable();
      $('.btnhapus').click(function(e){
            e.preventDefault();
            const urlhapus = $(this).data('id');
            const nama = $(this).attr('data-nama');
            Swal.fire({
            title: "Apakah yakin?",
            text: `Siswa ${nama} akan dihapus`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#6492b8da",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yakin",
            cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#hapus${urlhapus}`).submit();
                }
            });
        });
  </script>
@endpush
</x-admin-layout>
