<?php
// ==========================================
// 1. LOGIKA UTAMA FILE SYSTEM (BACKEND)
// ==========================================

$dir = "../galeri/";

// A. Proses Upload Foto Baru
if (isset($_POST['upload_foto'])) {
    if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] == 0) {
        $nama_asli = $_FILES['foto_baru']['name'];
        $tmp_name = $_FILES['foto_baru']['tmp_name'];
        
        // Bersihkan nama file dari karakter aneh agar aman di URL
        $nama_bersih = preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $nama_asli);
        $target_file = $dir . $nama_bersih;
        
        // Validasi Ekstensi Gambar
        $ekstensi = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $ekstensi_boleh = array("jpg", "jpeg", "png", "gif");
        
        if (in_array($ekstensi, $ekstensi_boleh)) {
            // Jika nama file sudah ada, berikan prefix angka acak agar tidak menimpa
            if (file_exists($target_file)) {
                $target_file = $dir . rand(10, 99) . "_" . $nama_bersih;
            }
            
            move_uploaded_file($tmp_name, $target_file);
        }
    }
    echo "<script>window.location.href='?s=galeri';</script>";
}

// B. Proses Ganti Nama Foto
if (isset($_POST['rename_foto'])) {
    $path_lama = mysqli_real_escape_string($conn, $_POST['path_lama']);
    $nama_baru = mysqli_real_escape_string($conn, $_POST['nama_baru']);
    
    // Pastikan user tidak menghapus ekstensi file aslinya
    $ekstensi_asal = pathinfo($path_lama, PATHINFO_EXTENSION);
    
    // Bersihkan input nama baru dari karakter berbahaya
    $nama_baru_bersih = preg_replace("/[^a-zA-Z0-9\-_]/", "_", $nama_baru);
    $path_baru = $dir . $nama_baru_bersih . "." . $ekstensi_asal;
    
    if (file_exists($path_lama) && !file_exists($path_baru)) {
        rename($path_lama, $path_baru);
    }
    echo "<script>window.location.href='?s=galeri';</script>";
}

// C. Proses Hapus Foto
if (isset($_POST['delete_foto'])) {
    $path_target = mysqli_real_escape_string($conn, $_POST['path_target']);
    
    // Cek keamanan jalur agar tidak menghapus file di luar folder galeri
    if (file_exists($path_target) && strpos($path_target, $dir) === 0) {
        unlink($path_target); // Hapus file dari penyimpanan lokal server
    }
    echo "<script>window.location.href='?s=galeri';</script>";
}

// Scanning isi folder galeri
$format_gambar = array("*.jpg", "*.jpeg", "*.png", "*.gif", "*.JPG", "*.JPEG", "*.PNG");
$files = array();
if (is_dir($dir)) {
    foreach ($format_gambar as $format) {
        $cari_gambar = glob($dir . $format);
        if ($cari_gambar) {
            $files = array_merge($files, $cari_gambar);
        }
    }
}
?>

<!-- ==========================================
// 2. TAMPILAN HALAMAN UTAMA & LAYOUT
// ========================================== -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Media Galeri</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#uploadFotoModal">
        <i class="fas fa-upload fa-sm mr-2"></i> Upload Foto Baru
    </button>
</div>

<div class="row">
    <?php if (empty($files)): ?>
        <div class="col-12"><div class="alert alert-info text-center py-4">Belum ada dokumentasi foto. Silakan klik tombol Upload di atas.</div></div>
    <?php else: foreach ($files as $gambar): 
        $nama_file_lengkap = basename($gambar);
        $nama_file_saja = pathinfo($gambar, PATHINFO_FILENAME);
    ?>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 gallery-card">
                <!-- Lapisan Gambar -->
                <div class="overflow-hidden bg-light position-relative text-center" style="height: 180px;">
                    <img src="<?= $gambar ?>" class="w-100 h-100 card-img-top" style="object-fit: cover; cursor: pointer;" onclick="viewImage('<?= $gambar ?>', '<?= $nama_file_lengkap ?>')" alt="<?= $nama_file_lengkap ?>">
                    
                    <!-- Floating Overlay Menu Aksi -->
                    <div class="action-overlay position-absolute" style="top: 10px; right: 10px; z-index: 5;">
                        <!-- Tombol Rename -->
                        <button class="btn btn-sm btn-warning btn-circle shadow" onclick="triggerRename('<?= $gambar ?>', '<?= $nama_file_saja ?>')" title="Ganti Nama">
                            <i class="fas fa-pen fa-sm"></i>
                        </button>
                        <!-- Tombol Hapus -->
                        <button class="btn btn-sm btn-danger btn-circle shadow ml-1" onclick="triggerDelete('<?= $gambar ?>', '<?= $nama_file_lengkap ?>')" title="Hapus Foto">
                            <i class="fas fa-trash fa-sm"></i>
                        </button>
                    </div>
                </div>
                <!-- Lapisan Nama File -->
                <div class="card-body p-2 bg-white text-center">
                    <small class="text-dark font-weight-bold d-block text-truncate" title="<?= $nama_file_lengkap ?>">
                        <?= $nama_file_lengkap ?>
                    </small>
                </div>
            </div>
        </div>
    <?php endforeach; endif; ?>
