<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="index.php">
        <div class="sidebar-brand-icon"><i class="fas fa-university"></i></div>
        <div class="sidebar-brand-text mx-3">ADMIN</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?= $curr == 'hero' ? 'active' : '' ?>"><a class="nav-link" href="?s=hero"><i class="fas fa-home"></i> <span>Beranda Hero</span></a></li>
    
    <hr class="sidebar-divider"><div class="sidebar-heading">Menu Utama</div>

    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePresensi"
        aria-expanded="true" aria-controls="collapsePresensi">
        <i class="fas fa-fingerprint"></i>
        <span>Presensi</span>
    </a>
    <div id="collapsePresensi" class="collapse <?= in_array($curr, ['data-pegawai', 'presensi-lobby', 'hasil-presensi']) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $curr == 'data-pegawai' ? 'active' : '' ?>" href="?s=data-pegawai">Data Pegawai</a>
            <a class="collapse-item <?= $curr == 'presensi-lobby' ? 'active' : '' ?>" href="?s=presensi-lobby">Presensi</a>
            <a class="collapse-item <?= $curr == 'hasil-presensi' ? 'active' : '' ?>" href="?s=hasil-presensi">Hasil Presensi</a>
        </div>
    </div>
</li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfil"><i class="fas fa-school"></i> <span>Profil Sekolah</span></a>
        <div id="collapseProfil" class="collapse <?= in_array($curr, ['sambutan', 'statistik', 'kontak']) ? 'show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $curr == 'sambutan' ? 'active' : '' ?>" href="?s=sambutan">Sambutan</a>
                <a class="collapse-item <?= $curr == 'statistik' ? 'active' : '' ?>" href="?s=statistik">Statistik</a>
                <a class="collapse-item <?= $curr == 'kontak' ? 'active' : '' ?>" href="?s=kontak">Kontak</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkademik"><i class="fas fa-graduation-cap"></i> <span>Akademik</span></a>
        <div id="collapseAkademik" class="collapse <?= in_array($curr, ['jurusan', 'guru', 'fasilitas', 'ekskul']) ? 'show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $curr == 'jurusan' ? 'active' : '' ?>" href="?s=jurusan">Jurusan</a>
                <a class="collapse-item <?= $curr == 'guru' ? 'active' : '' ?>" href="?s=guru">Guru</a>
                <a class="collapse-item <?= $curr == 'fasilitas' ? 'active' : '' ?>" href="?s=fasilitas">Fasilitas</a>
                <a class="collapse-item <?= $curr == 'ekskul' ? 'active' : '' ?>" href="?s=ekskul">Ekskul</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfo"><i class="fas fa-bullhorn"></i> <span>Informasi</span></a>
        <div id="collapseInfo" class="collapse <?= in_array($curr, ['berita', 'pengumuman', 'agenda', 'testimoni', 'galeri']) ? 'show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $curr == 'berita' ? 'active' : '' ?>" href="?s=berita">Berita</a>
                <a class="collapse-item <?= $curr == 'pengumuman' ? 'active' : '' ?>" href="?s=pengumuman">Pengumuman</a>
                <a class="collapse-item <?= $curr == 'agenda' ? 'active' : '' ?>" href="?s=agenda">Agenda</a>
                <a class="collapse-item <?= $curr == 'testimoni' ? 'active' : '' ?>" href="?s=testimoni">Testimoni</a>
                <a class="collapse-item <?= $curr == 'galeri' ? 'active' : '' ?>" href="?s=galeri">Galeri Foto</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item <?= $curr == 'settings' ? 'active' : '' ?>"><a class="nav-link" href="?s=settings"><i class="fas fa-key"></i> <span>Ubah Password</span></a></li>
    <li class="nav-item"><a class="nav-link text-danger font-weight-bold" href="?logout=1" onclick="return confirm('Logout?')"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>
    <div class="text-center d-none d-md-inline mt-4"><button class="rounded-circle border-0" id="sidebarToggle"></button></div>
</ul>