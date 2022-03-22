<x-admin-layout title="Transaksi">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Data Transaksi</a></div>
    </x-section-header>

<div class="section-body">
    <h1 class="section-title">Data Transaksi</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Tambah Transaksi</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pembayaran</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>ID SPP</th>
                            <th>Jumlah Bayar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                    @foreach ( $pembayaran as $row )
                        <tr>
                            <td>{{ $row->id_pembayaran }}</td>
                            <td>{{ $row->nisn }}</td>
                            <td>{{ $siswa->firstWhere('nisn', $row->nisn)->nama }}</td>
                            <td>{{ $row->tgl_bayar . ' ' . $row->bulan_dibayar . ' ' .$row->tahun_dibayar }}</td>
                            <td>{{ $row->spp->id_spp . ' - ' . $row->spp->tahun }}</td>
                            <td>{{ format_rupiah($row->jumlah_bayar) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-none" id="transaksidrop{{$row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v" type="button"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="transaksidrop{{$row->id }}">
                                        <a class="dropdown-item" href="{{route("transaksi.edit", $row->id) }}"><i class="fa fa-edit"></i>&nbsp; Edit transaksi</a>
                                        <a class="dropdown-item btnhapus" data-id="{{$row->id }}" data-nama="{{ $row->id_pembayaran }}" href="#"><i class="fa fa-trash"></i>&nbsp; Hapus</a>
                                        <form action="{{ route('transaksi.destroy', $row->id) }}" id="hapus{{ $row->id }}" method="POST">
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
            text: `SPP ${nama} akan dihapus`,
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
