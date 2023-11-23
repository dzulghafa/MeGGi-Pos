<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Barang;
use App\Models\RelasiBarangSupplier;
use App\Models\Suplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RlsBarangSupplier extends Component
{
    public $supplier = [];
    public $barang = [];
    public $state = [
        'FKD_RLS' => null,

        'FK_SUP' => null,
        'TEXT_SUP' => null,

        'FK_BRG' => null,
        'TEXT_BRG' => null,

        'FN_BRG_SUP' => '',
        'FHARGA_AKHIR' => '',
    ];

    protected $listeners = [
        'selectedSupplier',
        'selectedBarang'
    ];

    public function render()
    {
        return view('livewire.master-data.rls-barang-supplier');
    }

    public function openModalSupplier()
    {
        $this->emitTo('master-data.supplier-modal-data', 'openModalSupplier', [
            'showProps' => 'show',
            'source' => 'master-data.rls-barang-supplier'
        ]);
    }
    
    public function selectedSupplier($data)
    {
        if ($data != null) {
            $this->reset('supplier', 'state', 'barang');

            $this->supplier = $data;
            $this->state['FK_SUP'] = $data['FK_SUP'];
            $this->state['TEXT_SUP'] = $data['FK_SUP'] . ' - ' . $data['FNA_SUP'] . ' | ' . ($data['FNOTELP'] != null ? $data['FNOTELP']:'-') . ' | ' . ($data['FCONTACT'] != null ? $data['FCONTACT']:'-');
        }
    }

    public function resetSupplier()
    {
        $this->reset('supplier', 'barang', 'state');
        $this->state['FK_SUP'] = null;
        $this->state['TEXT_SUP'] = null;
    }

    public function openModalBarang()
    {
        $this->emitTo('master-data.barang-modal-data', 'openModalBarang', [
            'showProps' => 'show',
            'source' => 'master-data.rls-barang-supplier', 
        ]);
    }

    public function selectedBarang($data)
    {
        $this->resetErrorBag();

        if ($data != null) {
            $this->reset('barang');
            $this->barang = $data;
            $this->state['FKD_RLS'] = null;
            $this->state['FN_BRG_SUP'] = null;
            $this->state['FHARGA_AKHIR'] = null;   

            $this->state['FK_BRG'] = $data['FK_BRG'];
            $this->state['TEXT_BRG'] = $data['FK_BRG'] . ' - ' . $data['FN_BRG']; 

            $this->checkRelasiBarang($data['FK_BRG']);
        }
    }

    public function checkRelasiBarang($idBarang)
    {
            try {
                    $checkRelasi = RelasiBarangSupplier::where('FK_SUP', '=', $this->supplier)
                        ->where('FK_BRG', '=', $idBarang)
                        ->first();
                    if ($checkRelasi != null) {
                        $this->state['FKD_RLS'] = $checkRelasi->FKD_RLS;
                        $this->state['FN_BRG_SUP'] = $checkRelasi->FN_BRG_SUP;
                        $this->state['FHARGA_AKHIR'] = $checkRelasi->FHARGA_AKHIR;   
                    }
                } catch (\Exception $e) {
                dd($e);
            }    
    }

    function resetBarang()
    {
        $this->reset('barang');
        $this->state['FKD_RLS'] = null;
        $this->state['FK_BRG'] = null;
        $this->state['TEXT_BRG'] = null;

        $this->state['FN_BRG_SUP'] = null;
        $this->state['FHARGA_AKHIR'] = null;
    }

    public function createData()
    {
        $this->resetErrorBag();
        $this->validate([
            'state.FK_SUP' => 'required|string|exists:supliers,FK_SUP',
            'state.FK_BRG' => 'required|string|exists:barangs,FK_BRG',
            'state.FN_BRG_SUP' => 'required|string', 
            'state.FHARGA_AKHIR' => 'required|numeric',

        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !', 
            'string' => 'Input Harus Berupa Alphanumeric !',
            'numeric' => 'Input Harus Berupa Numeric (0-9)   !',
            'exists' => 'Data Tidak VAlid ! Silahkan Pilih Ulang Data !', 
        ]);

        DB::beginTransaction();
        try {
            $getSupplier = Suplier::where('FK_SUP', '=', $this->supplier['FK_SUP'])->firstOrFail();
            $getBarang = Barang::where('FK_BRG', '=', $this->barang['FK_BRG'])->firstOrFail();

            $createData = RelasiBarangSupplier::create([
                'FKD_RLS' => $getSupplier->FK_SUP . $getBarang->FK_BRG,
                'FK_SUP' => $getSupplier->FK_SUP, 
                'FK_BRG' => $getBarang->FK_BRG,
                'FN_BRG_SUP' => trim($this->state['FN_BRG_SUP']),
                'FHARGA_AKHIR' => trim($this->state['FHARGA_AKHIR']),
            ]);

            DB::commit();
            $this->emit('success', 'Data Relasi di-Tambahkan !');

            $this->reset('state', 'barang');
            $this->selectedSupplier($getSupplier->toArray());

        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }

    }

    public function updateData()
    {
        $this->resetErrorBag();
        $this->validate([
            'state.FK_SUP' => 'required|string|exists:supliers,FK_SUP',
            'state.FK_BRG' => 'required|string|exists:barangs,FK_BRG',
            'state.FN_BRG_SUP' => 'required|string', 
            'state.FHARGA_AKHIR' => 'required|numeric',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !', 
            'string' => 'Input Harus Berupa Alphanumeric !',
            'numeric' => 'Input Harus Berupa Numeric (0-9)   !',
            'exists' => 'Data Tidak VAlid ! Silahkan Pilih Ulang Data !', 
        ]);

        DB::beginTransaction();

        try {
            $getData = RelasiBarangSupplier::where('FKD_RLS', '=', $this->state['FKD_RLS'])->firstOrFail();
            $getSupplier = Suplier::where('FK_SUP', '=', $this->supplier['FK_SUP'])->firstOrFail();
            $getBarang = Barang::where('FK_BRG', '=', $this->barang['FK_BRG'])->firstOrFail();

            $updateData = $getData->update([
                'FN_BRG_SUP' => trim($this->state['FN_BRG_SUP']),
                'FHARGA_AKHIR' => trim($this->state['FHARGA_AKHIR']),

            ]);

            DB::commit();
            $this->emit('info', 'Perubahan Data di-Simpan ! ');

            $this->reset('state', 'barang');
            $this->selectedSupplier($getSupplier->toArray());

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
