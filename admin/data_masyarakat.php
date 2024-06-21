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
                    DATA MASYARAKAT
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>USERNAME</th>
                                <th>TELFON</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../config/koneksi.php';
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM masyarakat");
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nik'] ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['username'] ?></td>
                                    <td><?php echo $data['telp'] ?></td>
                                    
                                    <td>
                                        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['nik'] ?>">HAPUS</a>
                                        <div class="modal fade" id="hapus<?php echo $data['nik'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="edit_data.php" method="POST">
                                                            <input type="hidden" name="nik" class="form-control" value="<?php echo $data['nik'] ?>">
                                                            <p>Apakah yakin akan menghapus data <br> <?php echo $data['nama'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus_masyarakat" class="btn btn-danger">Hapus</button>
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
