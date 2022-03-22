<x-admin-layout title="Tambah Transaksi">
    <section class="section">
        <div class="section-header bg-transparent shadow-none pb-0">
          <a href="{{ route('transaksi.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="http://reihanpraja.me/admin/dashboard">Admin</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('transaksi.index') }}">Transaksi</a></div>
            <div class="breadcrumb-item">Tambah Transaksi</div>
          </div>
        </div>

        <div class="section-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Tambah Transaksi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                            <div class="form-group mb-4 row mx-auto">
                                <label class="col-md-3 text-right">ID Pembayaran</label>
                                <div class="col-md-6">
                                    @php
                                        if (!$pembayaran) {
                                            $input = 'TRS00001';
                                        }else {
                                            $proses = substr($pembayaran->id_pembayaran, 3) + 1;
                                            $bil = sprintf("%05s", $proses);
                                            $input = substr($pembayaran->id_pembayaran, 0, 3) . $bil;
                                        }
                                    @endphp
                                    <input type="text" name="id_pembayaran" value="{{  $input  }}" class="form-control  @error('id_pembayaran') is-invalid @enderror" readonly>
                                    @error('id_pembayaran')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4 row mx-auto">
                                <label class="col-md-3 text-right">Nama</label>
                                <div class="col-md-6">
                                        <select onchange="getval(this.value)" class="form-control select2" name="nama">
                                            <option selected>- Pilih Nama -</option>
                                            @foreach ($siswa as $row)
                                            <option value="{{ $row->id }}">{{ $row->nisn . ' - ' . $row->nama }}</option>
                                            @endforeach
                                        </select>
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4 row mx-auto">
                                <label class="col-md-3 text-right">Jumlah Bayar</label>
                                <div class="col-md-6">
                                    <input type="text" name="jumlah_bayar" class="form-control" @error('jumlah_bayar') is-invalid @enderror>
                                    @error('jumlah_bayar')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4 row mx-auto">
                                <label class="col-md-3 text-right">Pembayaran Bulan</label>
                                <div class="col-md-6">
                                    <input type="month" class="form-control" name="bultahun" />
                                    @error('bultahun')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7 ml-2">
                                    <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                </div>
              </div>
            </div>
          </div>

        </div>
    </section>
    @include('admin.lib.select2')
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    @push('script')
    <script>
        const DOMstrings = {
            inputUang : document.querySelector("input[name='jumlah_bayar']")
        }
        $('.select2').select2();
        function getval(id){
            $.getJSON(`${url}/api/siswa/${id}`, function(data){
                $("input[name='jumlah_bayar']").val(`Rp. ${formatRupiah(data.nominal)}`)
            })
        }
        var rupiah = DOMstrings.inputUang;
            rupiah.addEventListener("keyup", function (e) {
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endpush
</x-admin-layout>
