<div>
  <div class="row">
    <div class="col-12 {{ $form ? 'd-block':'d-none' }}">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h4 class="card-title">
            <span class="fa fa-edit mr-3"></span>
            Formulir Data Satuan
          </h4>

          <div class="card-tools">
            <button class="btn btn-danger btn-xs px-3" wire:click="showForm(false)">
              <span class="fa fa-times mr-2"></span>
              Tutup Formulir
            </button>
          </div>
        </div>

        <div class="card-body text-sm py-2">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-0">
                <label for="kode_satuan">Kode Satuan : </label>
                <input type="text" wire:model="state.FK_SAT" name="kode_satuan" id="kode-satuan" class="form-control form-control-sm   {{ $errors->has('state.FK_SAT') ? 'is-invalid':''}}" placeholder="Masukan Kode Satuan..." required>

                <div class="invalid-feedback">
                  {{ $errors->first('state.FK_SAT') }}
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group mb-0">
                <label for="nama_satuan">Nama Satuan : </label>
                <input type="text" wire:model="state.FN_SAT" name="nama_satuan" id="nama_satuan" class="form-control form-control-sm {{ $errors->has('state.FN_SAT') ? 'is-invalid':'' }}" placeholder="Masukan Nama Satuan..." required>

                <div class="invalid-feedback">
                  {{ $errors->first('state.FN_SAT') }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-md-3">
              <button class="btn btn-sm btn-block btn-success" wire:click="createData">
                <span class="fa fa-check mr-2"></span>
                Buat Data Satuan
              </button>
            </div>
            <div class="col-md-3">
              <button class="btn btn-sm btn-block btn-danger" wire:click="showForm(false)">
                <span class="fa fa-undo mr-2"></span>
                Reset / Batalkan Input
              </button>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h4 class="card-title">
            <span class="fa fa-table mr-3"></span>
            Master Data Satuan
          </h4>

          <div class="card-tools">
            <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
              <span class="fa fa-plus mr-2"></span>
              Tambah Data Satuan
            </button>
          </div>
        </div>

        <div class="card-body p-0 table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="align-middle px-2 py-2 text-center">No. </th>
                <th class="align-middle px-2 py-2 text-center">Kode Satuan</th>
                <th class="align-middle px-2 py-2 text-center">Nama Satuan</th>
                <th class="align-middle px-2 py-2 text-center">Aksi </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($dataSatuan as $item)
              <tr>
                <td class="align-middle px-2 py-1 text-center">
                  {{ ($dataSatuan->currentpage()-1) * $dataSatuan->perpage() + $loop->index + 1 }}.
                </td>
                <td class="align-middle px-2 py-1 text-center">{{ $item->FK_SAT }}</td>
                <td class="align-middle px-2 py-1 text-center">{{ $item->FN_SAT }}</td>
                <td class="align-middle px-2 py-1 text-center">
                  <div class="btn-group">
                    <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_SAT }}')">
                      <span class="fa fa-edit"></span>
                    </button>
                    <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_SAT }}')">
                      <span class="fa fa-trash"></span>
                    </button>
                  </div>
                </td>
              </tr>                 
              @empty
              <tr>
                <td class="align-middle text-center" colspan="4">Belum Ada Data Satuan</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="card-footer">
          <div class="float-right">
            {{ $dataSatuan->links() }}
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
