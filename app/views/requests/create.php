<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-send-fill me-2"></i> Form Permintaan Barang</h3>
                <a href="<?= BASE_URL ?>dashboard" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
            <?php endif; ?>

            <div class="card p-3 border shadow-none bg-light mb-4 d-flex flex-row align-items-center">
                <div class="bg-white rounded d-flex align-items-center justify-content-center text-muted me-3 shadow-sm border" style="width: 70px; height: 70px; flex-shrink: 0;">
                    <?php if (!empty($product['image']) && file_exists(BASE_PATH . 'public/uploads/' . $product['image'])): ?>
                        <img src="<?= BASE_URL ?>public/uploads/<?= $product['image'] ?>" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 100%;" alt="<?= htmlspecialchars($product['name']) ?>">
                    <?php else: ?>
                        <i class="bi bi-box-seam fs-3 text-primary"></i>
                    <?php endif; ?>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($product['name']) ?></h5>
                    <p class="text-muted small mb-0">
                        Kategori: <span class="fw-semibold text-secondary"><?= htmlspecialchars($product['category_name'] ?? 'Tanpa Kategori') ?></span> &nbsp;|&nbsp;
                        Stok Tersedia: <span class="fw-bold text-success"><?= $product['stock'] ?> unit</span>
                    </p>
                </div>
            </div>

            <form action="<?= BASE_URL ?>requests/create/<?= $product['id'] ?>" method="POST">
                <div class="mb-3">
                    <label for="quantity" class="form-label fw-medium">Jumlah yang Diminta</label>
                    <div class="input-group" style="max-width: 200px;">
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="<?= $product['stock'] ?>" value="<?= isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '1' ?>" required>
                        <span class="input-group-text bg-light text-muted">unit</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="purpose" class="form-label fw-medium">Tujuan / Alasan Permintaan</label>
                    <textarea name="purpose" id="purpose" class="form-control" rows="4" placeholder="Jelaskan secara spesifik tujuan penggunaan barang ini..." required><?= isset($_POST['purpose']) ? htmlspecialchars($_POST['purpose']) : '' ?></textarea>
                    <div class="form-text small text-muted">Permintaan ini akan diteruskan ke Admin untuk proses approval. Alamat pengiriman Anda yang tercatat di profil akan otomatis terlampir.</div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2.5 fw-bold"><i class="bi bi-send-check-fill me-2"></i> Kirim Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
