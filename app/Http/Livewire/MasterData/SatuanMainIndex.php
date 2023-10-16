<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SatuanMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;
    public $state = [];
    public $params = [
        'FK_SAT' => null,
        'FN_SAT' => null,
        'edit' => false,
    ];
    
    public function mount ()
    {
        $this->state = $this->params;

    }

    public function showForm($show)
    {
        $this->reset('state');
        $this->state = $this->params;

        $this->form = $show;
    }

    public function render()
    {
        $getData = Satuan::orderBy('FK_SAT', 'ASC')->paginate(10);

        return view('livewire.master-data.satuan-main-index', [
            'dataSatuan' => $getData
        ]);
    }

    public function createData()
    {
        $this->validate([
            'state.FK_SAT' => 'required|string|unique:satuans,FK_SAT',
            'state.FN_SAT' => 'required|string'
        ]);

        try {
            $createData = Satuan::create([
                'FK_SAT' => $this->state['FK_SAT'],
                'FN_SAT' => $this->state['FN_SAT'],
            ]);

            DB::commit();
            $this->emit('success', 'Data Berhasil di-Buat ! ');
            $this->showForm(false);

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function editData($id)
    {
        try {
            $getData = Satuan::where('FK_SAT', '=', $id)->firstOrFail();
            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator');
            dd($e);
        }
    }

    public function deleteData($id)
    {
        DB::beginTransaction();

        try {
            $getData = Satuan::where('FK_SAT', '=', $id)->firstOrFail();
            $deleteData = $getData->delete();

            DB::commit();
            $this->emit('warning', 'Data di-Hapus !');
            $this->showForm(false);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'Terjadi Kesalahans ! <br> Slahkan Hubungi Administrator');
            dd($e);
        }
    }
}
