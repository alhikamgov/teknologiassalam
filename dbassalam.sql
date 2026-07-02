-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2026 pada 16.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbassalam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `tempat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `kegiatan`, `waktu`, `tempat`) VALUES
(1, 'Buka Puasa Bersama & Santunan', '08 April 2026', 'Masjid Al-Barkah Assalam'),
(2, 'Ujian Kompetensi Keahlian (UKK)', '15 Mei 2026', 'Lab TKJ & Bengkel TKR'),
(3, 'Job Fair & Career Day', '25 Juni 2026', 'Aula Gedung Utama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `ringkasan` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `ringkasan`, `gambar`) VALUES
(2, 'Kerjasama Baru dengan PT. Astra', 'Penandatanganan MoU untuk penyaluran lulusan jurusan Teknik Kendaraan Ringan.', 'galeri/1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekskul`
--

CREATE TABLE `ekskul` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ekskul`
--

INSERT INTO `ekskul` (`id`, `nama`, `gambar`) VALUES
(1, 'Futsal & Sepakbola', 'https://sportaways.com/storage/products/2025/09/munich-x-team-f4-6677074-fyellowr-blue-4-1-b9mw0qzs.webp'),
(2, 'Pramuka Inti', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRs3Y2pHQo1LsGmASp-83S96-NUSPRo0d8qxw&s'),
(3, 'Robotik & Coding', 'galeri/ekskul_1783001420_gambar.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`, `img`) VALUES
(1, 'Gedung Milik Sendiri', 'galeri/fasilitas_1783001308_img.jpg'),
(2, 'Lab Komputer & Fiber Optic', 'galeri/labkomputer.png'),
(3, 'Workshop Otomotif Standar Industri', 'galeri/workshop.jpg'),
(4, 'Perpustakaan Digital', 'galeri/fasilitas_1783001403_img.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nama`, `foto`, `deskripsi`) VALUES
(1, 'Siti Aminah, S. T', 'galeri/guru6.png', 'Ketua Program Keahlian TKJ dengan spesialisasi Network Engineering dan Cloud Computing.'),
(2, 'Budi Raharjo, M.Ak', 'galeri/guru3.png', 'Tenaga pendidik Akuntansi dengan pengalaman 10 tahun di bidang audit dan laporan keuangan.'),
(3, 'Irwan Kurniawan, S.T.', 'galeri/guru1.png', 'Guru Produktif TKR yang ahli dalam sistem Engine Management dan Kelistrikan Otomotif.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero`
--

CREATE TABLE `hero` (
  `id` int(11) NOT NULL,
  `judul_utama` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `img_slider_1` varchar(255) NOT NULL,
  `img_slider_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hero`
--

INSERT INTO `hero` (`id`, `judul_utama`, `subtitle`, `img_slider_1`, `img_slider_2`) VALUES
(1, 'SMK Teknologi Assalam Cikarang', 'Mencetak Generasi Berkarakter, Unggul dalam Teknologi, dan Siap Kerja.', 'galeri/hero_1783001142_img_slider_1.jpeg', 'galeri/smksrc.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `foto`, `deskripsi`) VALUES
(1, 'Teknik Kendaraan Ringan (TKR)', 'galeri/jurusan_1783001497_foto.png', 'Fokus pada pemeliharaan dan perbaikan kendaraan bermotor roda empat sesuai standar industri otomotif.'),
(2, 'Teknik Komputer Jaringan (TKJ)', 'galeri/jurusan_1783001531_foto.png', 'Mempelajari perakitan komputer, instalasi jaringan LAN/WAN, server, dan keamanan siber.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wa` varchar(50) NOT NULL,
  `ig` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `tentang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `alamat`, `telp`, `email`, `wa`, `ig`, `fb`, `tentang`) VALUES
(1, 'Jl. Industri Bumi Asih No.32/102, Bekasi, Jawa Barat', '021-89123456\r\n', 'info@smkassalambekasi.sch.id', '628123456789', 'smkassalambekasi', 'smk.assalam.bekasi', 'SMK Teknologi Assalam Bekasi adalah lembaga pendidikan vokasi unggulan di pusat industri Bekasi yang berfokus pada integrasi teknologi dan karakter religius.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `pin_finger` varchar(20) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(155) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jabatan` enum('Guru','Staf TU','Karyawan') NOT NULL DEFAULT 'Guru',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `pin_finger`, `nip`, `nama`, `jk`, `no_hp`, `alamat`, `jabatan`, `keterangan`, `created_at`) VALUES
(3, '1337', '31212132134134', 'Al Hikam', 'Laki-laki', '085117427423', 'Griya Bagasasi', 'Karyawan', NULL, '2026-06-22 10:39:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Penerimaan Siswa Baru 2026/2027', 'Pendaftaran Gelombang 1 telah dibuka! Dapatkan beasiswa prestasi bagi pendaftar sebelum 30 Mei 2026.', '07 APRIL 2026'),
(2, 'Info Kelulusan Kelas XII', 'Rapat pleno kelulusan akan dilaksanakan pada bulan Mei secara daring melalui website resmi sekolah.', '01 APRIL 2026');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `pin_finger` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `status` enum('Hadir','Alpa','Izin') DEFAULT 'Hadir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sambutan`
--

CREATE TABLE `sambutan` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sambutan`
--

INSERT INTO `sambutan` (`id`, `nama`, `foto`, `pesan`) VALUES
(1, 'zarkasyi', 'galeri/kepsek.png', 'Kami berkomitmen memberikan pendidikan teknik terbaik dengan kurikulum yang selaras dengan kebutuhan industri saat ini untuk menghasilkan lulusan yang kompeten dan religius.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jk`, `kelas`, `jurusan`) VALUES
(1, '232401001', 'Ahmad Faozi', 'Laki-laki', 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
(2, '232401002', 'Siti Aminah', 'Perempuan', 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
(3, '232402001', 'Rian Hidayat', 'Laki-laki', 'XI TKJ 2', 'Teknik Komputer & Jaringan'),
(4, '232402002', 'Putri Utami', 'Perempuan', 'X TKJ 1', 'Teknik Komputer & Jaringan'),
(5, '232401003', 'Budi Santoso', 'Laki-laki', 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
(6, '232401004', 'Dewi Lestari', 'Perempuan', 'XI RPL 2', 'Rekayasa Perangkat Lunak'),
(7, '232402003', 'Eko Prasetyo', 'Laki-laki', 'X TKJ 2', 'Teknik Komputer & Jaringan'),
(8, '232402004', 'Farida Utami', 'Perempuan', 'XI TKJ 1', 'Teknik Komputer & Jaringan'),
(9, '232401005', 'Gilang Ramadhan', 'Laki-laki', 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
(10, '232401006', 'Hany Fitriani', 'Perempuan', 'X RPL 1', 'Rekayasa Perangkat Lunak'),
(11, '232402005', 'Irfan Hakim', 'Laki-laki', 'XI TKJ 2', 'Teknik Komputer & Jaringan'),
(12, '232402006', 'Julia Perez', 'Perempuan', 'XII TKJ 1', 'Teknik Komputer & Jaringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `statistik`
--

CREATE TABLE `statistik` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `angka` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `statistik`
--

INSERT INTO `statistik` (`id`, `label`, `angka`) VALUES
(1, 'Siswa Aktif', '5000'),
(2, 'Guru & Staff', '35'),
(3, 'Mitra Industri', '25'),
(4, 'Lulusan Terserap', '5000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `pesan` text NOT NULL,
  `lulusan` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `pesan`, `lulusan`, `foto`) VALUES
(1, 'ZR', 'Belajar di SMK Assalam memberikan saya skill teknis yang sangat relevan. Sekarang saya bekerja sebagai Network Engineer di Jakarta.', '2022', 'galeri/alumni.png'),
(2, 'Rina Kartika', 'Fasilitas workshop otomotifnya sangat lengkap, membuat saya percaya diri saat magang di industri besar.', '2023', 'galeri/alumni2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `mapel` varchar(100) NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `ruang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id`, `hari`, `tanggal`, `mapel`, `waktu`, `ruang`) VALUES
(1, 'Senin', '24 Agustus 2026', 'Bahasa Inggris', '07:30 - 09:30', 'Ruang Lab Komputer 1'),
(2, 'Selasa', '25 Agustus 2026', 'Matematika', '07:30 - 09:30', 'Ruang Kelas XI-A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'adminjuga', 'admin'),
(2, 'user', 'user123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin_finger` (`pin_finger`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin_finger` (`pin_finger`);

--
-- Indeks untuk tabel `sambutan`
--
ALTER TABLE `sambutan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indeks untuk tabel `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sambutan`
--
ALTER TABLE `sambutan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `statistik`
--
ALTER TABLE `statistik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`pin_finger`) REFERENCES `pegawai` (`pin_finger`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
