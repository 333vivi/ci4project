<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if (session()->get('role') === 'admin'): ?>
            <div class="card shadow-lg">
                <h2 class="card-title text-center mb-4 mt-3">Edit Guitar</h2>
                <form action="<?= site_url('admin/updateGuitar/' . $guitar['id']) ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="<?= esc($guitar['name']) ?>" placeholder="Guitar Name" required>
                        <label for="name"><i class="fas fa-guitar me-2"></i>Guitar Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" id="description" placeholder="Description" style="height: 100px" required><?= esc($guitar['description']) ?></textarea>
                        <label for="description"><i class="fas fa-align-left me-2"></i>Description</label>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?= esc($guitar['price']) ?>" placeholder="Price" required>
                                <label for="price"><i class="fas fa-dollar-sign me-2"></i>Price ($)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="stock" id="stock" value="<?= esc($guitar['stock']) ?>" placeholder="Stock" required>
                                <label for="stock"><i class="fas fa-boxes me-2"></i>Stock</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="brand" id="brand" value="<?= esc($guitar['brand']) ?>" placeholder="Brand" required>
                                <label for="brand"><i class="fas fa-tag me-2"></i>Brand</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="type" id="type" value="<?= esc($guitar['type']) ?>" placeholder="Type" required>
                                <label for="type"><i class="fas fa-music me-2"></i>Type</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label"><i class="fas fa-image me-2"></i>Image (leave blank to keep current)</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Dashboard</a>
                        <div>
                            <a href="<?= site_url('admin/guitars') ?>" class="btn btn-outline-danger me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Guitar</button>
                        </div>
                    </div>
                </form>
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
