<?php
// Include database connection
include '../config/koneksi.php';

// Query to get the counts
$queryMasyarakat = "SELECT COUNT(*) as count FROM masyarakat";
$queryPengaduan = "SELECT COUNT(*) as count FROM pengaduan";
$queryTanggapan = "SELECT COUNT(*) as count FROM tanggapan";
$queryPetugas = "SELECT COUNT(*) as count FROM petugas";

$resultMasyarakat = $koneksi->query($queryMasyarakat);
$resultPengaduan = $koneksi->query($queryPengaduan);
$resultTanggapan = $koneksi->query($queryTanggapan);
$resultPetugas = $koneksi->query($queryPetugas);

$countMasyarakat = $resultMasyarakat->fetch_assoc()['count'];
$countPengaduan = $resultPengaduan->fetch_assoc()['count'];
$countTanggapan = $resultTanggapan->fetch_assoc()['count'];
$countPetugas = $resultPetugas->fetch_assoc()['count'];

// Fetch monthly pengaduan data
$monthlyPengaduanQuery = "
    SELECT 
        DATE_FORMAT(tgl_pengaduan, '%Y-%m') AS month,
        COUNT(*) AS count 
    FROM pengaduan 
    GROUP BY month 
    ORDER BY month
";
$monthlyPengaduanResult = $koneksi->query($monthlyPengaduanQuery);

$months = [];
$pengaduanCounts = [];

while ($row = $monthlyPengaduanResult->fetch_assoc()) {
    $months[] = $row['month'];
    $pengaduanCounts[] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #343a40;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }
        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 2rem 0;
            width: 100%;
            margin-top: auto;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 0.5rem;
        }
        .footer a:hover {
            color: #adb5bd;
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
        }
        .card {
            text-align: center;
        }
        .content {
            flex-grow: 1;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="container my-5">
        <h3 class="mt-3 text-center">Dashboard</h3>
        <div class="row mt-3">
            <div class="col-md-3 mt-3">
                <div class="card">
                    <div class="card-header">Masyarakat</div>
                    <div class="card-body"><?php echo $countMasyarakat; ?> Orang</div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card">
                    <div class="card-header">Pengaduan</div>
                    <div class="card-body"><?php echo $countPengaduan; ?> Aduan</div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card">
                    <div class="card-header">Tanggapan</div>
                    <div class="card-body"><?php echo $countTanggapan; ?> Tanggapan</div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card">
                    <div class="card-header">Petugas</div>
                    <div class="card-body"><?php echo $countPetugas; ?> Pengguna</div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        Pengaduan Per Bulan
                    </div>
                    <div class="card-body">
                        <canvas id="pengaduanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pengaduanChart').getContext('2d');
    const pengaduanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: <?php echo json_encode($pengaduanCounts); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
