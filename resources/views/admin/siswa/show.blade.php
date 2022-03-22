<x-admin-layout title="Siswa">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></div>
    </x-section-header>

<div class="section-body">
    <a href="{{ route('siswa.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
    <h1 class="section-title">Detail Siswa</h1>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-active">NISN</th>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">NIS</th>
                        <td>{{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">Nama</th>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">Kelas</th>
                        <td>{{ $siswa->kelas->nama_kelas . $siswa->kelas->kompetensi_keahlian }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">Alamat</th>
                        <td>{{ $siswa->alamat }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">No Telepon</th>
                        <td>{{ $siswa->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">Id SPP</th>
                        <td>{{ $siswa->spp->id_spp . ' - ' .$siswa->spp->tahun }}</td>
                    </tr>
                    <tr>
                        <th class="table-active">Tunggakan</th>
                        @php
                            $transaksi = DB::table('pembayarans')->where('nisn', $siswa->nisn)->sum('jumlah_bayar');
                            $spp = DB::table('spps')->where('id', $siswa->spp_id)->first();
                            $jumlahspp = $spp->nominal * date('m');
                            $hasil = $jumlahspp - $transaksi;
                        @endphp
                        <td>{{ $hasil == '0' ? 'Lunas' : format_rupiah($hasil) }}</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-admin-layout>
