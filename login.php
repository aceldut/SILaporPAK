<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-center text-white">
                MASUK
            </div>
            <div class="card-body">
                <form action="config/aksi_login.php" method="POST">
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                        </div>
                        <select class="form-control" name="level">
                            <option value="masyarakat">Masyarakat</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                    <button type="submit" name="kirim" class="btn btn-primary w-100">MASUK</button>
                    <a href="index.php?page=registrasi" class="d-block text-center mt-3">Belum punya akun? Daftar disini</a>
                </form>
            </div>
        </div>
    </div>
</div>