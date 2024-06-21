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

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    DATA TANGGAPAN
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="export_tanggapan.php" class="btn btn-success" target="_blank">Export Excel</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TANGGAL</th>
                                <th>NIK</th>
                                <th>JUDUL</th>
                                <th>TANGGAPAN</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../config/koneksi.php';
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT a.*, b.* FROM tanggapan a INNER JOIN pengaduan b ON a.id_pengaduan=b.id_pengaduan ORDER BY b.tgl_pengaduan DESC");

                            if (!$query) {
                                echo "<tr><td colspan='7' class='text-center'>Error: " . mysqli_error($koneksi) . "</td></tr>";
                                exit;
                            }

                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['tgl_pengaduan'] ?></td>
                                    <td><?php echo $data['nik'] ?></td>
                                    <td><?php echo $data['judul_laporan'] ?></td>
                                    <td><?php echo $data['tanggapan'] ?></td>
                                    <td>
                                        <?php
                                        if ($data['status'] == 'proses') {
                                            echo "<span class='badge bg-warning'>Proses</span>";
                                        } elseif ($data['status'] == 'selesai') {
                                            echo "<span class='badge bg-success'>Selesai</span>";
                                        } else {
                                            echo "<span class='badge bg-danger'>Menunggu</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_tanggapan'] ?>">Hapus</button>
                                        <div class="modal fade" id="hapus<?php echo $data['id_tanggapan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="edit_data.php" method="POST">
                                                            <input type="hidden" name="id_tanggapan" class="form-control" value="<?php echo $data['id_tanggapan'] ?>">
                                                            <p>Apakah yakin akan menghapus tanggapan <br> <?php echo $data['judul_laporan'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus_tanggapan" class="btn btn-danger">Hapus</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
