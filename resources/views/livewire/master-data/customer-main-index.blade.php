<div>
  <div class="row">
      <div class="col-12 {{ $form ? 'd-block': 'd-none'}}">
          <div class="card card-outline card-primary">
              <div class="card-header">
                  <h4 class="card-title">
                      <span class="fa fa-edit mr-3"></span>
                      Formulir Data Suplier
                  </h4>

                  <div class="card-tools">
                      <button class="btn btn-xs btn-danger px-3" wire:click="showForm(false)">
                          <span class="fa fa-times mr-2"></span>
                          Tutup Formulir
                      </button>
                  </div>
              </div>

              <div class="card-body text-sm py-2">
                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">
                              <label for="kode_customer">Kode Customer : <b class="text-danger">*</b></label>
                              <input type="text" wire:model="state.FK_CUS" name="kode_customer" id="kode_customer" class="text form-control form-control-sm {{ $errors->has('state.FK_CUS') ? 'is-invalid':'' }}" placeholder="Masukan Kode Customer..." {{ $state['edit'] == true ? 'disable':'' }} required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FK_CUS') }}
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="nama_customer">Nama Customer : <b class="text-danger">*</b></label>
                              <input type="text" wire:model="state.FNA_CUS" name="nama_customer" id="nama_customer" class="text form-control form-control-sm {{ $errors->has('state.FNA_CUS') ? 'is-invalid':'' }}" placeholder="Masukan Nama Customer..." required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FNA_CUS') }}
                              </div>
                          </div>
                      </div>

                      <div class="col-md-2">
                          <div class="form-group">
                              <label for="no_telp">Nomor Telfon : </label>
                              <input type="text" wire:model="state.FNOTELP" name="no_telp" id="no_telp" class="text form-control form-control-sm {{ $errors->has('state.FNOTELP') ? 'is-invalid':'' }}" placeholder="Masukan Nomor Telfon..." required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FNOTELP') }}
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="nama_customer">Nama Kontak : </label>
                              <input type="text" wire:model="state.FCONTACT" name="nama_customer" id="nama_customer" class="text form-control form-control-sm {{ $errors->has('state.FCONTACT') ? 'is-invalid':'' }}" placeholder="Masukan Nama Kontak..." required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FCONTACT') }}
                              </div>
                          </div>
                      </div>

                      <div class="col-12">
                        <div class="form-group mb-0">
                          <label for="alamat">Alamat Customer : </label>
                          <textarea wire:model="state.FALAMAT" name="alamat" id="alamat" cols="1" rows="1" class="form-control form-control-sm {{ $errors->has('state.FALAMAT') ? 'is-invalid':'' }}" placeholder="Masukan Alamat Customer..."></textarea>
                          <div class="invalid-feedback">
                            {{ $errors->first('state.FALAMAT') }}
                          </div>
                        </div>
                      </div>

                  </div>
              </div>

              <div class="card-footer">
                  <div class="row">
                      @if ($state['edit'] == true)
                          <div class="col-md-3">
                              <button class="btn btn-block btn-sm btn-success" wire:click="updateData">
                                  <span class="fa fa-check mr-2"></span>
                                  Simpan Perubahan Data Customer
                              </button>
                          </div>
                      
                      @else
                      <div class="col-md-3">
                          <button class="btn btn-block btn-sm btn-success" wire:click="createData">
                              <span class="fa fa-check mr-2"></span>
                              Buat Data Customer
                          </button>
                      </div>
                      @endif
                      <div class="col-md-3">
                          <button class="btn btn-block btn-sm btn-danger" wire:click="showForm(false)">
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
                          Master Data Customer                       
                  </h4>

                  <div class="card-tools">
                      <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                          <span class="fa fa-plus mr-2"></span>
                          Tambah Data Customer
                      </button>
                  </div>
              </div>

              <div class="card-body p-0 table-responsive">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th class="align-middle px-2 py-2 text-center">
                                  No.
                              </th>
                              <th class="align-middle px-2 py-2 text-center">
                                  Kode Suplier
                              </th>
                              <th class="align-middle px-2 py-2 text-center">
                                  Nama Suplier
                              </th>
                              <th class="align-middle px-2 py-2 text-center">
                                  Aksi
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($dataCustomer as $item)
                              <tr>
                                  <td class="align-middle px-2 py-1 txt-center">
                                      {{ ($dataCustomer->currentpage()-1) * $dataCustomer->perpage() + $loop->index + 1 }}.
                                  </td>
                                  <td class="align-middle px-2 py-1 text-center">{{ $item->FK_CUS }}</td>
                                  <td class="align-middle px-2 py-1 text-center">{{ $item->FNA_CUS }}</td>
                                  <td class="align-middle px-2 py-1 text-center">
                                      <div class="btn-group">
                                          <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_CUS }}')">
                                              <span class="fa fa-edit"></span>
                                          </button>
                                          <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_CUS }}')">
                                              <span class="fa fa-trash"></span>
                                          </button>
                                      </div>
                                  </td>
                              </tr>
                          @empty
                          <tr>
                              <td class="align-middle text-center" colspan="4">Belum Ada Data Suplier</td>
                          </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>

              <div class="card-footer">
                  <div class="float-right">
                      {{ $dataCustomer->links() }}
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
