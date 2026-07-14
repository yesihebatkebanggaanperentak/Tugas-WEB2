<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-box-seam-fill me-2"></i> Tambah Barang Baru</h3>
                <a href="<?= BASE_URL ?>admin/products" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>admin/products/create" method="POST" enctype="multipart/form-data">
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label for="name" class="form-label fw-medium">Nama Barang</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Laptop Asus, Proyektor Epson" required value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="stock" class="form-label fw-medium">Jumlah Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control" min="0" placeholder="0" required value="<?= isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : '0' ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-medium">Kategori Barang</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-medium">Deskripsi Barang (Opsional)</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Detail spesifikasi barang, nomor seri, kondisi barang, dll..."><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-medium">Foto Barang <span class="text-muted small fw-normal">(Maksimal 2MB, Ekstensi: Gambar/PDF)</span></label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*,application/pdf">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-save me-2"></i> Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
