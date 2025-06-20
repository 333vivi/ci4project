<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'Ligaya Guitars' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gold: #d7be69;
            --bronze: #a47e4f;
            --olive: #5c6b28;
            --dark-olive: #424a26;
            --deep-olive: #2a3019;
            --light-gold: #f5e9b8;
            --muted-gold: #bfa76a;
            --earthy-olive: #7c6f3a;
            --warm-brown: #8d6e4a;
            --very-dark-olive: #3a3f1d;
            --pale-gold: #e6d8a3;
            --soft-gold: #c9b37c;
        }
        body {
            background: var(--light-gold);
            color: var(--deep-olive);
        }
        .navbar {
            background: var(--gold) !important;
            box-shadow: 0 2px 8px rgba(66,74,38,0.08);
        }
        .navbar-brand img {
            height: 48px;
            margin-right: 12px;
        }
        .navbar-brand, .navbar-nav .nav-link, .navbar-nav .nav-link.active {
            color: var(--deep-olive) !important;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:focus {
            color: var(--olive) !important;
        }
        .content-container {
            min-height: 80vh;
        }
        .card, .table {
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(66,74,38,0.07);
        }
        .btn-primary, .btn-outline-primary {
            background: var(--olive);
            border-color: var(--olive);
            color: #fff;
        }
        .btn-primary:hover, .btn-outline-primary:hover {
            background: var(--dark-olive);
            border-color: var(--dark-olive);
        }
        .btn-success, .btn-outline-success {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--deep-olive);
        }
        .btn-success:hover, .btn-outline-success:hover {
            background: var(--bronze);
            border-color: var(--bronze);
            color: #fff;
        }
        .btn-info, .btn-outline-info {
            background: var(--muted-gold);
            border-color: var(--muted-gold);
            color: var(--deep-olive);
        }
        .btn-info:hover, .btn-outline-info:hover {
            background: var(--olive);
            border-color: var(--olive);
            color: #fff;
        }
        .btn-warning, .btn-outline-warning {
            background: var(--bronze);
            border-color: var(--bronze);
            color: #fff;
        }
        .btn-warning:hover, .btn-outline-warning:hover {
            background: var(--warm-brown);
            border-color: var(--warm-brown);
        }
        .btn-danger, .btn-outline-danger {
            background: #b94a48;
            border-color: #b94a48;
        }
        .footer {
            background: var(--deep-olive);
            color: var(--gold);
            padding: 1.5rem 0;
            text-align: center;
            margin-top: 3rem;
            border-top: 4px solid var(--bronze);
        }
        .badge {
            border-radius: 0.5rem;
            font-size: 1em;
        }
        .table-primary {
            background: var(--gold) !important;
            color: var(--deep-olive) !important;
        }
        .alert-info {
            background: var(--pale-gold);
            color: var(--deep-olive);
        }
        .alert-warning {
            background: var(--bronze);
            color: #fff;
        }
        .alert-success {
            background: var(--olive);
            color: #fff;
        }
        .alert-danger {
            background: #b94a48;
            color: #fff;
        }
        .form-control, .form-select {
            border-radius: 0.5rem;
        }
        .form-floating > label {
            color: var(--olive);
        }
        .shadow-lg {
            box-shadow: 0 4px 24px rgba(66,74,38,0.13) !important;
        }
        .nav-link.active {
            border-bottom: 2px solid var(--olive);
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
            <img src="<?= base_url('public/uploads/YHWH.png') ?>" alt="Logo">
            YHWH Guitars
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link<?= service('uri')->getSegment(2) === 'dashboard' ? ' active' : '' ?>" href="<?= site_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link<?= service('uri')->getSegment(2) === 'guitars' ? ' active' : '' ?>" href="<?= site_url('admin/guitars') ?>"><i class="fas fa-guitar"></i> Guitars</a></li>
                    <li class="nav-item"><a class="nav-link<?= service('uri')->getSegment(2) === 'users' ? ' active' : '' ?>" href="<?= site_url('admin/users') ?>"><i class="fas fa-users"></i> Users</a></li>
                    <li class="nav-item"><a class="nav-link<?= service('uri')->getSegment(2) === 'orders' ? ' active' : '' ?>" href="<?= site_url('admin/orders') ?>"><i class="fas fa-list"></i> Orders</a></li>
                <?php elseif (session()->get('role') === 'user'): ?>
                    <li class="nav-item"><a class="nav-link<?= service('uri')->getSegment(1) === 'shop' ? ' active' : '' ?>" href="<?= site_url('shop') ?>"><i class="fas fa-store"></i> Shop</a></li>
                    <li class="nav-item">
                        <a class="nav-link position-relative<?= service('uri')->getSegment(1) === 'cart' ? ' active' : '' ?>" href="<?= site_url('cart') ?>">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <?php $cart = session()->get('cart') ?? []; $cartCount = array_sum(array_column($cart, 'quantity')); ?>
                            <?php if ($cartCount > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $cartCount ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('username')): ?>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user"></i> <?= esc(session()->get('username')) ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('login') ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('register') ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container content-container py-4">
    <?= $this->renderSection('content') ?>
</div>
<footer class="footer">
    <div class="container">
        <span class="fw-bold">&copy; <?= date('Y') ?> YHWH Guitars</span> &mdash; <span>Sounds from Him, Songs to Him</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html> 