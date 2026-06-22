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
    <title><?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --primary-color: #0440b3; --accent-color: #ffc107; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; scroll-behavior: smooth; overflow-x: hidden; }
        .navbar { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); transition: 0.4s; }
        .nav-link { font-weight: 500; color: #333; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color); }
        .hero-carousel img { height: 100vh; object-fit: cover; filter: brightness(0.4); }
        .hero-caption { position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%); color: white; width: 85%; z-index: 10; }
        .section-padding { padding: 100px 0; }
        .section-title { font-weight: 800; margin-bottom: 60px; position: relative; padding-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .section-title::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 5px; background: var(--primary-color); border-radius: 10px; }
        .card-custom { border: none; border-radius: 20px; transition: 0.4s; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #fff; }
        .card-custom:hover { transform: translateY(-12px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
        .card-custom img { transition: transform 0.5s ease;}
        .card-custom:hover img { transform: scale(1.1); }
        .img-guru { height: 350px; object-fit: cover; }
        .img-fasilitas { height: 250px; object-fit: cover; }
        .img-berita { height: 200px; object-fit: cover; }
        .bg-gradient-blue { background: linear-gradient(135deg, #0440b3 0%, #032a75 100%); color: white; }
        .stat-box { transition: 0.3s; border: 1px solid #eee; background: #fff; }
        .stat-box h3 { color: var(--primary-color); transition: 0.3s; }
        .stat-box small { color: #6c757d; transition: 0.3s; }
        .stat-box:hover { background-color: var(--primary-color) !important; border-color: var(--primary-color); transform: translateY(-5px); }
        .stat-box:hover h3, .stat-box:hover small, .stat-box:hover i, .stat-box:hover span { color: #ffffff !important; }
        .carousel-control-prev, .carousel-control-next { width: 5%; filter: invert(1); }
        .testi-card { transition: 0.3s; border-radius: 25px; background: #ffffff; border: none; height: 100%; min-height: 250px; display: flex; flex-direction: column; justify-content: space-between;}
        .testi-card:hover { transform: translateY(-5px); }
        .quote-icon { font-size: 3rem; color: var(--primary-color); opacity: 0.1; position: absolute; top: 20px; right: 30px; }
        .img-jurusan { height: 200px; object-fit: cover; width: 100%; }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#mainNav">

    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="#">
                <i class="bi bi-mortarboard-fill me-2 fs-4"></i> 
                <span style="letter-spacing: -0.5px; font-size: 1.1rem;"><?= $hero['judul_utama'] ?? '' ?></span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#jurusan">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#informasi">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#guru">Guru</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-2 small fw-semibold" href="#testimoni">Testimoni</a></li>
                    
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link btn btn-danger btn-sm text-white px-3 py-1 rounded-pill d-inline-block w-auto" href="dashboard" style="font-size: 0.85rem;">
                            <i class="bi bi-lock-fill me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero" class="carousel slide hero-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active"><img src="<?= $hero['img_slider_1'] ?? '' ?>" class="d-block w-100"></div>
            <div class="carousel-item"><img src="<?= $hero['img_slider_2'] ?? '' ?>" class="d-block w-100"></div>
        </div>
        <div class="hero-caption text-center">
            <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown"><?= $hero['judul_utama'] ?? '' ?></h1>
            <p class="lead mb-5 opacity-75 animate__animated animate__fadeInUp"><?= $hero['subtitle'] ?? '' ?></p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#profil" class="btn btn-primary btn-lg px-5 rounded-pill shadow-lg">Profil Sekolah</a>
                <a href="https://wa.me/<?= $kontak['wa'] ?? '' ?>" class="btn btn-outline-light btn-lg px-5 rounded-pill">Hubungi Kami</a>
            </div>
        </div>
    </section>

    <section id="profil" class="section-padding">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="position-relative">
                        <img src="<?= $sambutan['foto'] ?? '' ?>" class="img-fluid rounded-4 shadow-lg border border-5 border-white">
                    </div>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary fw-bold text-uppercase mb-2">Sambutan Kepala Sekolah</h6>
                    <h2 class="fw-bold mb-4"><?= $sambutan['nama'] ?? '' ?></h2>
                    <p class="text-secondary fs-5 lh-lg mb-4" style="font-style: italic;">"<?= $sambutan['pesan'] ?? '' ?>"</p>
                    
                    <div class="row g-3 mt-2">
                        <?php foreach($statistik as $s): ?>
                        <div class="col-6 col-md-3">
                            <div class="stat-box p-3 text-center rounded-4 bg-white">
                                <h3 class="fw-bold text-primary mb-0"><?= $s['angka'] ?></h3>
                                <small class="text-muted text-uppercase fw-bold" style="font-size: 10px;"><?= $s['label'] ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="jurusan" class="section-padding bg-light">
    <div class="container text-center">
        <h2 class="section-title">Program Keahlian</h2>
        <div class="row g-4">
            <?php foreach($jurusan as $j): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card card-custom h-100">
                    <img src="<?= $j['foto'] ?>" class="card-img-top img-jurusan" alt="<?= $j['nama'] ?>" onerror="this.src='https://placehold.co/600x800?text=Jurusan'">
                    <div class="card-body bg-white p-4">
                        <h5 class="fw-bold mb-1"><?= $j['nama'] ?></h5>
                        <p class="text-primary small mb-0 fw-medium"><?= $j['deskripsi'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    </section>

    <section id="berita" class="section-padding">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Berita & Kegiatan</h2>
            </div>
            <div class="row g-4 mt-2">
                <?php foreach($berita as $b): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-custom h-100">
                        <img src="<?= $b['gambar'] ?>" class="card-img-top img-berita" alt="Berita" onerror="this.src='https://placehold.co/600x800?text=Berita'">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark"><?= $b['judul'] ?></h5>
                            <p class="text-muted small"><?= $b['ringkasan'] ?></p>
                            <a href="#" class="btn btn-link text-primary p-0 fw-bold text-decoration-none">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="informasi" class="section-padding bg-white border-bottom">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <h3 class="fw-bold mb-4"><i class="bi bi-megaphone-fill text-danger me-2"></i> Pengumuman Terbaru</h3>
                    <div class="list-group list-group-flush border rounded-4 overflow-hidden shadow-sm">
                        <?php foreach($pengumuman as $p): ?>
                        <div class="list-group-item p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0 text-primary"><?= $p['judul'] ?></h5>
                                <span class="badge bg-light text-dark border"><?= $p['tanggal'] ?></span>
                            </div>
                            <p class="text-muted mb-0 small"><?= $p['isi'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-5">
                    <h3 class="fw-bold mb-4"><i class="bi bi-calendar-event-fill text-primary me-2"></i> Agenda Sekolah</h3>
                    <?php foreach($agenda as $a): ?>
                    <div class="d-flex align-items-center mb-3 p-3 border rounded-4 bg-light shadow-sm">
                        <div class="bg-primary text-white p-3 rounded-4 text-center me-3" style="min-width: 80px;">
                            <i class="bi bi-calendar3 fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1"><?= $a['kegiatan'] ?></h6>
                            <small class="text-muted d-block"><i class="bi bi-clock me-1"></i> <?= $a['waktu'] ?></small>
                            <small class="text-muted d-block"><i class="bi bi-geo-alt me-1"></i> <?= $a['tempat'] ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="guru" class="section-padding bg-light">
        <div class="container text-center">
            <h2 class="section-title">Tenaga Pendidik</h2>
            <div class="row g-4">
                <?php foreach($guru as $g): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-custom h-100">
                        <img src="<?= $g['foto'] ?>" class="card-img-top img-guru" onerror="this.src='https://placehold.co/600x800?text=Guru'">
                        <div class="card-body bg-white p-4">
                            <h5 class="fw-bold mb-1"><?= $g['nama'] ?></h5>
                            <p class="text-primary small mb-0 fw-medium"><?= $g['deskripsi'] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="section-padding">
        <div class="container text-center">
            <h2 class="section-title">Fasilitas & Lingkungan</h2>
            <div class="row g-4">
                <?php foreach($fasilitas as $f): ?>
                <div class="col-md-6">
                    <div class="card card-custom h-100 shadow-sm border">
                        <img src="<?= $f['img'] ?>" class="card-img-top img-fasilitas" onerror="this.src='https://placehold.co/600x800?text=Fasilitas'">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-0"><?= $f['nama'] ?></h6>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-5 pt-5">
                <h4 class="fw-bold mb-4">Ekstrakurikuler</h4>
                <div class="row g-3 justify-content-center">
                    <?php foreach($ekskul as $e): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card card-custom h-100 shadow-sm border-0 bg-white d-flex flex-column align-items-center p-3">
                            <div class="mb-3 overflow-hidden rounded-4" style="width: 100%; height: 150px;">
                                <img src="<?= $e['gambar'] ?>" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;" 
                                     alt="<?= $e['nama'] ?>"
                                     onerror="this.src='https://placehold.co/400x300?text=Ekskul'">
                            </div>
                            <span class="fw-bold text-dark"><?= $e['nama'] ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="section-padding bg-gradient-blue">
        <div class="container text-center text-white">
            <h2 class="section-title text-white">Apa Kata Alumni?</h2>
            
            <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    $chunks = array_chunk($testimoni, 2); 
                    foreach($chunks as $index => $pair): 
                    ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row g-4 justify-content-center px-5">
                            <?php foreach($pair as $t): ?>
                            <div class="col-md-6">
                                <div class="testi-card p-4 p-md-5 rounded-5 shadow-lg text-dark position-relative bg-white text-start">
                                    <i class="bi bi-quote fs-1 text-primary position-absolute top-0 end-0 m-4 opacity-25"></i>
                                    <p class="fs-5 italic text-muted mb-4">"<?= htmlspecialchars($t['pesan']) ?>"</p>
                                    
                                    <div class="d-flex align-items-center mt-auto border-top pt-3">
                                        <img src="<?= $t['foto'] ?>" class="rounded-circle me-3 border border-3 border-primary" width="60" height="60" style="object-fit: cover;" onerror="this.src='https://placehold.co/100x100?text=Alumni'">
                                        <div>
                                            <h6 class="fw-bold mb-0"><?= htmlspecialchars($t['nama']) ?></h6>
                                            <small class="text-primary fw-bold">Alumni Angkatan <?= htmlspecialchars($t['lulusan']) ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if(count($testimoni) > 2): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimoni" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimoni" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <?php endif; ?>

                <div class="carousel-indicators position-relative mt-4">
                    <?php foreach($chunks as $index => $pair): ?>
                    <button type="button" data-bs-target="#carouselTestimoni" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="true"></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h4 class="fw-bold text-primary mb-4">SMK Teknologi Assalam</h4>
                    <p class="opacity-75 pe-lg-5 mb-4"><?= $kontak['tentang'] ?? '' ?></p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="https://www.instagram.com/<?= $kontak['ig'] ?? '' ?>" class="btn btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
                        <a href="https://fb.me/<?= $kontak['fb'] ?? '' ?>" class="btn btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="https://wa.me/<?= $kontak['wa'] ?? '' ?>" class="btn btn-outline-light rounded-circle"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-4">Navigasi Cepat</h5>
                    <ul class="list-unstyled opacity-75">
                        <li class="mb-2"><a href="#hero" class="text-white text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="#profil" class="text-white text-decoration-none">Profil Sekolah</a></li>
                        <li class="mb-2"><a href="#jurusan" class="text-white text-decoration-none">Program Keahlian</a></li>
                        <li class="mb-2"><a href="#guru" class="text-white text-decoration-none">Tenaga Pendidik</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-4">Hubungi Kami</h5>
                    <p class="small opacity-75 mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> <?= $kontak['alamat'] ?? '' ?></p>
                    <p class="small opacity-75 mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> <?= $kontak['telp'] ?? '' ?></p>
                    <p class="small opacity-75 mb-4"><i class="bi bi-envelope-fill text-primary me-2"></i> <?= $kontak['email'] ?? '' ?></p>
                </div>
            </div>
            <hr class="mt-5 mb-4 opacity-25">
            <div class="text-center opacity-50 small">
                <p>&copy; 2026 SMK Teknologi Assalam Bekasi. All Rights Reserved. </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>