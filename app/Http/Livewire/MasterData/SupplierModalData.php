<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Suplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalSupplier'
    ];

    public function render()
    {
        $getData = new Suplier();

        $getData = $getData->orderBy('FK_SUP', 'ASC')->paginate(10);

        return view('livewire.master-data.supplier-modal-data', [
            'dataSuplier' => $getData
        ]);
    }

    public function openModalSupplier($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-supplier', $showProps);
    }

    public function pilihSupplier($id)
    {
        try {
            $getData = Suplier::where('FK_SUP', '=', $id)->firstOrFail();

            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedSupplier', $getData->toArray());
            }

            $this->emit('modal-supplier', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Asministrator');
            dd($e);
        }
    } 
}
