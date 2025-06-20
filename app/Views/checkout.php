<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold"><i class="fas fa-credit-card"></i> Checkout</h2>
            <p class="lead">Review your order before confirming.</p>
        </div>
    </div>
    <?php if (empty($cart)): ?>
        <div class="alert alert-info text-center">Your cart is empty. <a href="<?= site_url('shop') ?>">Go shopping!</a></div>
    <?php else: ?>
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $item): ?>
                        <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                        <tr>
                            <td style="width: 80px;">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= base_url('public/uploads/' . $item['image']) ?>" alt="<?= esc($item['name']) ?>" class="img-thumbnail" style="max-width: 60px;">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($item['name']) ?></td>
                            <td>₱<?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>₱<?= number_format($subtotal, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total:</th>
                        <th>₱<?= number_format($total, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <form action="<?= site_url('checkout') ?>" method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" required>
                        <label for="fullname"><i class="fas fa-user me-2"></i>Full Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" required>
                        <label for="phone"><i class="fas fa-phone me-2"></i>Phone Number</label>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-4">
                <textarea name="address" id="address" class="form-control" placeholder="Address" style="height: 80px" required></textarea>
                <label for="address"><i class="fas fa-map-marker-alt me-2"></i>Address</label>
            </div>
            <div class="text-end">
                <a href="<?= site_url('cart') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Cart</a>
                <button type="submit" class="btn btn-success ms-2"><i class="fas fa-check"></i> Confirm & Place Order</button>
            </div>
        </form>
    <?php endif; ?>
</div>
<?= $this->endSection() ?> 