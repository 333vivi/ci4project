<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold"><i class="fas fa-shopping-cart"></i> Your Cart</h2>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (empty($cart)): ?>
        <div class="alert alert-info text-center">Your cart is empty. <a href="<?= site_url('shop') ?>">Go shopping!</a></div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
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
                            <td>
                                <form action="<?= site_url('cart/update/' . $item['id']) ?>" method="post" class="d-inline">
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stock'] ?>" class="form-control form-control-sm d-inline-block" style="width: 70px;" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>₱<?= number_format($subtotal, 2) ?></td>
                            <td>
                                <form action="<?= site_url('cart/remove/' . $item['id']) ?>" method="post" style="display:inline-block;">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total:</th>
                        <th colspan="2">₱<?= number_format($total, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-end">
            <a href="<?= site_url('shop') ?>" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
            <a href="<?= site_url('checkout') ?>" class="btn btn-success ms-2">Checkout</a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?> 