<?php
// Logika Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = $_POST['pass'];
    
    // Query disesuaikan untuk mengambil seluruh kolom termasuk role
    $query_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    
    if (mysqli_num_rows($query_user) > 0) {
        $data_user = mysqli_fetch_assoc($query_user);
        
        // Simpan data otentikasi & tingkatan akses ke Session
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_now']       = $data_user['username'];
        $_SESSION['role']           = $data_user['role']; // Menyimpan 'admin' atau 'user'
        
        header("Location: index.php");
        exit;
    } else { 
        $login_error = "Username atau Password salah!"; 
    }
}

// Logika Logout
if (isset($_GET['logout'])) { 
    session_start(); // Memastikan session terbaca sebelum dihancurkan
    session_destroy(); 
    header("Location: login.php"); 
    exit; 
}