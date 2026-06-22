<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['login']) && !isset($_POST['change_password']) && !isset($_POST['delete_file']) && !isset($_POST['scan_pin']) && !isset($_POST['add_pegawai'])) {
    $act = $_POST['action'] ?? ''; 
    $sec = isset($_POST['section']) ? mysqli_real_escape_string($conn, $_POST['section']) : '';

    if ($act === 'save') {
        $fields = $_POST['fields'] ?? []; 
        $idx = $_POST['index']; 
        
        // Handle upload file baru
        if (isset($_FILES['upload_file'])) {
            foreach ($_FILES['upload_file']['name'] as $key => $filename) {
                if ($_FILES['upload_file']['error'][$key] === 0) {
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $new_name = $sec . "_" . time() . "_" . $key . "." . $ext;
                    $target = $upload_dir . $new_name;
                    
                    if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$key], $target)) { 
                        // Simpan path relatif bersih ke database agar index luar gampang panggil ('galeri/namafile.ext')
                        $fields[$key] = 'galeri/' . $new_name; 
                    }
                }
            }
        }
        
        if (in_array($sec, ['hero', 'sambutan', 'kontak'])) {
            $update_parts = [];
            foreach ($fields as $k => $v) {
                $safe_v = mysqli_real_escape_string($conn, $v);
                $update_parts[] = "`$k` = '$safe_v'";
            }
            $query_str = "UPDATE `$sec` SET " . implode(', ', $update_parts) . " WHERE id = 1";
            mysqli_query($conn, $query_str);
            
        } else {
            if ($idx !== "") {
                $update_parts = [];
                foreach ($fields as $k => $v) {
                    $safe_v = mysqli_real_escape_string($conn, $v);
                    $update_parts[] = "`$k` = '$safe_v'";
                }
                $query_str = "UPDATE `$sec` SET " . implode(', ', $update_parts) . " WHERE id = '$idx'";
                mysqli_query($conn, $query_str);
            } else {
                $columns = array_keys($fields);
                $values = array_map(function($val) use ($conn) {
                    return "'" . mysqli_real_escape_string($conn, $val) . "'";
                }, array_values($fields));
                
                $query_str = "INSERT INTO `$sec` (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $values) . ")";
                mysqli_query($conn, $query_str);
            }
        }
        $msg = "Data " . ucfirst($sec) . " berhasil disimpan!";
    }
    
    if ($act === 'del') {
        $idx = mysqli_real_escape_string($conn, $_POST['index']);
        mysqli_query($conn, "DELETE FROM `$sec` WHERE id = '$idx'");
        $msg = "Data berhasil dihapus!";
    }
}