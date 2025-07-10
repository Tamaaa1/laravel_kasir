<div>
    <div class="container my-4">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-dark' : 'btn-outline-dark' }}">
                    Semua Pengguna
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-dark' : 'btn-outline-dark' }}">
                    Tambah Pengguna
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
                            <h5>Semua Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaPengguna as $pengguna)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengguna->name }}</td>
                                            <td>{{ $pengguna->email }}</td>
                                            <td>{{ ucfirst($pengguna->peran) }}</td>
                                            <td>
                                                <button wire:click="pilihEdit({{ $pengguna->id }})"
                                                    class="btn btn-outline-info btn-sm">
                                                    Edit
                                                </button>
                                                <button wire:click="pilihHapus({{ $pengguna->id }})"
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
                            <h5>Tambah Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpan">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" id="nama" class="form-control" wire:model="nama">
                                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" wire:model="email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" class="form-control" wire:model="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="peran" class="form-label">Peran</label>
                                    <select id="peran" class="form-select" wire:model="peran">
                                        <option value="">Pilih Peran</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('peran') <span class="text-danger">Peran harus diisi</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-dark">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit Pengguna
                        </div>
                        <div class="card-body">
                            <form wire:submit='simpanEdit'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama' />
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br />
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model='email' />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br />
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model='password' />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br />
                                <label>Peran</label>
                                <select class="form-control" wire:model='peran'>
                                    <option>Pilih Peran</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('email')
                                    <span class="text-danger"> Peran Harus diIsi</span>
                                @enderror
                                <br />
                                <button type="submit" class="btn btn-primary mt-3">SIMPAN</button>
                                <button type="button" wire:click='batal' class="btn btn-secondary mt-3">BATAL</button>
                            </form>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'hapus')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus Pengguna
                        </div>
                        <div class="card-body">
                            Anda yakin akan menghapus pengguna ini ?
                            <p>Nama : {{$penggunaTerpilih->name}} </p>
                            <button class="btn btn-danger" wire:click='hapus'>HAPUS</button>
                            <button class="btn btn-secondary" wire:click='batal'>BATAL</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>