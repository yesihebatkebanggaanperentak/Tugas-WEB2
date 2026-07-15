<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card p-4 shadow-lg border-0">
            <div class="text-center mb-4">
                <i class="bi bi-box-seam-fill text-primary display-4 mb-2"></i>
                <h3 class="fw-bold">Selamat Datang Kembali</h3>
                <p class="text-muted">Masuk ke akun InventoryHub Anda</p>
            </div>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($success) ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" id="email" class="form-control border-start-0 ps-0" placeholder="nama@contoh.com" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : (isset($email_preset) ? htmlspecialchars($email_preset) : '') ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label for="password" class="form-label mb-0">Password</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-box-arrow-in-right me-2"></i> Masuk</button>
                </div>

                <div class="text-center mt-3">
                    <p class="text-muted mb-0">Belum punya akun? <a href="<?= BASE_URL ?>register" class="text-decoration-none">Daftar sekarang</a></p>
                </div>
            </form>
        </div>

        <div class="card p-3 mt-4 text-center border-0 bg-light">
            <h6 class="fw-bold mb-2">Info Akun Demo:</h6>
            <div class="row text-start text-muted small">
                <div class="col-6 border-end">
                    <strong>Admin:</strong><br>
                    Email: admin@gmail.com<br>
                    Pass: admin123
                </div>
                <div class="col-6">
                    <strong>User:</strong><br>
                    Email: user@gmail.com<br>
                    Pass: user123
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
