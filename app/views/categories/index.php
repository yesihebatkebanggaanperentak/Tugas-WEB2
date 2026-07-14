<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="fw-bold mb-1"><i class="bi bi-tags text-primary me-2"></i> Kelola Kategori</h2>
        <p class="text-muted mb-0">Daftar kategori untuk mengelompokkan barang inventaris.</p>
    </div>
    <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
        <a href="<?= BASE_URL ?>admin/categories/create" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Tambah Kategori</a>
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
                    <th class="ps-4 py-3" style="width: 80px;">ID</th>
                    <th class="py-3">Nama Kategori</th>
                    <th class="py-3">Deskripsi</th>
                    <th class="pe-4 py-3 text-end" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($categories) === 0): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada data kategori.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td class="ps-4 fw-medium text-muted"><?= $cat['id'] ?></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($cat['name']) ?></td>
                            <td class="text-muted"><?= htmlspecialchars($cat['description'] ?? 'Tidak ada deskripsi.') ?></td>
                            <td class="pe-4 text-end">
                                <a href="<?= BASE_URL ?>admin/categories/edit/<?= $cat['id'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit Kategori">
                                    <i class="bi bi-pencil"></i> <span class="d-none d-md-inline ms-1">Edit</span>
                                </a>
                                <a href="<?= BASE_URL ?>admin/categories/delete/<?= $cat['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua barang dengan kategori ini juga akan terhapus.')" title="Hapus Kategori">
                                    <i class="bi bi-trash"></i> <span class="d-none d-md-inline ms-1">Hapus</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
