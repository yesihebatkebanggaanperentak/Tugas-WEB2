<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-sm-6">
        <h2 class="fw-bold mb-1"><i class="bi bi-box-seam text-primary me-2"></i> Kelola Barang Inventaris</h2>
        <p class="text-muted mb-0">Daftar semua barang logistik yang dikelola sistem.</p>
    </div>
    <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
        <a href="<?= BASE_URL ?>admin/products/create" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Tambah Barang</a>
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
                    <th class="ps-4 py-3" style="width: 100px;">Foto</th>
                    <th class="py-3">Nama Barang</th>
                    <th class="py-3">Kategori</th>
                    <th class="py-3">Stok</th>
                    <th class="py-3">Deskripsi</th>
                    <th class="pe-4 py-3 text-end" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($products) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data barang.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $prod): ?>
                        <tr>
                            <td class="ps-4">
                                <?php if (!empty($prod['image']) && file_exists(BASE_PATH . 'public/uploads/' . $prod['image'])): ?>
                                    <img src="<?= BASE_URL ?>public/uploads/<?= $prod['image'] ?>" class="img-thumbnail rounded" style="width: 60px; height: 60px; object-fit: cover;" alt="<?= htmlspecialchars($prod['name']) ?>">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px;">
                                        <i class="bi bi-image fs-4"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($prod['name']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary px-2.5 py-1.5"><i class="bi bi-tag me-1"></i> <?= htmlspecialchars($prod['category_name'] ?? 'Tanpa Kategori') ?></span>
                            </td>
                            <td>
                                <?php if ($prod['stock'] > 0): ?>
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1.5"><?= $prod['stock'] ?> unit</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5">Habis</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-muted small" style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?= htmlspecialchars($prod['description'] ?? '-') ?>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="<?= BASE_URL ?>admin/products/edit/<?= $prod['id'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit Barang">
                                    <i class="bi bi-pencil"></i> <span class="d-none d-md-inline ms-1">Edit</span>
                                </a>
                                <a href="<?= BASE_URL ?>admin/products/delete/<?= $prod['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')" title="Hapus Barang">
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
