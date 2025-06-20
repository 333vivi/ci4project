<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Register</h2>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= implode('<br>', $validation) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('registerSubmit') ?>" method="POST" autocomplete="off">
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="username" value="<?= old('username') ?>" placeholder="Username" required>
                <label for="username"><i class="fas fa-user me-2"></i>Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" value="<?= old('email') ?>" placeholder="Email" required>
                <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-user-plus me-2"></i>Register</button>
        </form>
        <div class="mt-3 text-center">
            <p>Already have an account? <a href="<?= site_url('login') ?>">Login</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
