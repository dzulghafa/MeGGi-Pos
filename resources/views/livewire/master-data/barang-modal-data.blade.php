<div>
  <div wire:ignore.self class="modal fade" id="modal-barang">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" wire:click="$refresh">
            <span class="fa fa-table mr-3"></span>
            Daftar Data Supplier
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table bordered mb-0">
                <thead>
                  <tr>
                    <th class="align-middle px-2 py-2 text-center" width="10%" >Kode</th>
                    <th class="align-middle px-2 py-2" >Nama Supplier</th>
                    <th class="align-middle px-2 py-2" >Jenis</th>
                    <th class="align-middle px-2 py-2" >Satuan</th>
                    <th class="align-middle px-2 py-2 text-center" width="15%" >Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($dataBarang as $item)
                      <tr>
                        <td class="align-middle px-2 py-1 text-center font-weight-bold">{{ $item->FK_BRG }}</td>
                        <td class="align-middle px-2 py-1">{{ $item->FN_BRG }}</td>
                        <td class="align-middle px-2 py-1">{{ $item->jenis->FN_JENIS }}</td>
                        <td class="align-middle px-2 py-1">{{ $item->satuan->FN_SAT }}</td>
                        <td class="align-middle px-2 py-1 text-center">
                          <button class="btn btn-xs btn-success px-3" wire:click="pilihSupplier('{{ $item->FK_BRG }}')">
                            <span class="fa fa-check mr-2"></span>
                            Pilih Data
                          </button>
                        </td>
                      </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="align-middle px-2 py-2 text-center">Belum Ada Supplier.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <div class="float-right">
            {{ $dataBarang->links() }}
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

@push('script')
  <script>
    $(document).ready(function () {
      Livewire.on('modal-barang', function(showValue) {
        $('#modal-barang').modal(showValue);
      })
    });
  </script>
@endpush
