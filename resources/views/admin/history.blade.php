<x-admin-layout title="History">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">History Pembayaran</a></div>
    </x-section-header>

<div class="section-body">
    <h1 class="section-title">History Pembayaran</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="history" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>ID Pembayaran</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Pembayaran Bulan</th>
                            <th>ID SPP</th>
                            <th>Jumlah Bayar</th>
                            <th>Nama Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ( $pembayaran as $row )
                        <tr>
                            <td>{{ tanggal($row->created_at) }}</td>
                            <td>{{ $row->id_pembayaran }}</td>
                            <td>{{ $row->nisn }}</td>
                            <td>{{ $siswa->firstWhere('nisn', $row->nisn)->nama }}</td>
                            <td>{{  $row->bulan_dibayar . ' ' .$row->tahun_dibayar }}</td>
                            <td>{{ $row->spp->id_spp . ' - ' . $row->spp->tahun }}</td>
                            <td>{{ format_rupiah($row->jumlah_bayar) }}</td>
                            <td>{{ $row->petugas->nama_petugas }}</td>
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

@include('admin.lib.datatablecetak');
@push('script')
    <script src="{{ asset('assets/js/pages/history/index.js') }}"></script>
    @endpush

</x-admin-layout>
