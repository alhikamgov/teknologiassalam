<?php
if (isset($_POST['change_password'])) {
    $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $user_now = $_SESSION['user_now'];
    
    $check_old = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user_now' AND password = '$old_pass'");
    if (mysqli_num_rows($check_old) > 0) {
        $update_pass = mysqli_query($conn, "UPDATE users SET password = '$new_pass' WHERE username = '$user_now'");
        if ($update_pass) {
            $msg = "Password berhasil diperbarui!";
        } else {
            $msg = "Gagal memperbarui database!"; $msg_type = "danger";
        }
    } else { 
        $msg = "Gagal: Password lama salah!"; $msg_type = "danger"; 
    }
}