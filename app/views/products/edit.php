<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-pencil-square me-2"></i> Edit Barang</h3>
                <a href="<?= BASE_URL ?>admin/products" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>admin/products/edit/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label for="name" class="form-label fw-medium">Nama Barang</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="stock" class="form-label fw-medium">Jumlah Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?= htmlspecialchars($product['stock']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-medium">Kategori Barang</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-medium">Deskripsi Barang (Opsional)</label>
                    <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium d-block">Foto Saat Ini</label>
                    <?php if (!empty($product['image']) && file_exists(BASE_PATH . 'public/uploads/' . $product['image'])): ?>
                        <div class="mb-2">
                            <img src="<?= BASE_URL ?>public/uploads/<?= $product['image'] ?>" class="img-thumbnail rounded" style="max-width: 150px; max-height: 150px; object-fit: cover;" alt="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                    <?php else: ?>
                        <p class="text-muted small">Tidak ada foto.</p>
                    <?php endif; ?>
                    <label for="image" class="form-label fw-medium mt-2">Ganti Foto <span class="text-muted small fw-normal">(Maksimal 2MB, Ekstensi: Gambar/PDF)</span></label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*,application/pdf">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
