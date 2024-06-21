<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = ($_POST['password']);
$level = $_POST['level'];

if ($level == 'masyarakat') {
    $login = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE username='$username' AND password='$password'");
} else {
    $login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
}

$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    if ($data['level'] == 'admin') {
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['login'] = "admin";
        header('Location: ../admin/');
    } elseif ($data['level'] == 'petugas') {
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['login'] = "petugas";
        header('Location: ../admin/');
    } elseif ($data['level'] == 'masyarakat') {
        $_SESSION['nik'] = $data['nik'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['login'] = "masyarakat";
        header('Location: ../masyarakat/');
    } else {
        echo "<script>
        alert('Level pengguna tidak valid');
        window.location='../index.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Username atau Password tidak terdaftar');
    window.location='../index.php';
    </script>";
}
?>
