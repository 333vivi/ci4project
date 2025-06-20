<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4" style="background:#fff; border-radius:1.2rem; box-shadow:0 2px 12px rgba(66,74,38,0.07);">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold"><i class="fas fa-users"></i> All Users</h2>
        </div>
    </div>
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <form class="d-flex" method="get" action="<?= site_url('admin/users') ?>">
            <input type="text" name="q" class="form-control me-2" placeholder="Search by username, email, or role" value="<?= esc($_GET['q'] ?? '') ?>">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
        </form>
    </div>
    <?php if (empty($users)): ?>
        <div class="alert alert-info text-center">No users found.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered</th>
                        <th style="min-width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><span class="badge bg-<?= $user['role'] === 'admin' ? 'primary' : 'secondary' ?> text-capitalize"><?= esc($user['role']) ?></span></td>
                            <td><?= isset($user['created_at']) ? esc($user['created_at']) : '-' ?></td>
                            <td>
                                <a href="<?= site_url('admin/editUser/' . $user['id']) ?>" class="btn btn-warning btn-sm mb-1"><i class="fas fa-edit"></i> Edit</a>
                                <a href="<?= site_url('admin/deleteUser/' . $user['id']) ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?> 