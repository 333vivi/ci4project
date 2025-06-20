<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold"><i class="fas fa-list"></i> All Orders</h2>
        </div>
    </div>
    <div class="mb-3">
        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
    <?php if (empty($orders)): ?>
        <div class="alert alert-info text-center">No orders have been placed yet.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Guitar</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= esc($order['user']['username'] ?? 'Unknown') ?></td>
                            <td><?= esc($order['guitar']['name'] ?? $order['guitar_name'] ?? 'Unknown') ?></td>
                            <td><?= $order['quantity'] ?></td>
                            <td>₱<?= number_format($order['total_price'], 2) ?></td>
                            <td>
                                <?php
                                    $status = $order['status'];
                                    $badgeClass = [
                                        'Pending' => 'secondary',
                                        'Processing' => 'info',
                                        'Shipped' => 'primary',
                                        'Completed' => 'success',
                                        'Cancelled' => 'danger',
                                    ][$status] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?= $badgeClass ?>"><?= esc($status) ?></span>
                            </td>
                            <td><?= esc($order['fullname']) ?></td>
                            <td><?= esc($order['address']) ?></td>
                            <td><?= esc($order['phone']) ?></td>
                            <td>
                                <a href="<?= site_url('admin/order/' . $order['id']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?> 