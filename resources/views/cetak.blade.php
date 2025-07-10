<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #343a40 !important;
        }
        .table-dark {
            background-color: #343a40 !important;
            color: white !important;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 1.75rem;
            color: #343a40;
        }
        .header p {
            font-size: 1rem;
            color: #6c757d;
        }
        @media print {
            a {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container my-4">
        <div class="header">
            <h1>Laporan Transaksi</h1>
            <p>Tanggal: {{ now()->format('d M Y') }}</p>
        </div>

        <div class="card">
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

</body>
</html>
