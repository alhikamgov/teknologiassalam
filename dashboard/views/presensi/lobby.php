<?php
$timestamp_wib = time() * 1000;
$hari_ini = date('Y-m-d');
$notif = "";
$nama_terdeteksi = "";

// Logika ketika ada PIN yang ditembak masuk
if (isset($_POST['scan_pin'])) {
    $pin = mysqli_real_escape_string($conn, $_POST['pin_finger']);
    $jam_sekarang = date('H:i:s');
    
    // Cek apakah PIN terdaftar di DB Master Pegawai
    $cek_pegawai = mysqli_query($conn, "SELECT nama FROM pegawai WHERE pin_finger = '$pin'");
    if (mysqli_num_rows($cek_pegawai) > 0) {
        $data_p = mysqli_fetch_assoc($cek_pegawai);
        $nama_terdeteksi = $data_p['nama'];
        
        // Cek apakah hari ini pegawai tersebut sudah scan masuk
        $cek_log = mysqli_query($conn, "SELECT * FROM presensi WHERE pin_finger = '$pin' AND tanggal = '$hari_ini'");
        
        if (mysqli_num_rows($cek_log) == 0) {
            mysqli_query($conn, "INSERT INTO presensi (pin_finger, tanggal, jam_masuk) VALUES ('$pin', '$hari_ini', '$jam_sekarang')");
            $notif = "SUCCESS_MASUK";
        } else {
            mysqli_query($conn, "UPDATE presensi SET jam_pulang = '$jam_sekarang' WHERE pin_finger = '$pin' AND tanggal = '$hari_ini'");
            $notif = "SUCCESS_PULANG";
        }
    } else {
        $notif = "FAILED_UNKNOWN";
    }

    // --- TRICK REFRESH OTOMATIS 5 DETIK ---
    echo '<meta http-equiv="refresh" content="5;url=?s=presensi-lobby">';
}
?>

<style>
#accordionSidebar, #content-wrapper {
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
}
/* Sembunyikan topbar bawaan SB Admin 2 khusus di halaman ini */
nav.navbar.navbar-expand.navbar-light.bg-white {
    display: none !important;
}
.container-fluid {
    padding-top: 35px !important;
}
</style>

<div class="row justify-content-center">
    <div class="col-md-8 text-center mb-4">
        <h2 class="text-dark font-weight-bold">Presensi Sekolah</h2>
        <p class="text-muted">Silahkan tempelkan jari Anda.</p>
        <h3 class="font-weight-bold text-primary mb-4" id="clock">00:00:00</h3>
    </div>
    
    <div class="col-md-6">
        <?php if($notif == "SUCCESS_MASUK"): ?>
            <div id="notif-alert" class="card bg-success text-white shadow-sm text-center p-4 mb-4 border-0">
                <i class="fas fa-check-circle fa-3x mb-2"></i>
                <h4>Berhasil Absen MASUK</h4>
                <h5 class="font-weight-bold text-warning"><?= $nama_terdeteksi ?></h5>
                <small>Selamat bertugas di sekolah!</small>
            </div>
        <?php elseif($notif == "SUCCESS_PULANG"): ?>
            <div id="notif-alert" class="card bg-warning text-white shadow-sm text-center p-4 mb-4 border-0">
                <i class="fas fa-sign-out-alt fa-3x mb-2"></i>
                <h4>Berhasil Absen PULANG</h4>
                <h5 class="font-weight-bold text-dark"><?= $nama_terdeteksi ?></h5>
                <small>Hati-hati di jalan pulang!</small>
            </div>
        <?php elseif($notif == "FAILED_UNKNOWN"): ?>
            <div id="notif-alert" class="card bg-danger text-white shadow-sm text-center p-4 mb-4 border-0">
                <i class="fas fa-exclamation-triangle fa-3x mb-2"></i>
                <h4>PIN Tidak Terdaftar</h4>
                <small>Silahkan daftarkan PIN sidik jari Anda ke admin TU terlebih dahulu.</small>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4 text-center">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="pin_finger" class="form-control text-center font-weight-bold form-control-lg border-primary" placeholder="Tempelkan Jari" autofocus required>
                        <button type="submit" name="scan_pin" class="d-none">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// 1. Logika Jam Digital Sinkron Server
let serverTime = new Date(<?= $timestamp_wib ?>);
setInterval(() => {
    serverTime.setSeconds(serverTime.getSeconds() + 1);
    document.getElementById('clock').innerHTML = serverTime.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    }) + " WIB";
}, 1000);

// 2. Logika Pemaksa Auto-Hide Sidebar saat Mouse Diam / Tanpa Gerakan
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("accordionSidebar");
    const body = document.querySelector("body");
    let mouseTimer;

    // Fungsi pembantu untuk melipat sidebar (Full Screen)
    function hideSidebar() {
        if (sidebar) sidebar.classList.add("toggled");
        if (body) body.classList.add("sidebar-toggled");
    }

    // Fungsi pembantu untuk membuka kembali sidebar
    function showSidebar() {
        if (sidebar) sidebar.classList.remove("toggled");
        if (body) body.classList.remove("sidebar-toggled");
    }

    // Eksekusi lipat pertama kali saat halaman berhasil ke-load
    hideSidebar();

    // Deteksi pergerakan mouse di seluruh area layar monitor
    document.addEventListener("mousemove", function() {
        clearTimeout(mouseTimer);
        showSidebar(); // Kursor gerak = Tampilkan sidebar

        // Jika kursor diam selama 3 detik, panggil fungsi melipat sidebar kembali
        mouseTimer = setTimeout(hideSidebar, 3000);
    });
});
</script>