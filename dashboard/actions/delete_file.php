<?php
if (isset($_POST['delete_file'])) {
    $file_to_delete = $_POST['file_path'];
    // Ditambahkan ../ karena posisi aksi ada di subfolder
    if (file_exists("../" . $file_to_delete)) {
        unlink("../" . $file_to_delete);
        $msg = "File berhasil dihapus dari server!";
    } else if (file_exists($file_to_delete)) {
        unlink($file_to_delete);
        $msg = "File berhasil dihapus dari server!";
    } else {
        $msg = "File tidak ditemukan di server!";
        $msg_type = "danger";
    }
}