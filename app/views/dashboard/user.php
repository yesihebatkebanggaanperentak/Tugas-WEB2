<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold"><i class="bi bi-speedometer2 text-primary me-2"></i> Dashboard User</h2>
        <p class="text-muted">Selamat datang di InventoryHub. Ajukan dan pantau permintaan inventaris Anda di sini.</p>
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

<div class="row">
    <div class="col-md-4 mb-4">
        <!-- User Profile Card -->
        <div class="card p-4 border-0 shadow-sm text-center mb-4">
            <div class="mb-3 position-relative d-inline-block mx-auto">
                <i class="bi bi-person-circle display-1 text-primary"></i>
            </div>
            <h4 class="fw-bold mb-1"><?= htmlspecialchars($user['username']) ?></h4>
            <p class="text-muted small mb-3"><?= htmlspecialchars($user['email']) ?></p>
            <span class="badge bg-light text-primary px-3 py-2 rounded-pill border mb-3">Role: User Biasa</span>
            
            <hr class="w-100">
            
            <a href="<?= BASE_URL ?>profile" class="btn btn-outline-primary btn-sm w-100 py-2"><i class="bi bi-pencil-square me-2"></i> Ubah Profil & Alamat</a>
        </div>

        <!-- Address Status Card -->
        <div class="card p-4 border-0 shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-geo-alt-fill text-primary fs-3 me-2"></i>
                <h5 class="fw-bold mb-0">Alamat Pengiriman</h5>
            </div>
            
            <?php if (empty($user['address_street']) || empty($user['address_city'])): ?>
                <div class="alert alert-warning d-flex align-items-center mb-0" role="alert">
                    <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                    <div class="small">Alamat belum lengkap! Anda harus melengkapi alamat di menu <a href="<?= BASE_URL ?>profile" class="alert-link">Ubah Profil</a> sebelum mengajukan permintaan barang.</div>
                </div>
            <?php else: ?>
                <div class="bg-light p-3 rounded border">
                    <div class="small mb-1 text-muted">Jalan / Detail:</div>
                    <div class="fw-semibold mb-2 text-dark"><?= htmlspecialchars($user['address_street']) ?></div>
                    <div class="row g-2">
                        <div class="col-6">
                            <span class="small text-muted d-block">Kota:</span>
                            <span class="fw-semibold text-dark text-truncate d-inline-block w-100"><?= htmlspecialchars($user['address_city']) ?></span>
                        </div>
                        <div class="col-6">
                            <span class="small text-muted d-block">Provinsi:</span>
                            <span class="fw-semibold text-dark text-truncate d-inline-block w-100"><?= htmlspecialchars($user['address_province'] ?? '') ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Products Catalog -->
        <div class="card p-4 border-0 shadow-sm mb-4">
            <h4 class="fw-bold mb-3 text-dark"><i class="bi bi-grid-fill text-primary me-2"></i> Katalog Inventaris Tersedia</h4>
            <p class="text-muted small">Pilih barang di bawah ini untuk mengajukan permintaan penggunaan logistik.</p>

            <div class="row g-3">
                <?php if (count($products) === 0): ?>
                    <div class="col-12 py-4 text-center text-muted">Tidak ada barang inventaris tersedia.</div>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <div class="col-md-6">
                            <div class="card h-100 border shadow-none hover-shadow transition-all">
                                <div class="row g-0 h-100">
                                    <div class="col-4 bg-light d-flex align-items-center justify-content-center border-end" style="min-height: 120px;">
                                        <?php if (!empty($p['image']) && file_exists(BASE_PATH . 'public/uploads/' . $p['image'])): ?>
                                            <img src="<?= BASE_URL ?>public/uploads/<?= $p['image'] ?>" class="img-fluid rounded-start h-100 w-100 object-fit-cover" style="max-height: 120px;" alt="<?= htmlspecialchars($p['name']) ?>">
                                        <?php else: ?>
                                            <i class="bi bi-image text-muted display-6"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-3 d-flex flex-column h-100">
                                            <span class="badge bg-secondary-subtle text-secondary small align-self-start mb-1"><?= htmlspecialchars($p['category_name'] ?? 'Tanpa Kategori') ?></span>
                                            <h6 class="fw-bold mb-1 text-dark text-truncate" title="<?= htmlspecialchars($p['name']) ?>"><?= htmlspecialchars($p['name']) ?></h6>
                                            <p class="card-text text-muted small mb-2 text-truncate-2"><?= htmlspecialchars($p['description'] ?? 'Tidak ada deskripsi.') ?></p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <div class="small">
                                                    Stok: 
                                                    <?php if ($p['stock'] > 0): ?>
                                                        <span class="fw-bold text-success"><?= $p['stock'] ?> unit</span>
                                                    <?php else: ?>
                                                        <span class="fw-bold text-danger">Habis</span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($p['stock'] > 0 && !empty($user['address_street']) && !empty($user['address_city'])): ?>
                                                    <a href="<?= BASE_URL ?>requests/create/<?= $p['id'] ?>" class="btn btn-sm btn-primary py-1 px-2.5">Request</a>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-secondary py-1 px-2.5" disabled>Request</button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Request History -->
        <div class="card p-4 border-0 shadow-sm">
            <h4 class="fw-bold mb-3 text-dark"><i class="bi bi-clock-history text-primary me-2"></i> Riwayat Permintaan Saya</h4>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-muted">
                        <tr>
                            <th class="py-2.5">Barang</th>
                            <th class="py-2.5 text-center">Jumlah</th>
                            <th class="py-2.5">Tujuan</th>
                            <th class="py-2.5 text-center">Status</th>
                            <th class="py-2.5 text-end">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($requests) === 0): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted small">Anda belum pernah mengajukan permintaan.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($requests as $r): ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($r['product_name'] ?? 'Barang Terhapus') ?></div>
                                    </td>
                                    <td class="text-center fw-semibold"><?= $r['quantity'] ?></td>
                                    <td class="text-truncate small" style="max-width: 150px;" title="<?= htmlspecialchars($r['purpose']) ?>"><?= htmlspecialchars($r['purpose']) ?></td>
                                    <td class="text-center">
                                        <?php if ($r['status'] === 'pending'): ?>
                                            <span class="badge bg-warning-subtle text-warning px-2.5 py-1.5"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                        <?php elseif ($r['status'] === 'approved'): ?>
                                            <span class="badge bg-success-subtle text-success px-2.5 py-1.5"><i class="bi bi-check2 me-1"></i> Disetujui</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end small text-muted"><?= date('d M Y, H:i', strtotime($r['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
}
.transition-all {
    transition: all 0.2s ease;
}
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    white-space: normal;
}
</style>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