</div>

<!-- ==========================================
// 3. KOMPONEN MODALS (POP-UP FORM)
// ========================================== -->

<!-- A. MODAL UPLOAD FOTO -->
<div class="modal fade" id="uploadFotoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title font-weight-bold ml-2">Upload File Dokumentasi</h5>
                <button class="close text-white" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <div class="form-group mb-0">
                    <label class="small font-weight-bold d-block mb-2">Pilih File Gambar dari Komputer / HP</label>
                    <input type="file" name="foto_baru" class="form-control-file" accept="image/*" required>
                    <small class="text-muted d-block mt-2">Format yang diizinkan: .jpg, .jpeg, .png, .gif</small>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button class="btn btn-link text-muted" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" name="upload_foto" class="btn btn-primary px-4">Mulai Upload</button>
            </div>
        </form>
    </div>
</div>

<!-- B. MODAL RENAME FOTO -->
<div class="modal fade" id="renameFotoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content border-0 shadow">
            <input type="hidden" name="path_lama" id="rename_path_lama">
            <div class="modal-header bg-warning text-dark border-0">
                <h5 class="modal-title font-weight-bold ml-2">Ganti Nama File</h5>
                <button class="close text-dark" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <div class="form-group mb-0">
                    <label class="small font-weight-bold mb-2">Nama Judul Foto Baru</label>
                    <div class="input-group">
                        <input type="text" name="nama_baru" id="rename_input_nama" class="form-control" required placeholder="Tulis nama tanpa ekstensi...">
                    </div>
                    <small class="text-muted d-block mt-1">Ekstensi file (.jpg/.png) akan otomatis dipertahankan oleh sistem.</small>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button class="btn btn-link text-muted" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" name="rename_foto" class="btn btn-warning px-4 text-dark font-weight-bold">Simpan Nama Baru</button>
            </div>
        </form>
    </div>
</div>

<!-- C. MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="deleteFotoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <form method="POST" class="modal-content border-0 shadow">
            <input type="hidden" name="path_target" id="delete_path_target">
            <div class="modal-body p-4 text-center">
                <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                <h6 class="font-weight-bold text-dark">Hapus Foto Permanen?</h6>
                <p class="small text-muted mb-0">File <span id="delete_label_nama" class="font-weight-bold text-dark"></span> akan dihapus dari penyimpanan server hosting.</p>
            </div>
            <div class="modal-content-footer p-3 bg-light d-flex justify-content-center border-0">
                <button class="btn btn-sm btn-link text-muted mr-2" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" name="delete_foto" class="btn btn-sm btn-danger px-4">Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- D. MODAL DETAIL VIEW PREVIEW -->
<div class="modal fade" id="previewImageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-body p-0 text-center position-relative">
                <button class="close position-absolute text-white" style="right: 15px; top: 10px; z-index: 999; font-size: 30px;" type="button" data-dismiss="modal">&times;</button>
                <img id="modalTargetImg" src="" class="img-fluid rounded shadow-lg">
                <p id="modalTargetCaption" class="text-white mt-2 font-weight-bold bg-dark d-inline-block px-3 py-1 rounded-pill small"></p>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
// 4. SCRIPTS & LOGIKA INTERAKTIF FRONTEND
// ========================================== -->
<script>
function viewImage(src, title) {
    document.getElementById('modalTargetImg').src = src;
    document.getElementById('modalTargetCaption').innerText = title;
    $('#previewImageModal').modal('show');
}

function triggerRename(path, oldName) {
    document.getElementById('rename_path_lama').value = path;
    document.getElementById('rename_input_nama').value = oldName;
    $('#renameFotoModal').modal('show');
}

function triggerDelete(path, filename) {
    document.getElementById('delete_path_target').value = path;
    document.getElementById('delete_label_nama').innerText = filename;
    $('#deleteFotoModal').modal('show');
}
</script>

<style>
.gallery-card {
    transition: all .2s ease-in-out;
}
.gallery-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
.action-overlay {
    opacity: 0;
    transition: opacity .25s ease-in-out;
}
.gallery-card:hover .action-overlay {
    opacity: 1;
}
</style>