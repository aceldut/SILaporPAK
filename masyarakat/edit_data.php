<?php
include '../config/koneksi.php';
session_start();

if (isset($_POST['hapus_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];

    // Retrieve the specific record to delete
    $query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    $data = mysqli_fetch_array($query);

    if ($data) {
        // Check if the file exists and delete it
        if (is_file("../assets/img/" . $data['foto'])) {
            unlink("../assets/img/" . $data['foto']);
        }

        // Delete the record from the database
        $deleteQuery = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");

        if ($deleteQuery) {
            echo "<script>
                    alert('Data berhasil dihapus!');
                    window.location ='index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data gagal dihapus. Silakan coba lagi.');
                    window.location ='index.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Data tidak ditemukan.');
                window.location ='index.php';
              </script>";
    }
}
?>
