<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold"><i class="fas fa-user-edit"></i> Edit User</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="<?= site_url('admin/updateUser/' . $user['id']) ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name="username" id="username" class="form-control" value="<?= esc($user['username']) ?>" required>
                            <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="role" id="role" class="form-select" required>
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <label for="role"><i class="fas fa-user-shield me-2"></i>Role</label>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= site_url('admin/users') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 