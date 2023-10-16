<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Jenis;
use Livewire\Component;
use Livewire\WithPagination;

class JenisModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalJenis'
    ];

    public function render()
    {
        $getData = new Jenis;

        $getData = $getData->orderBy('FK_JENIS', 'ASC')->paginate(10);

        return view('livewire.master-data.jenis-modal-data', [
            'dataJenis' => $getData
        ]);
    }

    public function openModalJenis($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-jenis', $showProps);
    }

    public function pilihJenis($id)
    {
        try {
            $getData = Jenis::where('FK_JENIS', '=', $id)->firstOrFail();

            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedJenis', $getData->toArray());
            }

            $this->emit('modal-jenis', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Asministrator');
            dd($e);
        }
    }
}
