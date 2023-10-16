<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Satuan;
use Livewire\Component;
use Livewire\WithPagination;

class SatuanModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalSatuan'
    ];

    public function render()
    {
        $getData = new Satuan();

        $getData = $getData->orderBy('FK_SAT', 'ASC')->paginate(10);

        return view('livewire.master-data.satuan-modal-data', [
            'dataSatuan' => $getData
        ]);
    }

    public function openModalSatuan($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-satuan', $showProps);
    }

    public function pilihSatuan($id)
    {
        try {
            $getData = Satuan::where('FK_SAT', '=', $id)->firstOrFail();

            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedSatuan', $getData->toArray());
            }

            $this->emit('modal-satuan', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Asministrator');
            dd($e);
        }
    }
}
