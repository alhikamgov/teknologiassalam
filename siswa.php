<?php
// 1. KONEKSI DATABASE (Sesuaikan dengan nama file koneksi Anda jika berbeda)
// include 'koneksi.php'; 
// Atau jika belum ada file koneksi khusus, Anda bisa gunakan baris di bawah ini:
$conn = mysqli_connect("localhost", "root", "", "dbassalam");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// 2. LOGIKA SORTIR DATA
$sort_by = $_GET['sort'] ?? 'nama'; // Default sortir berdasarkan nama
// Validasi whitelist kolom untuk keamanan dari SQL Injection
$allowed_sort = ['nama', 'kelas', 'nis'];
if (!in_array($sort_by, $allowed_sort)) {
    $sort_by = 'nama';
}

// 3. LOGIKA PAGINATION (MAKSIMAL 10 DATA)
$limit = 10; 

// Hitung total data langsung dari table siswa di database
$query_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa");
$data_total = mysqli_fetch_assoc($query_total);
$total_data = $data_total['total'];

$total_pages = ceil($total_data / $limit);
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;
if ($current_page > $total_pages && $total_pages > 0) $current_page = $total_pages;

$offset = ($current_page - 1) * $limit;

// 4. AMBIL DATA DARI DATABASE DENGAN SORTIR DAN LIMIT PAGINATION
$query_siswa = "SELECT * FROM siswa ORDER BY $sort_by ASC LIMIT $limit OFFSET $offset";
$result_siswa = mysqli_query($conn, $query_siswa);

$siswa_tampil = [];
if ($result_siswa && mysqli_num_rows($result_siswa) > 0) {
    while ($row = mysqli_fetch_assoc($result_siswa)) {
        $siswa_tampil[] = $row;
    }
}

// PANGGIL HEADER
include 'header.php';
?>
<title>Data Pelajar & Siwa - <?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></title>

    <main class="container content-wrapper">
        <div class="text-center mb-5">
            <h2 class="section-title">Data Pelajar / Siswa</h2>
            <p class="text-secondary">Daftar siswa aktif generasi berprestasi di <?= $hero['judul_utama'] ?? 'SMK Teknologi Assalam' ?></p>
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div class="text-muted small">
                Menampilkan <?= $total_data > 0 ? $offset + 1 : 0 ?> - <?= min($offset + $limit, $total_data) ?> dari <?= $total_data ?> Siswa
            </div>
            
            <form method="GET" class="d-flex align-items-center gap-2">
                <input type="hidden" name="page" value="1"> 
                <label for="sort" class="small fw-semibold text-secondary text-nowrap mb-0">Sortir Berdasarkan:</label>
                <select name="sort" id="sort" class="form-select form-select-sm rounded-pill px-3" onchange="this.form.submit()" style="width: 160px;">
                    <option value="nama" <?= $sort_by == 'nama' ? 'selected' : '' ?>>Nama Siswa</option>
                    <option value="kelas" <?= $sort_by == 'kelas' ? 'selected' : '' ?>>Kelas</option>
                    <option value="nis" <?= $sort_by == 'nis' ? 'selected' : '' ?>>NIS</option>
                </select>
            </form>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-secondary fw-bold small">
                                <th class="py-3 px-4" style="width: 80px;">No</th>
                                <th class="py-3">NIS</th>
                                <th class="py-3">Nama Lengkap</th>
                                <th class="py-3">Jenis Kelamin</th>
                                <th class="py-3">Kelas</th>
                                <th class="py-3 px-4">Jurusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($siswa_tampil)): ?>
                                <?php $no = $offset + 1; foreach($siswa_tampil as $s): ?>
                                <tr>
                                    <td class="py-3 px-4 fw-medium text-secondary"><?= $no++; ?></td>
                                    <td class="py-3 fw-bold text-dark"><?= htmlspecialchars($s['nis']) ?></td>
                                    <td class="py-3 text-secondary fw-semibold"><?= htmlspecialchars($s['nama']) ?></td>
                                    <td class="py-3">
                                        <?php if($s['jk'] == 'Laki-laki'): ?>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill small">Laki-laki</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill small">Perempuan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-3 text-secondary"><?= htmlspecialchars($s['kelas']) ?></td>
                                    <td class="py-3 px-4 text-secondary"><?= htmlspecialchars($s['jurusan']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-people display-4 d-block mb-3"></i>
                                        Belum ada data siswa yang tersedia.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if ($total_pages > 1): ?>
        <nav aria-label="Navigasi Halaman Siswa">
            <ul class="pagination pagination-sm justify-content-center gap-1">
                <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link rounded-circle border-0 shadow-sm" href="?page=<?= $current_page - 1 ?>&sort=<?= $sort_by ?>" aria-label="Previous">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                        <a class="page-link rounded-3 border-0 shadow-sm px-3 mx-1 fw-semibold" href="?page=<?= $i ?>&sort=<?= $sort_by ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?> 
                
                <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link rounded-circle border-0 shadow-sm" href="?page=<?= $current_page + 1 ?>&sort=<?= $sort_by ?>" aria-label="Next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </main>

<?php 
// PANGGIL FOOTER
include 'footer.php'; 
?>