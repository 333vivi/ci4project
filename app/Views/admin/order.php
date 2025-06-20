<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold"><i class="fas fa-receipt"></i> Order #<?= $order['id'] ?></h2>
        </div>
    </div>
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Order Details</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6 class="fw-bold">Customer Info</h6>
                    <p class="mb-1"><i class="fas fa-user me-2"></i><?= esc($order['fullname']) ?></p>
                    <p class="mb-1"><i class="fas fa-envelope me-2"></i><?= esc($order['user']['email'] ?? '-') ?></p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i><?= esc($order['phone']) ?></p>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i><?= esc($order['address']) ?></p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Order Info</h6>
                    <p class="mb-1"><i class="fas fa-calendar me-2"></i>Order ID: <?= $order['id'] ?></p>
                    <p class="mb-1"><i class="fas fa-guitar me-2"></i>Product: <?= esc($order['guitar']['name'] ?? $order['guitar_name'] ?? '-') ?></p>
                    <p class="mb-1"><i class="fas fa-dollar-sign me-2"></i>Price: ₱<?= number_format($order['guitar']['price'] ?? 0, 2) ?></p>
                    <p class="mb-1"><i class="fas fa-boxes me-2"></i>Quantity: <?= $order['quantity'] ?></p>
                    <p class="mb-1"><i class="fas fa-money-bill-wave me-2"></i>Total: ₱<?= number_format($order['total_price'], 2) ?></p>
                    <p class="mb-1"><i class="fas fa-info-circle me-2"></i>Status: <span class="badge bg-warning text-dark"><?= esc($order['status']) ?></span></p>
                </div>
            </div>
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
            <div class="row mt-4 align-items-center">
                <div class="col-md-6">
                    <form action="<?= site_url('admin/updateOrderStatus/' . $order['id']) ?>" method="post" class="d-flex align-items-center gap-2">
                        <label for="status" class="fw-bold me-2 mb-0"><i class="fas fa-info-circle"></i> Update Status:</label>
                        <select name="status" id="status" class="form-select w-auto">
                            <?php $statuses = ['Pending', 'Processing', 'Shipped', 'Completed', 'Cancelled']; ?>
                            <?php foreach ($statuses as $status): ?>
                                <option value="<?= $status ?>" <?= $order['status'] === $status ? 'selected' : '' ?>><?= $status ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?= site_url('admin/orders') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 