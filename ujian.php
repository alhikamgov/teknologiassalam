<?php
// PANGGIL HEADER
include 'header.php';

// Proteksi jika query $ujian belum dideklarasikan di index/header
if (!isset($ujian)) {
    // Jalankan query fallback jika file ini diakses langsung tanpa lewat wrapper index
    include_once "koneksi.php";
    $ujian = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM ujian ORDER BY id ASC"), MYSQLI_ASSOC);
}
?>
    <title>Jadwal Ujian - <?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></title>

    <main class="container content-wrapper" style="margin-top: 120px; margin-bottom: 60px;">
        <div class="text-center mb-5">
            <h2 class="section-title">Jadwal Ujian Siswa</h2>
            <p class="text-secondary">Informasi pelaksanaan ujian resmi dan tertib di <?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-custom p-4 shadow-sm border border-light bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-primary">
                                <tr>
                                    <th scope="col" class="py-3 px-4" style="width: 25%;">Hari & Tanggal</th>
                                    <th scope="col" class="py-3">Mata Pelajaran</th>
                                    <th scope="col" class="py-3" style="width: 20%;">Waktu / Jam</th>
                                    <th scope="col" class="py-3" style="width: 20%;">Ruang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($ujian)): ?>
                                    <?php foreach($ujian as $u): ?>
                                    <tr>
                                        <td class="py-3 px-4">
                                            <span class="badge bg-primary px-3 py-2 rounded-pill fw-bold text-white d-inline-block mb-1">
                                                <?= htmlspecialchars($u['hari'] ?? '') ?>
                                            </span>
                                            <div class="small text-muted fw-semibold ps-1">
                                                <?= htmlspecialchars($u['tanggal'] ?? '') ?>
                                            </div>
                                        </td>
                                        <td class="py-3 fw-bold text-dark fs-6">
                                            <?= htmlspecialchars($u['mapel'] ?? '') ?>
                                        </td>
                                        <td class="py-3 text-secondary small fw-medium">
                                            <i class="bi bi-clock-fill text-warning me-2"></i><?= htmlspecialchars($u['waktu'] ?? '07:30 - 09:30') ?> WIB
                                        </td>
                                        <td class="py-3">
                                            <span class="badge bg-light text-dark border px-2 py-1.5 fw-medium">
                                                <i class="bi bi-door-closed-fill text-secondary me-1"></i><?= htmlspecialchars($u['ruang'] ?? 'Ruang Lab') ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center my-5 py-5">
                                            <div class="py-4">
                                                <i class="bi bi-calendar-x text-muted display-4"></i>
                                                <p class="text-muted mt-3 mb-0">Belum ada jadwal ujian yang dirilis saat ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
// PANGGIL FOOTER
include 'footer.php'; 
?>