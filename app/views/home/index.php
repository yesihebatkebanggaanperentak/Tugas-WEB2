<?php require_once BASE_PATH . 'app/views/layouts/header.php'; ?>

<div class="row align-items-center py-5">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-4 fw-bold lh-1 mb-3 text-primary">Kelola Inventaris Anda Lebih Mudah & Efisien</h1>
        <p class="lead text-muted mb-4">InventoryHub adalah platform manajemen inventaris barang modern untuk perusahaan dan instansi Anda. Pantau status ketersediaan barang secara realtime dan kelola permintaan dengan cepat.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="<?= BASE_URL ?>dashboard" class="btn btn-primary btn-lg px-4 me-md-2"><i class="bi bi-speedometer2 me-2"></i> Ke Dashboard</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>login" class="btn btn-primary btn-lg px-4 me-md-2"><i class="bi bi-box-arrow-in-right me-2"></i> Mulai Sekarang</a>
                <a href="<?= BASE_URL ?>register" class="btn btn-outline-secondary btn-lg px-4"><i class="bi bi-person-plus me-2"></i> Buat Akun</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-6 text-center">
        <div class="card p-4 bg-primary text-white border-0 shadow-lg position-relative overflow-hidden" style="min-height: 350px; display: flex; flex-direction: column; justify-content: center;">
            <!-- Background circles decoration -->
            <div class="position-absolute bg-white opacity-10 rounded-circle" style="width: 250px; height: 250px; top: -50px; right: -50px;"></div>
            <div class="position-absolute bg-white opacity-10 rounded-circle" style="width: 150px; height: 150px; bottom: -30px; left: -30px;"></div>
            
            <i class="bi bi-box-seam display-1 mb-3"></i>
            <h3 class="fw-bold">Fitur Alamat User Aktif!</h3>
            <p class="mx-auto" style="max-width: 400px;">Setiap pengguna kini dapat menyimpan alamat terstruktur (Jalan, Kota, Provinsi, Kode Pos) untuk kelancaran pengiriman atau verifikasi distribusi inventaris barang.</p>
        </div>
    </div>
</div>

<div class="row text-center mt-5 py-4 border-top">
    <div class="col-md-4 mb-4">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="fs-1 text-primary mb-3"><i class="bi bi-shield-check"></i></div>
            <h5 class="fw-bold">Autentikasi Aman</h5>
            <p class="text-muted mb-0">Proteksi data login dengan enkripsi password standar industri demi keamanan akun Anda.</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="fs-1 text-primary mb-3"><i class="bi bi-geo-alt"></i></div>
            <h5 class="fw-bold">Alamat Terstruktur</h5>
            <p class="text-muted mb-0">Simpan info alamat lengkap yang terbagi atas kolom detail jalan, kota, provinsi, dan kode pos.</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card p-4 h-100 border-0 shadow-sm">
            <div class="fs-1 text-primary mb-3"><i class="bi bi-gear-wide-connected"></i></div>
            <h5 class="fw-bold">Panel Admin</h5>
            <p class="text-muted mb-0">Admin dapat dengan mudah memantau dan mengelola seluruh data user beserta detail alamat mereka.</p>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . 'app/views/layouts/footer.php'; ?>