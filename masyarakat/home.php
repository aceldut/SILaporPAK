<?php

if (!isset($_SESSION['login']) || $_SESSION['login'] != 'masyarakat') {
    header('Location: ../index.php');
    exit();
}

$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Guest';
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <p class="welcome-message">Selamat Datang <?php echo $_SESSION['nama'] ?></p>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    FORM PENGADUAN
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Judul Laporan</label>
                            <input type="text" class="form-control" name="judul_laporan" placeholder="Masukkan Judul" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Laporan</label>
                            <textarea class="form-control" name="isi_laporan" placeholder="Masukkan Isi Laporan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" required>
                        </div>
                        <button type="submit" name="kirim" class="btn btn-primary w-100">KIRIM</button>
                    </form>
                    <?php
                    include '../config/koneksi.php';
                    $tanggal = date("Y-m-d");
                    if (isset($_POST['kirim'])) {
                        $nik = $_SESSION['nik'];
                        $judul_laporan = $_POST['judul_laporan'];
                        $isi_laporan = $_POST['isi_laporan'];
                        $status = 0;
                        $foto = $_FILES['foto']['name'];
                        $tmp = $_FILES['foto']['tmp_name'];
                        $lokasi = '../assets/img/';
                        $nama_foto = rand(0, 999) . '-' . $foto;

                        move_uploaded_file($tmp, $lokasi . $nama_foto);
                        $query = mysqli_query($koneksi, "INSERT INTO pengaduan VALUES ('','$tanggal', '$nik', '$judul_laporan', '$isi_laporan', '$nama_foto', '$status')");

                        echo "<script>
                        alert('Data berhasil dikirim!');
                        window.location ='index.php';
                        </script>";
                    }
                    ?>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    RIWAYAT PENGADUAN
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>JUDUL</th>
                                <th>ISI</th>
                                <th>FOTO</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $nik = $_SESSION['nik'];
                            $query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE nik='$nik' ORDER BY id_pengaduan DESC");
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['judul_laporan'] ?></td>
                                    <td><?php echo $data['isi_laporan'] ?></td>
                                    <td><img src="../assets/img/<?php echo $data['foto'] ?>" width="100" class="img-thumbnail"></td>
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
                                        <?php if ($data['status'] != 'proses' && $data['status'] != 'selesai') { ?>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $data['id_pengaduan'] ?>">
                                            Hapus
                                        </button>
                                        <?php } ?>

                                        <div class="modal fade" id="hapusModal<?php echo $data['id_pengaduan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="edit_data.php" method="POST">
                                                        <input type="hidden" name="id_pengaduan" value="<?php echo $data['id_pengaduan'] ?>">
                                                        <div class="modal-body">
                                                            Apakah anda yakin akan menghapus data <br> <?php echo $data['judul_laporan'] ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger" name="hapus_pengaduan">Hapus</button>
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

<!-- Add Bootstrap CSS and JS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
