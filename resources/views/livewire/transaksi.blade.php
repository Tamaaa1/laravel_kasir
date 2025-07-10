<div>
@if (session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }}
    </div>
@endif
    <div class="container my-4">
        <div class="row mb-3">
            <div class="col-12 text-center">
                @if(!$transaksiAktif)
                    <button class="btn btn-dark" wire:click='transaksiBaru'>Transaksi Baru</button>
                @else
                    <button class="btn btn-danger" wire:click='batalTransaksi'>Batalkan Transaksi</button>
                @endif
                            <!-- Tombol Hapus Transaksi Pending -->
            <button class="btn btn-warning" wire:click='hapusTransaksiPending'>
                Hapus Transaksi Pending
            </button>

                <button class="btn btn-secondary" wire:loading>Loading ...</button>
            </div>
        </div>

        @if($transaksiAktif)
        <div class="row">
            <!-- Produk Section -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5>No Invoice: {{ $transaksiAktif->kode }}</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control mb-3" placeholder="No Kode" wire:model.live='kode'>
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->produk->kode }}</td>
                                        <td>{{ $produk->produk->nama }}</td>
                                        <td>Rp {{ number_format($produk->produk->harga, 0, ',', '.') }}</td>
                                        <td>{{ $produk->jumlah }}</td>
                                        <td>Rp {{ number_format($produk->produk->harga * $produk->jumlah, 0, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-outline-danger btn-sm" wire:click='hapusProduk({{ $produk->id }})'>Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detail Transaksi Section -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5>Total Biaya</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Rp</span>
                            <span>{{ number_format($totalSemuaBelanja, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white">
                        <h5>Bayar</h5>
                    </div>
                    <div class="card-body">
                        <input type="number" class="form-control" placeholder="Bayar" wire:model.live='bayar'>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white">
                        <h5>Kembalian</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Rp</span>
                            <span>{{ number_format($kembalian, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @if ($bayar)
                    @if($kembalian < 0)
                        <div class="alert alert-danger mt-3">Uang Kurang</div>
                    @else
                        <button class="btn btn-success mt-3 w-100" wire:click='transaksiSelesai'>Bayar</button>
                    @endif
                @endif
            </div>
        </div>
        @endif
    </div>
</div>