<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-person-gear me-2"></i> Pengaturan Profil & Alamat</h3>
                <a href="<?= BASE_URL ?>dashboard" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($success) ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>profile" method="POST">
                <h5 class="fw-bold mb-3 text-secondary"><i class="bi bi-person me-2"></i> Informasi Dasar</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Nama Lengkap</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                </div>

                <h5 class="fw-bold mb-3 text-secondary border-top pt-3"><i class="bi bi-geo-alt me-2"></i> Detail Alamat Pengiriman</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label for="address_street" class="form-label">Jalan / Detail Rumah / Kantor</label>
                        <input type="text" name="address_street" id="address_street" class="form-control" placeholder="Nama Jalan, Blok, RT/RW, Nomor Rumah" value="<?= htmlspecialchars($user['address_street'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="address_city" class="form-label">Kota / Kabupaten</label>
                        <input type="text" name="address_city" id="address_city" class="form-control" placeholder="Contoh: Sleman, Jakarta Selatan" value="<?= htmlspecialchars($user['address_city'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="address_province" class="form-label">Provinsi</label>
                        <input type="text" name="address_province" id="address_province" class="form-control" placeholder="Contoh: DI Yogyakarta, DKI Jakarta" value="<?= htmlspecialchars($user['address_province'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="address_zip" class="form-label">Kode Pos</label>
                        <input type="text" name="address_zip" id="address_zip" class="form-control" placeholder="Contoh: 55581" value="<?= htmlspecialchars($user['address_zip'] ?? '') ?>">
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
