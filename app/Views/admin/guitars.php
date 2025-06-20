<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php if (session()->get('role') === 'admin'): ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h2 class="mb-0">Manage Guitars</h2>
                    <a href="<?= site_url('shop') ?>" class="btn btn-outline-light btn-sm"><i class="fas fa-store"></i> View Shop Page</a>
                </div>
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <a href="<?= site_url('admin/addGuitar') ?>" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i> Add New Guitar
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th>Image</th>
                                    <th style="min-width:140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($guitars as $guitar): ?>
                                    <tr>
                                        <td><?= $guitar['id'] ?></td>
                                        <td><?= esc($guitar['name']) ?></td>
                                        <td><?= esc($guitar['description']) ?></td>
                                        <td>$<?= number_format($guitar['price'], 2) ?></td>
                                        <td><?= $guitar['stock'] ?></td>
                                        <td><?= esc($guitar['brand']) ?></td>
                                        <td><?= esc($guitar['type']) ?></td>
                                        <td>
                                            <?php if (!empty($guitar['image'])): ?>
                                                <img src="<?= base_url('public/uploads/' . $guitar['image']) ?>" alt="Guitar Image" class="guitar-img rounded shadow-sm" style="max-width:80px;max-height:60px;">
                                            <?php else: ?>
                                                <span class="text-muted">No Image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('admin/editGuitar/' . $guitar['id']) ?>" class="btn btn-warning btn-sm mb-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="<?= site_url('admin/deleteGuitar/' . $guitar['id']) ?>" method="post" style="display:inline;">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this guitar?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-danger mt-5">Access restricted. You do not have admin privileges.</div>
            <a href="<?= site_url('logout') ?>" class="btn btn-danger mt-3">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
