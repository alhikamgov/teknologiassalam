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
                    
                    <?php if (!empty($kontak['alamat'])): ?>
                        <div class="rounded-3 overflow-hidden shadow-sm ratio ratio-21x9" style="border: 1px solid rgba(255,255,255,0.1);">
                            <iframe 
                                src="https://maps.google.com/maps?q=<?= $hero['judul_utama'] ?> <?= urlencode($kontak['alamat']) ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    <?php endif; ?>
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