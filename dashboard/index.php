<?php
date_default_timezone_set('Asia/Jakarta');

if (isset($conn)) {
    mysqli_query($conn, "SET time_zone = '+07:00'");
}

session_start();

// --- PROTEKSI HALAMAN UTAMA ---
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Tangkap role yang sedang aktif
$user_role = $_SESSION['role'] ?? 'user'; 

$upload_dir = '../galeri/'; 
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

// --- KONEKSI DATABASE MYSQL ---
require_once "../koneksi.php";

$msg = "";
$msg_type = "success";

// --- INCLUDE LOGIKA BACKEND ---
require_once "actions/auth.php";
require_once "actions/delete_file.php";
require_once "actions/change_password.php";
require_once "actions/crud.php";

$curr = $_GET['s'] ?? 'hero';

// --- VALIDASI/BLOCKING URL UNTUK USER BIASA ---
if ($user_role === 'user') {
    // Menu yang boleh diakses oleh user biasa lewat URL
    $allowed_user_sections = ['siswa', 'ujian', 'ekskul', 'berita', 'pengumuman', 'agenda', 'testimoni', 'galeri', 'settings'];
    
    if (!in_array($curr, $allowed_user_sections)) {
        // Jika mencoba masuk menu admin, lempar otomatis ke Berita
        header("Location: index.php?s=berita");
        exit;
    }
}

// --- QUERY DATA UNTUK DITAMPILKAN ---
$data_tabel = [];

// Tambahkan modul presensi ke dalam array pengecualian agar tidak di-query otomatis
$excluded_sections = ['galeri', 'settings', 'data-pegawai', 'presensi-lobby', 'hasil-presensi'];

if (!in_array($curr, $excluded_sections)) {
    $query_get = mysqli_query($conn, "SELECT * FROM `$curr`");
    if ($query_get) {
        if (in_array($curr, ['hero', 'sambutan', 'kontak'])) {
            $row = mysqli_fetch_assoc($query_get);
            if ($row) {
                unset($row['id']);
                $data_tabel = $row;
            }
        } else {
            while ($row = mysqli_fetch_assoc($query_get)) {
                $data_tabel[] = $row;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - SMK Teknologi Assalam</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        :root { --primary: #0440b3; --secondary: #021b4a; }
        .bg-gradient-primary { background: var(--primary); background-image: linear-gradient(180deg, var(--primary) 10%, var(--secondary) 100%); }
        .img-preview { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
        .galeri-card { transition: 0.3s; border: none; border-radius: 12px; overflow: hidden; }
        .galeri-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .galeri-img { height: 150px; object-fit: cover; width: 100%; border-bottom: 1px solid #eee; }
        .sidebar-dark .nav-item.active .nav-link { background: rgba(255,255,255,0.15); border-radius: 0 20px 20px 0; margin-right: 10px; }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include_once "components/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once "components/navbar.php"; ?>

                <div class="container-fluid">
                    <?php if($msg): ?>
                        <div class="alert alert-<?= $msg_type ?> alert-dismissible fade show shadow-sm" role="alert">
                            <?= $msg ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>

                    <?php 
                    if ($curr === 'galeri') {
                        include_once "views/galeri.php";
                    } elseif ($curr === 'settings') {
                        include_once "views/settings.php";
                    } elseif ($curr === 'data-pegawai') {
                        include_once "views/presensi/data_pegawai.php";
                    } elseif ($curr === 'presensi-lobby') {
                        include_once "views/presensi/lobby.php";
                    } elseif ($curr === 'hasil-presensi') {
                        include_once "views/presensi/hasil.php";
                    } else {
                        include_once "views/default_table.php";
                    }
                    ?>
                </div>
            </div>
            
            <?php include_once "components/footer.php"; ?>
        </div>
    </div>

    <?php include_once "components/modal.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>
    
    <script>
    function copyPath(path) {
        navigator.clipboard.writeText(path);
        alert('Path gambar disalin: ' + path);
    }

    // PERBAIKAN: Mengubah ffunction menjadi function biasa
    function openForm(data = null, idx = "") {
        $('#f_idx').val(idx);
        const cont = $('#f_fields').empty();
        const currentSection = "<?= $curr ?>";
        
        const templates = {
            "ujian": { "hari": "", "tanggal": "", "mapel": "", "waktu": "", "ruang": "" },
            "siswa": { "nis": "", "nama": "", "jk": "", "kelas": "", "jurusan": "" }, 
            "ekskul": { "nama": "", "gambar": "" }, 
            "guru": { "nama": "", "foto": "", "deskripsi": "" }, 
            "statistik": { "label": "", "angka": "" },
            "jurusan": { "nama": "", "foto": "", "deskripsi": "" }, 
            "berita": { "judul": "", "ringkasan": "", "gambar": "" },
            "pengumuman": { "judul": "", "isi": "", "tanggal": "" }, 
            "agenda": { "kegiatan": "", "waktu": "", "tempat": "" },
            "testimoni": { "nama": "", "pesan": "", "lulusan": "", "foto": "" }, 
            "fasilitas": { "nama": "", "img": "" }
        };

        const structure = data ? data : (templates[currentSection] || {});

        Object.keys(structure).forEach(k => {
            if(k === 'id') return;
            
            let val = structure[k];
            let label = k.replace('_', ' ').toUpperCase();

            if (k.includes('img') || k === 'foto' || k === 'gambar') {
                cont.append(`
                    <div class="form-group col-12 mb-3">
                        <label class="font-weight-bold small text-primary mb-2">${label}</label>
                        <div class="card bg-light p-3 border-0">
                            <ul class="nav nav-pills nav-fill mb-3 bg-white p-1 rounded-pill">
                                <li class="nav-item">
                                    <a class="nav-link active small py-1 rounded-pill" data-toggle="pill" href="#url-${k}">
                                        <i class="fas fa-link mr-1"></i> Gunakan Path/URL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link small py-1 rounded-pill" data-toggle="pill" href="#file-${k}">
                                        <i class="fas fa-upload mr-1"></i> Upload Baru
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="url-${k}">
                                    <input type="text" class="form-control shadow-sm" name="fields[${k}]" value="${val}" placeholder="Contoh: galeri/foto-sekolah.jpg">
                                    <small class="text-muted mt-2 d-block">
                                        <i class="fas fa-info-circle mr-1"></i> Tips: Kamu bisa salin path gambar dari Menu <b>Informasi > Galeri Foto</b>.
                                    </small>
                                </div>
                                <div class="tab-pane fade" id="file-${k}">
                                    <input type="file" class="form-control-file" name="upload_file[${k}]" accept="image/*">
                                    <small class="text-danger mt-2 d-block" style="font-size: 11px;">
                                        * Jika mengupload file baru, path di kolom URL akan otomatis diperbarui setelah disimpan.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            } else {
                cont.append(`
                    <div class="form-group col-12">
                        <label class="small font-weight-bold text-dark">${label}</label>
                        <textarea class="form-control shadow-sm" name="fields[${k}]" rows="2" required>${val}</textarea>
                    </div>
                `);
            }
        });
        $('#formModal').modal('show');
    }
    </script>
</body>
</html>