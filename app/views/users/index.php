<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="fw-bold mb-1"><i class="bi bi-people text-primary me-2"></i> Kelola Data User</h2>
        <p class="text-muted mb-0">Daftar semua akun pengguna dan informasi alamat mereka.</p>
    </div>
    <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
        <a href="<?= BASE_URL ?>admin/users/create" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i> Tambah User Baru</a>
    </div>
</div>

<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <div><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7 text-muted">
                <tr>
                    <th class="ps-4 py-3" style="width: 50px;">ID</th>
                    <th class="py-3">Nama / Email</th>
                    <th class="py-3" style="width: 120px;">Role</th>
                    <th class="py-3">Alamat Lengkap</th>
                    <th class="pe-4 py-3 text-end" style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) === 0): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada data user.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="ps-4 fw-medium text-muted"><?= $user['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light p-2 rounded-circle me-3 text-primary d-none d-sm-block">
                                        <i class="bi bi-person fs-5"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($user['username']) ?></div>
                                        <div class="text-muted small"><?= htmlspecialchars($user['email']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if ($user['role'] === 'admin'): ?>
                                    <span class="badge bg-primary px-2 py-1.5 text-uppercase">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary px-2 py-1.5 text-uppercase">User</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($user['address_street']) || !empty($user['address_city'])): ?>
                                    <div class="small">
                                        <span class="fw-medium text-dark"><?= htmlspecialchars($user['address_street'] ?? '') ?></span><br>
                                        <span class="text-muted">
                                            <?= htmlspecialchars($user['address_city'] ?? '') ?>, 
                                            <?= htmlspecialchars($user['address_province'] ?? '') ?> 
                                            <?= htmlspecialchars($user['address_zip'] ?? '') ?>
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <span class="badge bg-light text-danger border border-danger-subtle"><i class="bi bi-geo-alt me-1"></i> Alamat belum diisi</span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="<?= BASE_URL ?>admin/users/edit/<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit User">
                                    <i class="bi bi-pencil"></i> <span class="d-none d-md-inline ms-1">Edit</span>
                                </a>
                                <?php if ($user['id'] != $_SESSION['user']['id']): ?>
                                    <a href="<?= BASE_URL ?>admin/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini? Semua data terkait juga akan terhapus.')" title="Hapus User">
                                        <i class="bi bi-trash"></i> <span class="d-none d-md-inline ms-1">Hapus</span>
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-secondary" disabled title="Tidak dapat menghapus diri sendiri">
                                        <i class="bi bi-trash"></i> <span class="d-none d-md-inline ms-1">Hapus</span>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
