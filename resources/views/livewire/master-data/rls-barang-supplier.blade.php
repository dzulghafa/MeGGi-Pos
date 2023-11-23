<div>
  <div class="row">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h4 class="card-title" wire:click="$refresh">
            <span class="fa fa-link mr-3 text-primary"></span>
            Relasi Barang Supplier
          </h4>
        </div>

        <div class="card-body py-2">
          <div class="row">
            <div class="col-12">
              <div class="form-group"> 
                <label for="supplier">Data Supplier : </label>
                <div class="input-group">
                  <input type="text" wire:model="state.TEXT_SUP" name="supplier" id="supplier" class="form-control {{ $errors->has('state.FK_SUP') ? 'is-invalid':'' }} borad" placeholder=" - Silahkan Pilih Data Supplier - " disabled>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-danger btn-flat" wire:click="resetSupplier">
                      <span class="fa fa-undo"></span>
                    </button>
                    <button type="button" class="btn btn-secondary btn-flat" wire:click="openModalSupplier">Pilih Data Supplier</button>
                  </span>

                  <div class="invalid-feedback">
                    {{ $errors->first('state.FK_SUP') }}
                  </div>
                </div> 


                @if ($state['FKD_RLS'])
                <div class="text-xs text-secondary pt-1">
                  Supplier Dan Barang Memiliki Relasi
                </div>
                  
              @endif
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="barang">Kode Barang : </label>
                <div class="input-group input-group-sm">
                  <input type="text" wire:model="state.TEXT_BRG" name="barang" id="barang" class="form-control form-control-sm {{ $errors->has('state.FK_BRG') ? 'is-invalid':'' }}" placeholder=" - Silahkan Pilih Data Barang - " disabled>
                  <span class="input-group-append">
                    @if ($supplier != null)   
                    <button type="button" class="btn btn-danger btn-flat" wire:click="resetBarang">
                      <span class="fa fa-undo"></span>
                    </button>
                    <button type="button" class="btn btn-secondary btn-flat" wire:click="openModalBarang">Pilih Data Barang</button>
                    @endif
                  </span>

                  <div class="invalid-feedback">
                    {{ $errors->first('state.FK_BRG') }}
                  </div>
                </div> 
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="nama_barang_supplier">Nama Barang Pada Supplier : </label>
                <input type="text" wire:model="state.FN_BRG_SUP" name="nama_barang_supplier" id="nama_barang_supplier" class="form-control form-control-sm {{ $errors->has('state.FN_BRG_SUP') }}" placeholder="Masukan Nama Barang Supplier..." {{ $supplier != null && $barang != null ? '':'disabled' }}required>


                <div class="invalid-feedback">
                  {{ $errors->first('state.FN_BRG_SUP') }}
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="harga_supplier">Harga Barang Pada Supplier : </label>
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text font-weigth-bold">Rp.</span>
                  </div>
                <input type="number" wire:model="state.FHARGA_AKHIR" name="harga_supplier" id="harga_supplier" class="form-control form-control-sm {{ $errors->has('state.FHARGA_AKHIR') ? 'is-invalid' : '' }}" placeholder="Masukan Harga Barang Pada Supplier..." {{ $supplier != null && $barang != null ? '':'disabled' }} required>
 
                <div class="invalid-feedback">
                  {{ $errors->first('state.FHARGA_AKHIR') }}
                </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <hr class="mt-0 mb-3">
            </div>

            <div class="col-md-3">
              @if ($state['FKD_RLS'] != null)
              <button class="btn btn-sm btn-block btn-success" wire:click="updateData">
                <span class="fa fa-check mr-2"></span>
                Simpan Perubahan Data Relasi
              </button>
              @else
              <button class="btn btn-sm btn-block btn-success" wire:click="createData">
                <span class="fa fa-check mr-2"></span>
                Buat Data Relasi
              </button>
                
              @endif
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  @livewire('master-data.supplier-modal-data')
  @livewire('master-data.barang-modal-data')
</div>