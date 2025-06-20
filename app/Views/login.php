<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <img src="<?= base_url('jeffb.png') ?>" alt="Logo" class="img-fluid" style="max-width: 180px;">
        </div>
        <h2 class="text-center mb-4">Login</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('loginSubmit') ?>" method="POST" autocomplete="off">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-sign-in-alt me-2"></i>Login</button>
        </form>
        <div class="mt-3 text-center">
            <p>Don't have an account? <a href="<?= site_url('register') ?>">Register</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
