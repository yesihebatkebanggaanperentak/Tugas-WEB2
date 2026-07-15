<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card p-4 shadow-lg border-0">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus-fill text-primary display-4 mb-2"></i>
                <h3 class="fw-bold">Buat Akun Baru</h3>
                <p class="text-muted">Daftar untuk mulai mengelola inventaris Anda</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>register" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                        <input type="text" name="nama" id="nama" class="form-control border-start-0 ps-0" placeholder="Nama Lengkap Anda" required value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" id="email" class="form-control border-start-0 ps-0" placeholder="nama@contoh.com" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0 ps-0" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control border-start-0 ps-0" placeholder="Ulangi password" required>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-person-plus me-2"></i> Daftar</button>
                </div>

                <div class="text-center mt-3">
                    <p class="text-muted mb-0">Sudah punya akun? <a href="<?= BASE_URL ?>login" class="text-decoration-none">Masuk sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>