<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-12 mb-4">
        <h2 class="fw-bold"><i class="bi bi-speedometer2 text-primary me-2"></i> Dashboard Admin</h2>
        <p class="text-muted">Selamat datang kembali di panel administrasi InventoryHub.</p>
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
    <!-- Stat Card: Users -->
    <div class="col-md-3 mb-4">
        <div class="card p-4 border-0 shadow-sm stat-card bg-primary text-white position-relative overflow-hidden">
            <div class="position-absolute bg-white opacity-10 rounded-circle" style="width: 150px; height: 150px; top: -30px; right: -30px;"></div>
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-people-fill fs-1 me-3"></i>
                <div>
                    <h5 class="mb-0 opacity-75">Total User</h5>
                    <h2 class="fw-bold mb-0"><?= $usersCount ?></h2>
                </div>
            </div>
            <a href="<?= BASE_URL ?>admin/users" class="text-white text-decoration-none small d-flex align-items-center mt-2">
                <span>Kelola User</span>
                <i class="bi bi-arrow-right-short ms-1 fs-5"></i>
            </a>
        </div>
    </div>

    <!-- Stat Card: Products -->
    <div class="col-md-3 mb-4">
        <div class="card p-4 border-0 shadow-sm stat-card bg-success text-white position-relative overflow-hidden">
            <div class="position-absolute bg-white opacity-10 rounded-circle" style="width: 150px; height: 150px; top: -30px; right: -30px;"></div>
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-box-seam fs-1 me-3"></i>
                <div>
                    <h5 class="mb-0 opacity-75">Total Barang</h5>
                    <h2 class="fw-bold mb-0"><?= $productsCount ?></h2>
                </div>
            </div>
            <a href="<?= BASE_URL ?>admin/products" class="text-white text-decoration-none small d-flex align-items-center mt-2">
                <span>Kelola Barang</span>
                <i class="bi bi-arrow-right-short ms-1 fs-5"></i>
            </a>
        </div>
    </div>

    <!-- Stat Card: Categories -->
    <div class="col-md-3 mb-4">
        <div class="card p-4 border-0 shadow-sm stat-card bg-warning text-white position-relative overflow-hidden">
            <div class="position-absolute bg-white opacity-10 rounded-circle" style="width: 150px; height: 150px; top: -30px; right: -30px;"></div>
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-tags-fill fs-1 me-3"></i>
                <div>
                    <h5 class="mb-0 opacity-75">Total Kategori</h5>
                    <h2 class="fw-bold mb-0"><?= $categoriesCount ?></h2>
                </div>
            </div>
            <a href="<?= BASE_URL ?>admin/categories" class="text-white text-decoration-none small d-flex align-items-center mt-2">
                <span>Kelola Kategori</span>
                <i class="bi bi-arrow-right-short ms-1 fs-5"></i>
            </a>
        </div>
    </div>

    <!-- Stat Card: Pending Requests -->
    <div class="col-md-3 mb-4">
        <div class="card p-4 border-0 shadow-sm stat-card bg-danger text-white position-relative overflow-hidden">
            <div class="position-absolute bg-white opacity-10 rounded-circle" style="width: 150px; height: 150px; top: -30px; right: -30px;"></div>
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-clipboard2-check-fill fs-1 me-3"></i>
                <div>
                    <h5 class="mb-0 opacity-75">Pending Request</h5>
                    <h2 class="fw-bold mb-0"><?= $pendingCount ?></h2>
                </div>
            </div>
            <a href="<?= BASE_URL ?>admin/requests" class="text-white text-decoration-none small d-flex align-items-center mt-2">
                <span>Persetujuan Request</span>
                <i class="bi bi-arrow-right-short ms-1 fs-5"></i>
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card p-4 border-0 shadow-sm">
            <h5 class="fw-bold mb-3"><i class="bi bi-gear me-2 text-primary"></i> Pintasan Aksi Cepat</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= BASE_URL ?>admin/products/create" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i> Tambah Barang Baru</a>
                <a href="<?= BASE_URL ?>admin/categories/create" class="btn btn-warning text-white"><i class="bi bi-tag me-2"></i> Tambah Kategori Baru</a>
                <a href="<?= BASE_URL ?>admin/users/create" class="btn btn-outline-primary"><i class="bi bi-person-plus me-2"></i> Tambah User Baru</a>
                <a href="<?= BASE_URL ?>admin/requests" class="btn btn-outline-danger"><i class="bi bi-card-checklist me-2"></i> Cek Semua Permintaan</a>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>
