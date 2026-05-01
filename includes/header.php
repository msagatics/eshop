<?php
include __DIR__ . "/head.php";
?>

<div class="container sticky-top">
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-expand-lg rounded-bottom px-2 mt-0" style="background-color: #f1f0ee;">
                <div class="container-fluid">
                    <a class="navbar-brand eshop-logo" href="index.php">
                        <img src="<?php echo BASE_URL; ?>eshop-logo/logo.png" alt="eshop" class="d-inline-block img-fluid" style="width: 80px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!--Navigation Items-->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">My Account</a>
                            </li>
                            <li class="nav-item me-2">
                                <a href="#" class="nav-link position-relative d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-arrow-down fs-5"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill" style="font-size: 10px;">
                                        0
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Total: Tsh 0/=</a>
                            </li>
                        </ul>
                        <div class="search-wrapper me-3">
                            <i class="bi bi-search toggle-search"></i>

                            <div class="search-box shadow">
                                <form>
                                    <input
                                        type="search"
                                        class="form-control"
                                        placeholder="Search products...">
                                </form>
                            </div>
                        </div>
                        <div class="text-center d-flex justify-content-center gap-2 flex-wrap">
                            <a href="#" class="btn btn-outline-success py-1 px-2" style="font-size: 15px;">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Sign in
                            </a>
                            <a href="#" class="btn btn-primary py-1 px-2" style="font-size: 15px;">
                                <i class="bi bi-person-plus me-1"></i> Sign up
                            </a>
                            <a href="#" class="btn btn-outline-danger py-1 px-2" style="font-size: 15px;">
                                <i class="bi bi-box-arrow-left me-1"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<script>
    const wrapper = document.querySelector('.search-wrapper');
    const toggle = document.querySelector('.toggle-search');

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        wrapper.classList.toggle('active');
        wrapper.querySelector('input').focus();
    });

    document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target)) {
            wrapper.classList.remove('active');
        }
    });
</script>