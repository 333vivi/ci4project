<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row shop-header mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold" style="color:var(--olive)">Welcome to the Shop!</h1>
            <p class="lead" style="color:var(--bronze)">Browse and purchase your favorite guitars.</p>
        </div>
    </div>
    <div class="row g-4 justify-content-center">
        <?php if (!empty($guitars)): ?>
            <?php foreach ($guitars as $guitar): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-lg border-0" style="background:var(--pale-gold); transition:transform .15s; border-radius:1.2rem;">
                        <?php if (!empty($guitar['image'])): ?>
                            <img src="<?= base_url('public/uploads/' . $guitar['image']) ?>" class="card-img-top p-2 rounded-4" alt="<?= esc($guitar['name']) ?>" style="background:var(--soft-gold); object-fit:contain; height:180px;">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center" style="height:180px; background:var(--soft-gold); border-radius:1rem;">
                                <span class="text-muted">No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1" style="color:var(--dark-olive)"><?= esc($guitar['name']) ?></h5>
                            <p class="card-text mb-2" style="color:var(--very-dark-olive)">
                                <span class="fw-semibold">Brand:</span> <?= esc($guitar['brand']) ?><br>
                                <span class="fw-semibold">Type:</span> <?= esc($guitar['type']) ?><br>
                                <span class="fw-semibold">Stock:</span> <span class="badge bg-<?= $guitar['stock'] > 0 ? 'success' : 'danger' ?>" style="font-size:1em;"><?= $guitar['stock'] ?></span>
                            </p>
                            <div class="mt-auto d-flex align-items-center justify-content-between">
                                <span class="fw-bold fs-5" style="color:var(--olive)">₱<?= number_format($guitar['price'], 2) ?></span>
                                <form action="<?= site_url('add-to-cart/' . $guitar['id']) ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-success btn-sm px-3 py-1 rounded-pill shadow-sm" style="font-weight:600;" <?= $guitar['stock'] > 0 ? '' : 'disabled' ?>>
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-info">No guitars available at the moment. Please check back soon!</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?> 