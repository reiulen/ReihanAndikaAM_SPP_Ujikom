<x-admin-layout title="Tambah Petugas">
    <section class="section">
        <div class="section-header bg-transparent shadow-none pb-0">
          <a href="{{ route('petugas.index') }}" class="btn btn-outline-primary px-3"><i class="fas fa-arrow-left"></i></a>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="http://reihanpraja.me/admin/dashboard">Admin</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('petugas.index') }}">Petugas</a></div>
            <div class="breadcrumb-item">Tambah Petugas</div>
          </div>
        </div>

        <div class="section-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Tambah Petugas</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route("petugas.store") }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>Id Petugas</label>
                            @php
                            $proses = substr($petugas->id_petugas, 2) + 1;
                            $bil = sprintf("%03s", $proses);
                        @endphp
                        <input type="text" name="id_petugas" value="{{ substr($petugas->id_petugas, 0, 3)  }}{{ $bil }}" class="form-control @error('id_petugas') is-invalid @enderror" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" required>
                            <x-error-alert error="nama_petugas"></x-error-alert>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" required>
                            <x-error-alert error="username"></x-error-alert>
                        </div>
                        <div class="col-md-4">
                            <label>Level</label>
                            <select class="form-control @error('level') is-invalid @enderror" name="level" required>
                                <option selected disabled>- Pilih Level -</option>
                                <option value="Admin">Admin</option>
                                <option value="Petugas">Petugas</option>
                            </select>
                            <x-error-alert error="level"></x-error-alert>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-4">
                        <div class="col-md-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            <x-error-alert error="password"></x-error-alert>
                        </div>
                        <div class="col-md-4">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password1" class="form-control @error('password1') is-invalid @enderror" required>
                            <x-error-alert error="password1"></x-error-alert>
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
</x-admin-layout>
