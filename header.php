<?php
// Hubungkan ke database MySQL
include 'koneksi.php';

// 1. Ambil data Single Row (Object tunggal)
$hero     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hero LIMIT 1")) ?? [];
$sambutan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sambutan LIMIT 1")) ?? [];
$kontak   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kontak LIMIT 1")) ?? [];

// 2. Ambil data Multiple Rows (List/Array)
// Menggunakan fetch_all agar format datanya tetap berupa array of array, 
// sehingga loop foreach asli di HTML bawah tidak perlu diubah menjadi while loop.
$statistik  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM statistik"), MYSQLI_ASSOC);
$jurusan    = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM jurusan"), MYSQLI_ASSOC);
$guru       = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM guru"), MYSQLI_ASSOC);
$fasilitas  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM fasilitas"), MYSQLI_ASSOC);
$ekskul     = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM ekskul"), MYSQLI_ASSOC);
$testimoni  = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM testimoni"), MYSQLI_ASSOC);
$pengumuman = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM pengumuman"), MYSQLI_ASSOC);
$agenda     = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM agenda"), MYSQLI_ASSOC);
$berita     = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM berita"), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --primary-color: #0440b3; --accent-color: #ffc107; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; overflow-x: hidden; }
        .navbar { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .nav-link { font-weight: 500; color: #333; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color); }
        
        /* Mengatur jarak konten dari top agar tidak tertutup oleh navbar fixed-top */
        .content-wrapper { padding-top: 110px; padding-bottom: 80px; }
        
        .section-title { font-weight: 800; margin-bottom: 40px; position: relative; padding-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .section-title::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 5px; background: var(--primary-color); border-radius: 10px; }
        
        .card-custom { border: none; border-radius: 20px; transition: 0.4s; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #fff; }
        .card-custom:hover { transform: translateY(-12px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .card-custom img { transition: transform 0.5s ease;}
        .card-custom:hover img { transform: scale(1.1); }
        .img-guru { height: 350px; object-fit: cover; }
        
        /* Style dropdown */
        .dropdown-menu { border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-radius: 10px; }
        .dropdown-item { font-size: 0.85rem; font-weight: 500; color: #333; transition: 0.3s; }
        .dropdown-item:hover { background-color: rgba(4, 64, 179, 0.05); color: var(--primary-color); }
    </style>
</head>
<body>

    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="index.php">
                <i class="bi bi-mortarboard-fill me-2 fs-4"></i> 
                <span style="letter-spacing: -0.5px; font-size: 1.1rem;"><?= $hero['judul_utama'] ?? '' ?></span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="index.php">Beranda</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-lg-2 small fw-semibold" href="#" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdownProfil">
                            <li><a class="dropdown-item py-2 px-3" href="index.php#profil">Sambutan Kepala Sekolah</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="guru.php">Data Pengajar</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="siswa.php">Data Pelajar</a></li>
                            <li><a class="dropdown-item py-2 px-3" href="ujian.php">Data Ujian</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="index.php#jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="index.php#berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="index.php#informasi">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="index.php#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="index.php#testimoni">Testimoni</a></li>
                    
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link btn btn-danger btn-sm text-white px-3 py-1 rounded-pill d-inline-block w-auto" href="dashboard" style="font-size: 0.85rem;">
                            <i class="bi bi-lock-fill me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>