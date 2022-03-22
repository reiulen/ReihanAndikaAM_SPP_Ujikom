<x-admin-layout title="Tambah Siswa">
    <section class="section">
        <div class="section-header bg-transparent shadow-none pb-0">
          <a href="{{ route('siswa.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="http://reihanpraja.me/admin/dashboard">Admin</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></div>
            <div class="breadcrumb-item">Tambah Siswa</div>
          </div>
        </div>

        <div class="section-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Tambah Siswa</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route("siswa.store") }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>NISN</label>
                            <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" required>
                        </div>
                        <div class="col-md-4">
                            <label>NIS</label>
                            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" required>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                            <x-error-alert error="nama"></x-error-alert>
                        </div>
                        <div class="col-md-4">
                            <label>Kelas</label>
                            <select class="form-control select2 @error('id_kelas') is-invalid @enderror" name="id_kelas" required>
                                <option selected disabled>- Pilih Kelas -</option>
                                @foreach ($kelas as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_kelas . ' ' .$row->kompetensi_keahlian }}</option>
                                @endforeach
                            </select>
                            <x-error-alert error="level"></x-error-alert>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" required>
                            <x-error-alert error="no_telepon"></x-error-alert>
                        </div>
                        <div class="col-md-4">
                            <label>SPP</label>
                            <select class="form-control select2 @error('id_spp') is-invalid @enderror" name="id_spp" required>
                                <option selected disabled>- Pilih SPP -</option>
                                @foreach ($spp as $row)
                                <option value="{{ $row->id }}">{{ $row->id_spp . ' ' .$row->tahun }}</option>
                                @endforeach
                            </select>
                            <x-error-alert error="level"></x-error-alert>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                            <x-error-alert error="alamat"></x-error-alert>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                        </div>
                        <div class="col-md-4">
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
            $('.select2').select2();
            const DOMstrings = {
                inputNisn : document.querySelector('input[name="nisn'),
                inputNis : document.querySelector('input[name="nis"]')
            }
            Inputmask({ mask: "999999999" }).mask(
                DOMstrings.inputNisn
            );
            Inputmask({ mask: "999999999" }).mask(
                DOMstrings.inputNis
            )
        </script>
    @endpush
</x-admin-layout>
