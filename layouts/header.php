<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Lapor PAK</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    .navbar {
      background-color: #343a40;
      padding: 1rem;
    }
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
      color: #fff;
    }
    .navbar-nav .nav-link {
      color: #fff;
      margin-left: 1rem;
      transition: color 0.3s ease;
    }
    .navbar-nav .nav-link:hover {
      color: #ffd700;
    }
    .navbar-toggler {
      border-color: rgba(255, 255, 255, 0.1);
    }
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Sistem Informasi Lapor PAK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <?php
          if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }
          if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') { ?>
            <li class="nav-item"><a class="nav-link" href="index.php?page=tanggapan">Data Tanggapan</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=pengaduan">Data Pengaduan</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=masyarakat">Data Masyarakat</a></li>
            <li class="nav-item"><a class="nav-link" href="../config/aksi_logout.php">Logout</a></li>
          <?php } elseif (isset($_SESSION['login']) && $_SESSION['login'] == 'petugas') { ?>
            <li class="nav-item"><a class="nav-link" href="index.php?page=pengaduan">Data Pengaduan</a></li>
            <li class="nav-item"><a class="nav-link" href="../config/aksi_logout.php">Logout</a></li>
          <?php } elseif (isset($_SESSION['login']) && $_SESSION['login'] == 'masyarakat') { ?>
            <li class="nav-item"><a class="nav-link" href="../config/aksi_logout.php">Logout</a></li>
          <?php } else { ?>
            <li class="nav-item"><a class="nav-link" href="index.php?page=registrasi">Daftar Akun</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=login">Login</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
