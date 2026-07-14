<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-pencil-square me-2"></i> Edit Kategori</h3>
                <a href="<?= BASE_URL ?>admin/categories" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>admin/categories/edit/<?= $category['id'] ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label fw-medium">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($category['name']) ?>" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-medium">Deskripsi Kategori (Opsional)</label>
                    <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
