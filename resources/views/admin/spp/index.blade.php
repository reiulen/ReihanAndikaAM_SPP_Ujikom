<x-admin-layout title="SPP">

    <x-section-header>
        <div class="breadcrumb-item"><a href="{{ route('spp.index') }}">Data SPP</a></div>
    </x-section-header>

<div class="section-body">
    <h1 class="section-title">Data SPP</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <a href="#" class="btn btn-primary form-tambah"><i class="fa fa-plus"></i>&nbsp; Tambah SPP</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table">
                <thead>
                  <tr>
                    <th class="text-center">
                      SPP
                    </th>
                    <th>
                       Tahun
                    </th>
                    <th>
                        Nominal
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
                        <input type="hidden" name="id" value="0" />
                        <div class="form-group row mb-4">
                            @php
                                if (!$spp) {
                                        $input = 'SPP001';
                                }else {
                                    $proses = substr($spp->id_spp, 3) + 1;
                                    $bil = sprintf("%03s", $proses);
                                    $input = substr($spp->id_spp, 0, 3) . $bil;
                                }
                            @endphp
                            <input type="text" name="id_spp" value="{{  $input  }}" class="form-control @error('id_spp') is-invalid @enderror" readonly>
                        </div>
                        <div class="form-group row mb-5">
                            <label>Tahun</label>
                            <input type="text" class="form-control" name="tahun"/>
                        </div>
                        <div class="form-group row mb-5">
                            <label>Nominal</label>
                            <input type="text" class="form-control" name="nominal"/>
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
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/pages/spp/index.js') }}"></script>
@endpush
</x-admin-layout>
