<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="text-center py-5">
    <i class="bi bi-exclamation-triangle display-1 text-warning mb-4"></i>
    <h1 class="display-5 fw-bold">404 - Halaman Tidak Ditemukan</h1>
    <p class="lead text-muted mb-4">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
    <a href="<?= BASE_URL ?>" class="btn btn-primary btn-lg"><i class="bi bi-house me-2"></i> Kembali ke Beranda</a>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
