<?php
session_start();
require_once "../koneksi.php";
require_once "actions/auth.php";

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0440b3 0%, #021b4a 100%); height: 100vh; display: flex; align-items: center; }
        .card-login { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); overflow: hidden; }
        .btn-primary { background: #0440b3; border: none; padding: 12px; border-radius: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-login">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="font-weight-bold text-dark">Panel Admin</h3>
                            <p class="text-muted small">Silahkan masuk untuk mengelola konten</p>
                        </div>
                        <?php if(isset($login_error)): ?>
                            <div class="alert alert-danger py-2 small text-center"><?= $login_error ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="form-group">
                                <label class="small font-weight-bold">Username</label>
                                <input type="text" name="user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="small font-weight-bold">Password</label>
                                <input type="password" name="pass" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block shadow-sm mt-4">MASUK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>