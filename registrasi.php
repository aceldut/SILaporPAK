<?php
include 'config/koneksi.php';

if (isset($_POST['kirim'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = ($_POST['password']); // It's a good practice to hash passwords
    $telp = $_POST['telp'];
    $level = 'masyarakat';

    // Check if NIK already exists
    $check_nik_query = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nik'");
    if (mysqli_num_rows($check_nik_query) > 0) {
        echo "<script>
                alert('NIK sudah terdaftar. Gunakan NIK lain.');
                window.location ='index.php?page=registrasi';
              </script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO masyarakat VALUES ('$nik','$nama','$username','$password','$telp','$level')");

        if ($query) {
            header('Location: index.php?page=login');
            exit(); // Ensure the script stops execution after the header redirection
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>REGISTRASI</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="number" class="form-control" name="nik" placeholder="Masukkan NIK" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telp</label>
                            <input type="number" class="form-control" name="telp" placeholder="Masukkan No. Telp" required>
                        </div>
                        <button type="submit" name="kirim" class="btn btn-primary w-100">DAFTAR</button>
                    </form>
                    <a href="index.php?page=login" class="d-block text-center mt-3 text-primary">Sudah punya akun? Login disini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: #f8f9fa;
        font-family: 'Roboto', sans-serif;
    }
    .card {
        border: none;
        border-radius: 10px;
    }
    .card-header {
        border-radius: 10px 10px 0 0;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
