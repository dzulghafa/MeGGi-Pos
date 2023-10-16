<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BarangMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $jenis = [];
    public $satuan = [];

    public $state = [];
    public $params = [
        'FK_BRG' => null,
        'FN_BRG' => null,

        'FK_JENIS' => null,
        'TEXT_JENIS' => null,

        'FK_SAT' => null,
        'TEXT_SATUAN' => null,
        
        'FHARGA_HNA' => null,
        'FHARGA_JUAL' => null,
        'FPROFIT' => null, 

        'edit' => false,
    ];

    protected $listeners = [
        'selectedJenis',
        'selectedSatuan'
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = Barang::orderBy('FK_BRG', 'ASC')->paginate(10);

        return view('livewire.master-data.barang-main-index', [
            'dataBarang' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->reset('state', 'jenis', 'satuan');
        $this->state = $this->params;

        $this->form = $show;
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FK_BRG'] = $data['FK_BRG'];
            $this->state['FN_BRG'] = $data['FN_BRG'];

            if ($data['jenis'] !=null) {
                $this->state['FK_JENIS'] = $data['FK_JENIS'];
                $this->state['TEXT_JENIS'] = $data['jenis']['FK_JENIS'] . ' - ' . $data['jenis']['FN_JENIS'];
            }

            if ($data['satuan'] !=null) {
                $this->state['FK_SAT'] = $data['FK_SAT'];
                $this->state['TEXT_SATUAN'] = $data['satuan']['FK_SAT'] . ' - ' . $data['satuan']['FN_SAT'];
            }

            
            $this->state['FHARGA_HNA'] = $data['FHARGA_HNA'];
            $this->state['FHARGA_JUAL'] = $data['FHARGA_JUAL'];
            $this->state['FPROFIT'] = $data['FPROFIT'];
        }
    }

    public function openModalJenis()
    {
        $this->emitTo('master-data.jenis-modal-data', 'openModalJenis', [
            'showProps' => 'show', 
            'source' => 'master-data.barang-main-index'
        ]);
    }

    public function selectedJenis($data)
    {
        if ($data != null) {
            $this->reset('jenis');

            $this->jenis = $data;
            $this->state['FK_JENIS'] = $data['FK_JENIS'];
            $this->state['TEXT_JENIS'] = $data['FK_JENIS']  . ' - ' . $data['FN_JENIS'];

        }
    }

    public function openModalSatuan()
    {
        $this->emitTo('master-data.satuan-modal-data', 'openModalSatuan', [
            'showProps' => 'show',
            'source' => 'master-data.barang-main-index'
        ]);
    }

    public function selectedSatuan($data)
    {
        if ($data != null) {
            $this->satuan = $data;
            $this->state['FK_SAT'] = $data['FK_SAT'];
            $this->state['TEXT_SATUAN'] = $data['FK_SAT'] . ' - ' . $data['FN_SAT'];
        }
    }

    public function createData()
    {
        $this->validate([
            'state.FK_BRG' => 'required|string|unique:barangs,FK_BRG',
            'state.FN_BRG' => 'required|string',

            'state.FK_JENIS' => 'required|exists:jenis,FK_JENIS',
            'state.FK_SAT' => 'required|exists:satuans,FK_SAT',
            'state.FHARGA_HNA' => 'required|numeric|min:0',
            'state.FHARGA_JUAL' => 'required|numeric|min:0',
            'state.FPROFIT' => 'required|numeric|min:0', 
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan  Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',

        ]);

        DB::beginTransaction();
        try {
            $createData = Barang::create([
                'FK_BRG' => trim($this->state['FK_BRG']),
                'FN_BRG' => trim($this->state['FN_BRG']),

                
                'FK_JENIS'=> trim($this->state['FK_JENIS']),
                'FK_SAT'=> trim($this->state['FK_SAT']),
                'FHARGA_HNA'=> trim($this->state['FHARGA_HNA']),
                'FHARGA_JUAL'=> trim($this->state['FHARGA_JUAL']),
                'FPROFIT'=> trim($this->state['FPROFIT']),
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
            $getData = Barang::with([
                'jenis',
                'satuan'
            ])->where('FK_BRG', '=', $id)->firstOrFail();
            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_BRG' => 'required|string|exists:barangs,FK_BRG',
            'state.FN_BRG' => 'required|string',

            'state.FK_JENIS' => 'required|exists:jenis,FK_JENIS',
            'state.FK_SAT' => 'required|exists:satuans,FK_SAT',
            'state.FHARGA_HNA' => 'required|numeric|min:0',
            'state.FHARGA_JUAL' => 'required|numeric|min:0',
            'state.FPROFIT' => 'required|numeric|min:0', 
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan  Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',
        ]);

        DB::beginTransaction();
        try {
            $getData = Barang::where('FK_BRG', '=', $this->state['FK_BRG'])->firstOrFail();
            $updateData = $getData->update([
                'FN_BRG' => trim($this->state['FN_BRG']),
                
                'FK_JENIS'=> trim($this->state['FK_JENIS']),
                'FK_SAT'=> trim($this->state['FK_SAT']),
                'FHARGA_HNA'=> trim($this->state['FHARGA_HNA']),
                'FHARGA_JUAL'=> trim($this->state['FHARGA_JUAL']),
                'FPROFIT'=> trim($this->state['FPROFIT']),
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
            $getData = Barang::where('FK_BRG', '=', $id)->firstOrFail();
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
