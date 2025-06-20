<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <?php if (!empty($admin_alert)): ?>
        <div class="alert alert-warning alert-dismissible fade show shadow-lg mb-4" role="alert" style="font-size:1.2rem;">
            <i class="fas fa-bell fa-shake me-2"></i> <strong>Notification:</strong> <?= $admin_alert ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold display-5">Welcome, <?= esc(session()->get('username')) ?>!</h2>
            <p class="lead">This is your admin dashboard. Manage your shop and monitor activity below.</p>
        </div>
    </div>
    <div class="row mb-4 justify-content-center g-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow h-100 text-bg-primary">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-2"></i>
                    <h5 class="card-title">Users</h5>
                    <p class="card-text fs-2 fw-bold mb-0"><?= $userCount ?></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow h-100 text-bg-success">
                <div class="card-body text-center">
                    <i class="fas fa-guitar fa-3x mb-2"></i>
                    <h5 class="card-title">Guitars</h5>
                    <p class="card-text fs-2 fw-bold mb-0"><?= $guitarCount ?></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow h-100 text-bg-warning">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x mb-2"></i>
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text fs-2 fw-bold mb-0"><?= $orderCount ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8 col-md-10">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">Quick Actions</h4>
                </div>
                <div class="card-body text-center">
                    <a href="<?= site_url('admin/guitars') ?>" class="btn btn-lg btn-outline-primary mb-3 me-2">
                        <i class="fas fa-guitar"></i> Manage Guitars
                    </a>
                    <a href="<?= site_url('admin/users') ?>" class="btn btn-lg btn-outline-info mb-3 me-2">
                        <i class="fas fa-users"></i> View Users
                    </a>
                    <a href="<?= site_url('admin/orders') ?>" class="btn btn-lg btn-outline-warning mb-3 me-2">
                        <i class="fas fa-list"></i> View Orders
                    </a>
                    <a href="<?= site_url('logout') ?>" class="btn btn-lg btn-outline-danger mb-3">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
