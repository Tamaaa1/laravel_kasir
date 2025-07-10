<div>
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Laporan Transaksi</h5>
                        <a href="{{ url('/cetak') }}" target="_blank" class="btn btn-outline-light btn-sm">
                            CETAK
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>No Inv.</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaTransaksi as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $transaksi->kode }}</td>
                                        <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
