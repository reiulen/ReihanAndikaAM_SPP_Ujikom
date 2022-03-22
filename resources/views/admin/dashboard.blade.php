<x-admin-layout title="Dashboard">

 <x-section-header section="Dashboard">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
 </x-section-header>
 <div class="row">
    @canany(['admin','petugas'])
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Siswa</h4>
                </div>
                <div class="card-body">
                    {{ DB::table('siswas')->count() }}
                </div>
                </div>
            </div>
        </div>
    @endcanany
   @can('admin')
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Petugas</h4>
            </div>
            <div class="card-body">
            {{ DB::table('petugas')->count() }}
            </div>
        </div>
        </div>
    </div>
   @endcan
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Transaksi Bulan</h4>
          </div>
          <div class="card-body">
            {{ format_rupiah($pembayaran->where('bulan_dibayar', bulan(date('F')))->sum('jumlah_bayar')) }}
          </div>
        </div>
      </div>
      </div>
    @canany(['admin', 'petugas'])
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Saldo</h4>
            </div>
            <div class="card-body">
              {{ format_rupiah($pembayaran->sum('jumlah_bayar')) }}
            </div>
          </div>
        </div>
    </div>
    @endcanany
    @if (Auth::guard('siswa')->user())
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
              <h4>Seluruh Transaksi</h4>
            </div>
            <div class="card-body">
                {{
                    format_rupiah($pembayaran->where('nisn', Auth::guard('siswa')->user()->nisn)
                    ->where('bulan_dibayar', bulan(date('F')))
                    ->sum('jumlah_bayar'))
                }}
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
              <h4>Tunggakan</h4>
            </div>
            <div class="card-body">
                @php
                    $transaksi = DB::table('pembayarans')->where('nisn', Auth::guard('siswa')->user()->nisn)->sum('jumlah_bayar');
                    $spp = DB::table('spps')->where('id', Auth::guard('siswa')->user()->spp_id)->first();
                    $jumlahspp = $spp->nominal * date('m');
                    $hasil = $jumlahspp - $transaksi;
                @endphp
                {{ $hasil == '0' ? 'Lunas' : format_rupiah($hasil) }}
            </div>
        </div>
        </div>
    </div>
    @endif
  </div>

  @push('script')
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/pages/dashboard/index.js') }}"></script>
  @endpush

</x-admin-layout>
