<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\User;

class Beranda extends Component
{
    public $totalTransaksi;
    public $pendapatanHariIni;
    public $totalProduk;
    public $penggunaAktif;
    public $transaksi;
    public $pendapatanBulanan;

    public function mount()
    {
        $this->totalTransaksi = Transaksi::count();
        $this->pendapatanHariIni = Transaksi::whereDate('created_at', today())->sum('total');
        $this->pendapatanBulanan = Transaksi::selectRaw('DATE(created_at) as tanggal, SUM(total) as total')
            ->where('created_at', '>=', now()->subMonth())
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at)')
            ->get();
        $this->transaksi = Transaksi::latest()->take(10)->get();
        $this->totalProduk = Produk::count();
        $this->penggunaAktif = User::count();
    }

    public function render()
    {
        return view('livewire.beranda');
    }
}


