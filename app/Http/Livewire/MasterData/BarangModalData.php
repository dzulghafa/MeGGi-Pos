<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class BarangModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalBarang'
    ];

    public function render()
    {
        $getData = new Barang();

        $getData = $getData->orderBy('FK_BRG', 'ASC')->paginate(10);

        return view('livewire.master-data.barang-modal-data', [
            'dataBarang' => $getData
        ]);
    }

    public function openModalBarang($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-barang', $showProps);
    }

    public function pilihSupplier($id)
    {
        try {
            $getData = Barang::where('FK_BRG', '=', $id)->firstOrFail();

            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedBarang', $getData->toArray());
            }

            $this->emit('modal-supplier', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Asministrator');
            dd($e);
        }
    } 
}
