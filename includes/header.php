<?php
include __DIR__ . "/head.php";
$current_page = basename($_SERVER['PHP_SELF']);

?>

<base href="<?php echo BASE_URL; ?>">

<div class="container top-header py-2 sticky-top">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">

        <!-- Logo -->
        <a class="navbar-brand m-0" href="index.php">
            <img src="<?= image('logo.png'); ?>"
                alt="eshop"
                class="logo-img">
        </a>

        <!-- Search -->
        <div class="header-search mx-lg-4 my-3 my-lg-0">

            <form class="search-form">

                <input type="search"
                    placeholder="Search for products">

                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>

            </form>

        </div>

        <!-- Right Actions -->
        <div class="header-actions d-flex align-items-center gap-3">

            <a href="#" class="action-link text-primary">
                <i class="bi bi-person"></i>
                <span>Sign in</span>
            </a>

            <a href="#" class="action-link">
                <i class="bi bi-box-arrow-in-left"></i>
                <span class="">Sign up</span>
            </a>

            <a href="#" class="action-link position-relative">
                <i class="bi bi-cart3"></i>

                <span class="cart-badge">
                    0
                </span>
            </a>

        </div>

    </div>

    <!--Second header-->

    <div class="category-wrapper pt-2 sticky-top">

        <div class="category-navbar">

            <!-- Header Link -->

            <a href="<?= url('index.php'); ?>"
                class="<?= ($current_page == 'index.php') ? 'active-link' : 'nav-category'; ?>">
                Home
            </a>

            <a href="<?= url('products/products.php'); ?>"
                class="<?= ($current_page == 'products.php') ? 'active-link' : 'nav-category'; ?>">
                Products
            </a>

            <!-- Electronics -->

            <div class="dropdown">

                <a href="#"
                    class="nav-category dropdown-toggle"
                    data-bs-toggle="dropdown">

                    Electronics

                </a>

                <ul class="dropdown-menu category-dropdown border-0 shadow">

                    <li>
                        <a class="dropdown-item" href="#">
                            Smartphones
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Laptops
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Gaming
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Headphones
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Fashion -->

            <div class="dropdown">

                <a href="#"
                    class="nav-category dropdown-toggle"
                    data-bs-toggle="dropdown">

                    Fashion

                </a>

                <ul class="dropdown-menu category-dropdown border-0 shadow">

                    <li>
                        <a class="dropdown-item" href="#">
                            Men's Clothing
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Women's Clothing
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Shoes
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Bags
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Normal Links -->

            <a href="#" class="nav-category">
                Automotive
            </a>

            <a href="#" class="nav-category">
                Appliances
            </a>

            <!-- MORE -->

            <div class="dropdown">

                <a href="#"
                    class="nav-category dropdown-toggle"
                    data-bs-toggle="dropdown">

                    More

                </a>

                <ul class="dropdown-menu category-dropdown border-0 shadow">

                    <li>
                        <a class="dropdown-item" href="#">
                            Beauty
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Sports
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Home Decor
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>