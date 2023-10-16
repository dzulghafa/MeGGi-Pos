<div>
  <div class="row">
      <div class="col-12 {{ $form ? 'd-block': 'd-none'}}">
          <div class="card card-outline card-primary">
              <div class="card-header">
                <h4 class="card-title">
                  <span class="fa fa-edit mr-3"></span>
                      Formulir Data Barang
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
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="kode_barang">Kode Barang : </label>
                              <input type="text" wire:model="state.FK_BRG" name="kode_barang" id="kode_barang" class="text form-control form-control-sm {{ $errors->has('state.FK_BRG') ? 'is-invalid':'' }}" placeholder="Masukan Kode Barang..." required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FK_BRG') }}
                                </div>
                              </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis_barang">Jenis Barang : </label>
                            <div class="float-right">
                              <button class="badge badge-info px-3" wire:click="openModalJenis">
                                Pilih Data Jenis
                              </button>
                            </div>
                            <input type="text" wire:model="state.TEXT_JENIS" name="jenis_barang" id="jenis_barang" class="text form-control form-control-sm {{ $errors->has('state.FK_JENIS') ? 'is-invalid':'' }}" placeholder=" - Pilih Jenis Barang" disabled required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FK_JENIS') }}
                            </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="satuan_barang">Satuan Barang : </label>
                            <div class="float-right">
                              <button class="badge badge-info px-3" wire:click="openModalSatuan">
                                Pilih Data Satuan
                              </button>
                            </div>
                            <input type="text" wire:model="state.TEXT_SATUAN" name="satuan_barang" id="satuan_barang" class="text form-control form-control-sm {{ $errors->has('state.FK_SAT') ? 'is-invalid':'' }}" placeholder=" - Pilih Satuan Barang" disabled required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FK_SAT') }}
                            </div> 
                        </div>
                      </div>
                            
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="nama_barang">Nama Barang : </label>
                              <input type="text" wire:model="state.FN_BRG" name="nama_barang" id="nama_barang" class="text form-control form-control-sm {{ $errors->has('state.FN_BRG') ? 'is-invalid':'' }}" placeholder="Masukan Nama Barang..." required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FN_BRG') }}
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="harga_hna">Harga HNA : </label>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text font-weight-bold">Rp.</span>
                                </div>
                                  <input type="number" wire:model="state.FHARGA_HNA" name="harga_hna" id="harga_hna" class="text form-control form-control-sm {{ $errors->has('state.FHARGA_HNA') ? 'is-invalid':'' }}" placeholder="Masukan Harga HNA..." required>
                                  <div class="invalid-feedback">
                                      {{ $errors->first('state.FHARGA_HNA') }}
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="harga_jual">Harga Jual : </label>
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text font-weight-bold">Rp.</span>
                                </div>
                                  <input type="number" wire:model="state.FHARGA_JUAL" name="harga_jual" id="harga_jual" class="text form-control form-control-sm {{ $errors->has('state.FHARGA_JUAL') ? 'is-invalid':'' }}" placeholder="Masukan Harga Jual..." required>
                                  <div class="invalid-feedback">
                                      {{ $errors->first('state.FHARGA_JUAL') }}
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="profit">Profit : </label>
                              <input type="number" wire:model="state.FPROFIT" name="profit" id="profit" class="text form-control form-control-sm {{ $errors->has('state.FPROFIT') ? 'is-invalid':'' }}" placeholder="Masukan Profit..." required>
                              <div class="invalid-feedback">
                                  {{ $errors->first('state.FPROFIT') }}
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
                                  Simpan Perubahan Data Barang
                              </button>
                          </div>
                      
                      @else
                      <div class="col-md-3">
                          <button class="btn btn-block btn-sm btn-success" wire:click="createData">
                              <span class="fa fa-check mr-2"></span>
                              Buat Data Barang
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
                          Master Data Barang                       
                  </h4>

                  <div class="card-tools">
                      <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                          <span class="fa fa-plus mr-2"></span>
                          Tambah Data Barang
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
                                  Kode Barang
                              </th>
                              <th class="align-middle px-2 py-2 text-center">
                                  Nama Barang
                              </th>
                              <th class="align-middle px-2 py-2 text-center">
                                  Aksi
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($dataBarang as $item)
                              <tr>
                                  <td class="align-middle px-2 py-1 txt-center">
                                      {{ ($dataBarang->currentpage()-1) * $dataBarang->perpage() + $loop->index + 1 }}.
                                  </td>
                                  <td class="align-middle px-2 py-1 text-center">{{ $item->FK_BRG }}</td>
                                  <td class="align-middle px-2 py-1 text-center">{{ $item->FN_BRG }}</td>
                                  <td class="align-middle px-2 py-1 text-center">
                                      <div class="btn-group">
                                          <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_BRG }}')">
                                              <span class="fa fa-edit"></span>
                                          </button>
                                          <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_BRG }}')">
                                              <span class="fa fa-trash"></span>
                                          </button>
                                      </div>
                                  </td>
                              </tr>
                          @empty
                          <tr>
                              <td class="align-middle text-center" colspan="4">Belum Ada Data Barang</td>
                          </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>

              <div class="card-footer">
                  <div class="float-right">
                      {{ $dataBarang->links() }}
                  </div>
              </div>
          </div>
      </div>
  </div>
  @livewire('master-data.jenis-modal-data')
  @livewire('master-data.satuan-modal-data')
</div>

