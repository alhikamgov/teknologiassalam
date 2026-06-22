<?php
// ==========================================
// 1. LOGIKA PROSES BACKEND (TAMBAH, EDIT, & HAPUS)
// ==========================================

// A. Proses Tambah Data Pegawai
if (isset($_POST['add_pegawai'])) {
    $pin = mysqli_real_escape_string($conn, $_POST['pin_finger']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jk']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    
    $query = "INSERT INTO pegawai (pin_finger, nip, nama, jk, no_hp, alamat, jabatan) 
              VALUES ('$pin', '$nip', '$nama', '$jk', '$no_hp', '$alamat', '$jabatan')";
    mysqli_query($conn, $query);
    echo "<script>window.location.href='?s=data-pegawai';</script>";
}

// B. Proses Edit / Update Data Pegawai
if (isset($_POST['edit_pegawai'])) {
    $id_target = mysqli_real_escape_string($conn, $_POST['id_pegawai']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin_finger']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jk']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    
    $query_update = "UPDATE pegawai SET 
                        pin_finger = '$pin', 
                        nip = '$nip', 
                        nama = '$nama', 
                        jk = '$jk', 
                        no_hp = '$no_hp', 
                        alamat = '$alamat', 
                        jabatan = '$jabatan' 
                     WHERE id = '$id_target'";
                     
    mysqli_query($conn, $query_update);
    echo "<script>window.location.href='?s=data-pegawai';</script>";
}

// C. Proses Hapus Data Pegawai
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_hapus = mysqli_real_escape_string($conn, $_GET['id']);
    $query_delete = "DELETE FROM pegawai WHERE id = '$id_hapus'";
    mysqli_query($conn, $query_delete);
    echo "<script>window.location.href='?s=data-pegawai';</script>";
}

