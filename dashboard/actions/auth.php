<?php
// Logika Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = $_POST['pass'];
    
    $query_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    
    if (mysqli_num_rows($query_user) > 0) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['user_now'] = $username;
        header("Location: index.php");
        exit;
    } else { 
        $login_error = "Username atau Password salah!"; 
    }
}

// Logika Logout
if (isset($_GET['logout'])) { 
    session_destroy(); 
    header("Location: login.php"); 
    exit; 
}