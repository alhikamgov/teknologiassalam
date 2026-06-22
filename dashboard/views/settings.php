<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Keamanan Akun</h6>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control bg-light" value="<?= $_SESSION['user_now'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" name="old_pass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="new_pass" class="form-control" required>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-primary btn-block mt-4">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>