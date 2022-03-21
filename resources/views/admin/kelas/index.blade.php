<x-admin-layout title="Kelas">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></div>
    </x-section-header>

<div class="section-body">
    <h1 class="section-title">Data Kelas</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <a href="#" class="btn btn-primary form-tambah"><i class="fa fa-plus"></i>&nbsp; Tambah Kelas</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table">
                <thead>
                  <tr>
                    <th class="text-center">
                      Kelas
                    </th>
                    <th>
                        Kompetensi Keahlian
                      </th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6" id="form-kelas" style="display:none">
        <div class="card">
            <div class="card-header">
              <h4>Kelas</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                  <div id="alert"></div>
                    <form method="post">
                        <div class="form-group row mb-4">
                            <label>Kelas</label>
                            <select class="form-control" name="kelas">
                              <option selected disabled>- Pilih Kelas -</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group row mb-5">
                            <label>Kompetensi Keahlian</label>
                            <input type="text" class="form-control" name="kompetensi_keahlian"/>
                        </div>
                        <div class="form-group row mb-4">
                            <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                            <button class="btn btn-danger btn-cancel mx-2" type="button"><i class="fas fa-times"></i>&nbsp; Batal</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>

@include('admin.lib.datatable');
@push('script')
  <script src="{{ asset('assets/js/pages/kelas/index.js') }}"></script>
@endpush
</x-admin-layout>
