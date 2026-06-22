<?php
$filter_tgl = $_GET['tgl'] ?? date('Y-m-d');

// Ambil data rekap dari tabel pegawai di-join dengan log presensi harian
$query_rekap = "SELECT p.pin_finger, p.nama, p.jabatan, pr.jam_masuk, pr.jam_pulang 
                FROM pegawai p 
                LEFT JOIN presensi pr ON p.pin_finger = pr.pin_finger AND pr.tanggal = '$filter_tgl'
                ORDER BY p.nama ASC";

$exec_rekap = mysqli_query($conn, $query_rekap);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Laporan Hasil Presensi Harian</h1>
    <button onclick="window.print()" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-print fa-sm mr-2"></i> Cetak Dokumen
    </button>
</div>

<!-- Saringan Tanggal -->
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body bg-light rounded py-2">
        <form method="GET" class="form-inline">
            <input type="hidden" name="s" value="hasil-presensi">
            <div class="form-group mr-3">
                <label class="mr-2 small font-weight-bold">Pilih Hari Pemantauan:</label>
                <input type="date" class="form-control shadow-sm form-control-sm" name="tgl" value="<?= $filter_tgl ?>" onchange="this.form.submit()">
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="pl-4">Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Total Jam Kerja</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($exec_rekap)): ?>
                    <tr>
                        <td class="pl-4 font-weight-bold text-dark"><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= $row['jabatan'] ?></td>
                        <td class="text-success font-weight-bold"><?= $row['jam_masuk'] ? date('H:i', strtotime($row['jam_masuk'])) . ' WIB' : '--:--' ?></td>
                        <td class="text-warning font-weight-bold"><?= $row['jam_pulang'] ? date('H:i', strtotime($row['jam_pulang'])) . ' WIB' : '--:--' ?></td>
                        
                        <!-- KOLOM KALKULATOR TOTAL JAM KERJA -->
                        <td class="font-weight-bold text-info">
                            <?php 
                            if ($row['jam_masuk'] && $row['jam_pulang']) {
                                // Hitung selisih waktu menggunakan objek DateTime
                                $waktu_masuk = new DateTime($row['jam_masuk']);
                                $waktu_pulang = new DateTime($row['jam_pulang']);
                                $selisih = $waktu_masuk->diff($waktu_pulang);
                                
                                // Tampilkan dalam format: X Jam Y Menit
                                echo $selisih->h . " Jam " . $selisih->i . " Menit";
                            } elseif ($row['jam_masuk'] && !$row['jam_pulang']) {
                                echo "<span class='text-muted small font-weight-normal'><em>Sedang Bekerja...</em></span>";
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        
                        <td class="text-center">
                            <?php if ($row['jam_masuk']): ?>
                                <span class="badge badge-success px-3 py-1">Hadir</span>
                            <?php else: ?>
                                <span class="badge badge-danger px-3 py-1">Belum Absen / Alpa</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
@media print {
    #accordionSidebar, .navbar, .card.mb-4, .btn {
        display: none !important;
    }
    .card-body {
        padding: 0 !important;
    }
    body {
        padding: 20px;
        background-color: #fff !important;
    }
}
</style>