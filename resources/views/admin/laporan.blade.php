<x-admin-layout title="Transaksi">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Data Transaksi</a></div>
    </x-section-header>

<div class="section-body">
    <h1 class="section-title">Data Transaksi</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header row">
            <form id="bulan">
                <div class="d-flex">
                    <div class="form-group mx-2">
                        <label>Tanggal Awal</label>
                        <input type="date" class="form-control mx-1" name="awal"/>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" class="form-control mx-1" name="akhir"/>
                    </div>
                    <div class="form-group mx-2" style="margin-top: 35px">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
                <div class="d-flex ml-auto">
                    <div class="form-group">
                        <label>Transaksi ID SPP</label>
                        <select class="form-control kelas" name="id_spp">
                            <option selected disabled>- Pilih Sesuai ID SPP -</option>
                            @foreach ($spp as $row)
                            <option value="{{ $row->id }}">{{ $row->id_spp . ' ' .$row->tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
                            <th>Nama Petugas</th>
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
@include('admin.lib.select2');
@push('script')
<script src="{{ asset('assets/js/pages/laporan/index.js') }}"></script>
@endpush
</x-admin-layout>
