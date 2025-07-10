<div>
    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-3">
                <div class="p-3 bg-dark text-white shadow-sm rounded">
                    <h3>Total Transaksi</h3>
                    <p class="fs-4">{{ $totalTransaksi }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-secondary text-white shadow-sm rounded">
                    <h3>Pendapatan Hari Ini</h3>
                    <p class="fs-4">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-light text-dark shadow-sm rounded animate__animated animate__fadeIn">
                    <h3>Total Produk</h3>
                    <p class="fs-4">{{ $totalProduk }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 bg-dark text-white shadow-sm rounded animate__animated animate__fadeIn">
                    <h3>Pengguna Aktif</h3>
                    <p class="fs-4">{{ $penggunaAktif }}</p>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <h3 class="fs-4 mb-3">Ringkasan Transaksi</h3>
            <div class="col">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td><span class="badge bg-{{ $item->status == 'selesai' ? 'success' : 'warning' }}">{{ $item->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pendapatan Bulanan -->
        <div class="row my-5">
            <h3 class="fs-4 mb-3">Pendapatan 1 Bulan Terakhir</h3>
            <canvas id="pendapatanChart" style="height: 300px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pendapatanData = @json($pendapatanBulanan); // Data from controller

        const labels = pendapatanData.map(data => data.tanggal);
        const pendapatan = pendapatanData.map(data => data.total);

        const ctx = document.getElementById('pendapatanChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan Harian',
                    data: pendapatan,
                    borderColor: '#343a40',
                    backgroundColor: 'rgba(52, 58, 64, 0.1)',
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Pendapatan (Rp)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>