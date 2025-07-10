<div>
    <div class="container my-4">
        <div class="row mb-3 text-center">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-dark' : 'btn-outline-dark' }}">
                    Semua Produk
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-dark' : 'btn-outline-dark' }}">
                    Tambah Produk
                </button>
                <button wire:click="pilihMenu('excel')"
                    class="btn {{ $pilihanMenu == 'excel' ? 'btn-dark' : 'btn-outline-dark' }}">
                    Import Produk
                </button>
                <button wire:loading class="btn btn-secondary">
                    Loading ...
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5>Semua Produk</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk->kode }}</td>
                                            <td>{{ $produk->nama }}</td>
                                            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                            <td>{{ $produk->stok }}</td>
                                            <td>
                                                <button wire:click="pilihEdit({{ $produk->id }})"
                                                    class="btn btn-outline-info btn-sm">
                                                    Edit
                                                </button>
                                                <button wire:click="pilihHapus({{ $produk->id }})"
                                                    class="btn btn-outline-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'tambah')
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5>Tambah Produk</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpan">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" id="nama" class="form-control" wire:model="nama">
                                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode / Barcode</label>
                                    <input type="text" id="kode" class="form-control" wire:model="kode">
                                    @error('kode') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" id="harga" class="form-control" wire:model="harga">
                                    @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" id="stok" class="form-control" wire:model="stok">
                                    @error('stok') <span class="text-danger">Stok harus diisi</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit Produk
                        </div>
                        <div class="card-body">
                            <form wire:submit='simpanEdit'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama' />
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br />
                                <label>Kode / Barcode</label>
                                <input type="text" class="form-control" wire:model='kode' />
                                @error('kode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br />
                                <label>Harga</label>
                                <input type="number" class="form-control" wire:model='harga' />
                                @error('harga')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br />
                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model='stok' />
                                @error('stok')
                                    <span class="text-danger"> Stok Harus diIsi</span>
                                @enderror
                                <br />
                                <button type="submit" class="btn btn-primary mt-3">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'hapus')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus Produk
                        </div>
                        <div class="card-body">
                            Anda yakin akan menghapus Produk ini ?
                            <br />
                            <p>Kode : {{$produkTerpilih->kode}} </p>
                            <p>Nama : {{$produkTerpilih->nama}} </p>
                            <button class="btn btn-danger" wire:click='hapus'>HAPUS</button>
                            <button class="btn btn-secondary" wire:click='batal'>BATAL</button>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'excel')
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5>Import Produk</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="imporExcel">
                                <input type="file" class="form-control" wire:model="fileExcel">
                                <button class="btn btn-dark mt-3" type="submit">Upload</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>