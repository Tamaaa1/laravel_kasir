<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use Livewire\Component;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\Produk;

class Transaksi extends Component
{
    public $kode, $total, $kembalian, $totalSemuaBelanja;
    public $bayar=0;
    public $transaksiAktif;
    public $useNameSearch = false; // Default: input kode barang
public $search = ''; // Kata kunci pencarian nama barang
public $suggestions = []; // Hasil pencarian barang

    public function transaksiBaru(){
        $this->reset();
        $this->transaksiAktif= new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/'.date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }
    public function hapusProduk($id)
    {
        $detil = DetilTransaksi::find($id);
        if($detil){
            $produk = produk::find($detil->produk_id);
            $produk->stok += $detil->jumlah;
            $produk->save();
        }
        $detil->delete();
    }
    public function transaksiSelesai(){
        $this->transaksiAktif->total=$this->totalSemuaBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();
        $this->reset();
    }
    public function batalTransaksi(){
        if($this->transaksiAktif){
            $detilTransaksi = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil){
                $produk = produk::find($detil->produk_id);
                $produk->stok += $detil->jumlah;
                $produk->save();
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset();
    }
    public function updatedKode(){
        $produk = Produk::where('kode',$this->kode)->first();
        if($produk && $produk->stok > 0 ){
            $detil= DetilTransaksi::firstOrNew([
                'transaksi_id' => $this->transaksiAktif->id,
                'produk_id'=> $produk->id
            ],[
                'jumlah' => 0,
            ]);
            $detil->jumlah += 1;
            $detil->save();
            $produk->stok -= 1;
            $produk->save();
            $this->reset('kode');
        }
    }
    public function updatedBayar(){
        if($this->bayar>0){
            $this->kembalian = $this->bayar - $this->totalSemuaBelanja;
        }
    }
    public function render()
    {
        if($this->transaksiAktif){
            $semuaProduk = DetilTransaksi::where('transaksi_id',$this->transaksiAktif->id)->get();
            $this->totalSemuaBelanja = $semuaProduk ->sum(function($detil){
                return $detil->produk->harga * $detil->jumlah;
            });
        } else{
            $semuaProduk=[];
        }
        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }
    public function updatedSearch()
{
    $this->suggestions = \App\Models\Produk::where('nama', 'like', '%' . $this->search . '%')
        ->limit(5)
        ->get();
}

public function selectProduct($id)
{
    $product = \App\Models\Produk::find($id);

    if ($product) {
        $this->kode = $product->kode; // Masukkan kode barang
        $this->suggestions = [];
        $this->addProductToTransaction($product); // Pastikan metode ini menambah produk ke transaksi
    }

    
}
public function hapusTransaksiPending()
{
    $deletedRows = \App\Models\Transaksi::where('status', 'pending')
        ->where('total', 0)
        ->delete();

    // Tambahkan pesan konfirmasi
    session()->flash('message', "Berhasil menghapus {$deletedRows} transaksi pending dengan total 0.");
}

}