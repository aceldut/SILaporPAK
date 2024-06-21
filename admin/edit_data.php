<?php
include '../config/koneksi.php';
session_start();

if (isset($_POST['hapus_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    $data = mysqli_fetch_array($query);
    if (is_file("../assets/" . $data['foto'])) {
        unlink("../assets/" . $data['foto']);
    }

    // Hapus data tanggapan terkait
    $deleteTanggapan = mysqli_query($koneksi, "DELETE FROM tanggapan WHERE id_pengaduan='$id_pengaduan'");
    if (!$deleteTanggapan) {
        echo "Gagal menghapus tanggapan terkait. Error: " . mysqli_error($koneksi);
        exit;
    }

    // Hapus pengaduan
    $delete = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    if ($delete) {
        header('location:index.php');
    } else {
        echo "Gagal menghapus pengaduan. Error: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['hapus_tanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    $query = mysqli_query($koneksi, "DELETE FROM tanggapan WHERE id_tanggapan='$id_tanggapan'");
    if ($query) {
        echo "<script>
        alert('Data berhasil dihapus!');
        window.location ='index.php?page=tanggapan';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menghapus data!');
        window.location ='index.php?page=tanggapan';
        </script>";
    }
}

if (isset($_POST['hapus_masyarakat'])) {
 // Periksa apakah user adalah admin
        $nik = $_POST['nik'];
        echo "NIK: " . $nik; // Debugging
        $delete = mysqli_query($koneksi, "DELETE FROM masyarakat WHERE nik='$nik'");
        if ($delete) {
            echo "<script>
            alert('Data berhasil dihapus!');
            window.location ='index.php?page=masyarakat';
            </script>";
        } else {
            $error = mysqli_error($koneksi);
            echo "Gagal menghapus masyarakat. Error: " . $error;
        }
    }
?>
