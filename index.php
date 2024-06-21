<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Lapor PAK</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 2rem 0;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 0.5rem;
        }
        .footer a:hover {
            color: #adb5bd;
        }
        .footer h5 {
            font-weight: bold;
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
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=registrasi">Daftar Akun</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'login':
                if (file_exists('login.php')) {
                    include 'login.php';
                } else {
                    echo "<div class='alert alert-danger'>File login.php tidak ditemukan.</div>";
                }
                break;
            case 'registrasi':
                if (file_exists('registrasi.php')) {
                    include 'registrasi.php';
                } else {
                    echo "<div class='alert alert-danger'>File registrasi.php tidak ditemukan.</div>";
                }
                break;
            default:
                echo "<div class='alert alert-warning'>Halaman tidak tersedia.</div>";
                break;
        }
    } else {
        include 'home.php';
    }
    ?>
</div>

<footer class="footer">
    <div class="container">
        <div class="row me">
            <div class="col text-center">
                <h5>Sistem Informasi 2024 | Lapor PAK</h5>
                <p class="mb-0">Menyediakan platform untuk melaporkan dan menanggapi masalah.</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-center">
                <p class="mb-0">&copy; 2024 Lapor PAK. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
