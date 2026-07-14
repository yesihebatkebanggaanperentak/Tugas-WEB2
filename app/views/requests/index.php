<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1"><i class="bi bi-clipboard2-check text-primary me-2"></i> Persetujuan Permintaan Barang</h2>
        <p class="text-muted mb-0">Daftar semua permohonan logistik barang inventaris dari pengguna.</p>
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
                    <th class="ps-4 py-3">Nama Pemohon</th>
                    <th class="py-3">Barang yang Diminta</th>
                    <th class="py-3 text-center">Jumlah</th>
                    <th class="py-3">Tujuan Penggunaan</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="py-3 text-end" style="width: 240px;">Aksi Persetujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($requests) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada permohonan masuk.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($requests as $r): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?= htmlspecialchars($r['user_name'] ?? 'User Terhapus') ?></div>
                                <div class="text-muted small">ID: <?= $r['user_id'] ?></div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($r['product_name'] ?? 'Barang Terhapus') ?></div>
                                <div class="text-muted small">Stok tersisa: <span class="fw-semibold"><?= $r['product_stock'] ?? 0 ?> unit</span></div>
                            </td>
                            <td class="text-center fw-semibold"><?= $r['quantity'] ?></td>
                            <td class="small" style="max-width: 220px; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($r['purpose']) ?>">
                                <?= htmlspecialchars($r['purpose']) ?>
                            </td>
                            <td class="text-center">
                                <?php if ($r['status'] === 'pending'): ?>
                                    <span class="badge bg-warning-subtle text-warning px-2.5 py-1.5"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                <?php elseif ($r['status'] === 'approved'): ?>
                                    <span class="badge bg-success-subtle text-success px-2.5 py-1.5"><i class="bi bi-check2 me-1"></i> Disetujui</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4 text-end">
                                <?php if ($r['status'] === 'pending'): ?>
                                    <a href="<?= BASE_URL ?>admin/requests/approve/<?= $r['id'] ?>" class="btn btn-sm btn-success me-1" onclick="return confirm('Apakah Anda yakin ingin menyetujui permintaan ini? Stok barang akan dikurangi secara otomatis.')" title="Setujui">
                                        <i class="bi bi-check-lg"></i> Setujui
                                    </a>
                                    <a href="<?= BASE_URL ?>admin/requests/reject/<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menolak permintaan ini?')" title="Tolak">
                                        <i class="bi bi-x-lg"></i> Tolak
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small italic">Sudah diproses pada <?= date('d M Y', strtotime($r['created_at'])) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>