// Ambil semua data dari database
$pekerja = mysqli_query($conn, "SELECT * FROM pegawai ORDER BY nama ASC");
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Master Data Pegawai & Guru</h1>
    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPegawaiModal">
        <i class="fas fa-plus fa-sm mr-2"></i> Tambah Biodata Pegawai
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="pl-4">PIN / NIP</th>
                        <th>Nama Lengkap</th>
                        <th>L/P</th>
                        <th>Jabatan</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th class="text-center" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($pekerja) == 0): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data pegawai.</td></tr>
                    <?php else: while($row = mysqli_fetch_assoc($pekerja)): ?>
                    <tr>
                        <td class="pl-4">
                            <span class="badge badge-primary font-weight-bold">PIN: #<?= $row['pin_finger'] ?></span>
                            <small class="d-block text-muted mt-1">NIP: <?= !empty($row['nip']) ? $row['nip'] : '-' ?></small>
                        </td>
                        <td class="font-weight-bold text-dark"><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= $row['jk'] == 'Laki-laki' ? 'L' : 'P' ?></td>
                        <td><span class="badge badge-info px-2 py-1"><?= $row['jabatan'] ?></span></td>
                        <td><?= !empty($row['no_hp']) ? htmlspecialchars($row['no_hp']) : '-' ?></td>
                        <td class="small text-muted"><?= !empty($row['alamat']) ? htmlspecialchars($row['alamat']) : '-' ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-circle btn-warning btn-edit-pegawai" 
                                    data-id="<?= $row['id'] ?>"
                                    data-pin="<?= $row['pin_finger'] ?>"
                                    data-nip="<?= $row['nip'] ?>"
                                    data-nama="<?= htmlspecialchars($row['nama']) ?>"
                                    data-jk="<?= $row['jk'] ?>"
                                    data-hp="<?= htmlspecialchars($row['no_hp']) ?>"
                                    data-jabatan="<?= $row['jabatan'] ?>"
                                    data-alamat="<?= htmlspecialchars($row['alamat']) ?>"
                                    title="Edit Data">
                                <i class="fas fa-edit fa-sm"></i>
                            </button>
                            
                            <a href="?s=data-pegawai&action=delete&id=<?= $row['id'] ?>" 
                               class="btn btn-sm btn-circle btn-danger" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= htmlspecialchars($row['nama']) ?>? Data yang dihapus tidak bisa dikembalikan.');" 
                               title="Hapus Data">
                                <i class="fas fa-trash fa-sm"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addPegawaiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title font-weight-bold ml-2">Biodata Pegawai Baru</h5>
                <button class="close text-white" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">PIN Jari (Aplikasi Solution)</label>
                        <input type="text" name="pin_finger" class="form-control" placeholder="Contoh: 101" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">NIP / No. Identitas</label>
                        <input type="text" name="nip" class="form-control" placeholder="Boleh dikosongkan">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="small font-weight-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama beserta gelar..." required>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">Jenis Kelamin</label>
                        <select name="jk" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">No. WhatsApp/HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxx">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="small font-weight-bold">Jabatan Kerja</label>
                    <select name="jabatan" class="form-control">
                        <option value="Guru">Guru</option>
                        <option value="Staf TU">Staf TU</option>
                        <option value="Karyawan">Karyawan</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label class="small font-weight-bold">Alamat Rumah Tempat Tinggal</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap..."></textarea>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button class="btn btn-link text-muted" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" name="add_pegawai" class="btn btn-primary px-4">Simpan Biodata</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editPegawaiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content border-0 shadow">
            <input type="hidden" name="id_pegawai" id="edit_id">
            
            <div class="modal-header bg-warning text-dark border-0">
                <h5 class="modal-title font-weight-bold ml-2">Ubah Data Pegawai</h5>
                <button class="close text-dark" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">PIN Jari (Aplikasi Solution)</label>
                        <input type="text" name="pin_finger" id="edit_pin" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">NIP / No. Identitas</label>
                        <input type="text" name="nip" id="edit_nip" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="small font-weight-bold">Nama Lengkap</label>
                    <input type="text" name="nama" id="edit_nama" class="form-control" required>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">Jenis Kelamin</label>
                        <select name="jk" id="edit_jk" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label class="small font-weight-bold">No. WhatsApp/HP</label>
                        <input type="text" name="no_hp" id="edit_hp" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="small font-weight-bold">Jabatan Kerja</label>
                    <select name="jabatan" id="edit_jabatan" class="form-control">
                        <option value="Guru">Guru</option>
                        <option value="Staf TU">Staf TU</option>
                        <option value="Karyawan">Karyawan</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label class="small font-weight-bold">Alamat Rumah Tempat Tinggal</label>
                    <textarea name="alamat" id="edit_alamat" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button class="btn btn-link text-muted" type="button" data-dismiss="modal">Batal</button>
                <button type="submit" name="edit_pegawai" class="btn btn-warning px-4 text-dark font-weight-bold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Tangkap semua elemen tombol dengan class .btn-edit-pegawai
    const editButtons = document.querySelectorAll('.btn-edit-pegawai');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data-attributes dari tombol yang diklik
            const id = this.getAttribute('data-id');
            const pin = this.getAttribute('data-pin');
            const nip = this.getAttribute('data-nip');
            const nama = this.getAttribute('data-nama');
            const jk = this.getAttribute('data-jk');
            const hp = this.getAttribute('data-hp');
            const jabatan = this.getAttribute('data-jabatan');
            const alamat = this.getAttribute('data-alamat');
            
            // Masukkan data tersebut ke dalam input field Modal Edit
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_pin').value = pin;
            document.getElementById('edit_nip').value = nip;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jk').value = jk;
            document.getElementById('edit_hp').value = hp;
            document.getElementById('edit_jabatan').value = jabatan;
            document.getElementById('edit_alamat').value = alamat;
            
            // Tampilkan Modal Edit secara manual lewat jQuery (bawaan template SB Admin)
            $('#editPegawaiModal').modal('show');
        });
    });
});
</script>