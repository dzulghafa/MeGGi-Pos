<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Jenis;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class JenisMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $state = [];
    public $params = [
        'FK_JENIS' => null,
        'FN_JENIS' => null,

        'edit' => false,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = Jenis::orderBy('FK_JENIS', 'ASC')->paginate(10);

        return view('livewire.master-data.jenis-main-index', [
            'dataJenis' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->reset('state');
        $this->state = $this->params;

        $this->form = $show;
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FK_JENIS'] = $data['FK_JENIS'];
            $this->state['FN_JENIS'] = $data['FN_JENIS'];
        }
    }

    public function createData()
    {
        $this->validate([
            'state.FK_JENIS' => 'required|string|unique:jenis,FK_JENIS',
            'state.FN_JENIS' => 'required|string',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan  Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik !',
        ]);


        DB::beginTransaction();
        try {
            $createData = Jenis::create([
                'FK_JENIS' => trim($this->state['FK_JENIS']),
                'FN_JENIS' => trim($this->state['FN_JENIS'])
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
            $getData = Jenis::where('FK_JENIS', '=', $id)->firstOrFail();
            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_JENIS' => 'required|string|exists:jenis,FK_JENIS',
            'state.FN_JENIS' => 'required|string',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan  Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik !',
        ]);

        DB::beginTransaction();
        try {
            $getData = Jenis::where('FK_JENIS', '=', $this->state['FK_JENIS'])->firstOrFail();
            $updateData = $getData->update([
                'FN_JENIS' => trim($this->state['FN_JENIS'])
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
            $getData = Jenis::where('FK_JENIS', '=', $id)->firstOrFail();
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
