<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Suplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SuplierMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $state = [];
    public $params = [
        'FK_SUP' => null,
        'FNA_SUP' => null,
        'FNOTELP' => null,
        'FALAMAT' => null,
        'FCONTACT' => null,

        'edit' => false,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = Suplier::orderBy('FK_SUP', 'ASC')->paginate(10);

        return view('livewire.master-data.suplier-main-index', [
            'dataSuplier' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->reset('state');
        $this->state = $this->params;

        $this->form = $show;
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FK_SUP'] = $data['FK_SUP'];
            $this->state['FNA_SUP'] = $data['FNA_SUP'];
            $this->state['FNOTELP'] = $data['FNOTELP'];
            $this->state['FALAMAT'] = $data['FALAMAT'];
            $this->state['FCONTACT'] = $data['FCONTACT'];
        }
    }

    public function createData()
    {
        $this->validate([
            'state.FK_SUP' => 'required|string|unique:supliers,FK_SUP',
            'state.FNA_SUP' => 'required|string',
            'state.FNOTELP' => 'nullable|string',
            'state.FALAMAT' => 'nullable|string',
            'state.FCONTACT' => 'nullable|string',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan  Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik !',
        ]);


        DB::beginTransaction();
        try {
            $createData = Suplier::create([
                'FK_SUP' => trim($this->state['FK_SUP']),
                'FNA_SUP' => trim($this->state['FNA_SUP']),
                'FNOTELP'=> trim($this->state['FNOTELP']),
                'FALAMAT'=> trim($this->state['FALAMAT']),
                'FCONTACT'=> trim($this->state['FCONTACT']),
            ]);
            
            DB::commit();
            $this->emit('success', 'Data Berhasil di-Tambahkan !');
            $this->showForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrasi');
            dd($e);
        }
    }

    public function editData($id)
    {
        try {
            $getData = Suplier::where('FK_SUP', '=', $id)->firstOrFail();
            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_SUP' => 'required|string|exists:supliers,FK_SUP',
            'state.FNA_SUP' => 'required|string',
            'state.FNOTELP' => 'nullable|string',
            'state.FALAMAT' => 'nullable|string',
            'state.FCONTACT' => 'nullable|string',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan  Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik !',
        ]);

        DB::beginTransaction();
        try {
            $getData = Suplier::where('FK_SUP', '=', $this->state['FK_SUP'])->firstOrFail();
            $updateData = $getData->update([
                'FK_SUP' => trim($this->state['FK_SUP']),
                'FNA_SUP' => trim($this->state['FNA_SUP']),
                'FNOTELP'=> trim($this->state['FNOTELP']),
                'FALAMAT'=> trim($this->state['FALAMAT']),
                'FCONTACT'=> trim($this->state['FCONTACT']),
            ]);

            DB::commit();
            $this->emit('info', 'Informasi Perubahan Data di-Simpan !');
            $this->showForm(false);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'erjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
        
    }

    public function deleteData($id)
    {
        DB::beginTransaction();

        try {
            $getData = Suplier::where('FK_SUP', '=', $id)->firstOrFail();
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

    public function dummy()
    {
        dd($this->state);
    }
}

