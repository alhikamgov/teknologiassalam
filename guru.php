<?php
// PANGGIL HEADER
include 'header.php';
?>
    <title>Tenaga Pendidik & Guru - <?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></title>

    <main class="container content-wrapper">
        <div class="text-center mb-5">
            <h2 class="section-title">Tenaga Pendidik / Guru</h2>
            <p class="text-secondary">Daftar guru resmi pendidik generasi bangsa di <?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></p>
        </div>

        <div class="row g-4">
            <?php if (!empty($guru)): ?>
                <?php foreach($guru as $g): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-custom h-100">
                        <img src="<?= $g['foto'] ?>" class="card-img-top img-guru" alt="<?= $g['nama'] ?>" onerror="this.src='https://placehold.co/600x800?text=Guru'">
                        <div class="card-body bg-white p-4 text-center">
                            <h5 class="fw-bold mb-1"><?= $g['nama'] ?></h5>
                            <p class="text-primary small mb-0 fw-medium"><?= $g['deskripsi'] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center my-5">
                    <i class="bi bi-people text-muted display-4"></i>
                    <p class="text-muted mt-3">Belum ada data guru yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

<?php 
// PANGGIL FOOTER
include 'footer.php'; 
?>