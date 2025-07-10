<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;

class Laporan extends Component
{
    public function mount(){
        if(auth()->user()->peran != 'admin'){
            abort(403);
        }
    }
    public function render()
    {
        $semuaTransaksi = Transaksi::where('status','selesai')->get();
        return view('livewire.laporan')->with([
            'semuaTransaksi' => $semuaTransaksi
        ]);
    }
}
