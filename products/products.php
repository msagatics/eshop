<?php
include __DIR__ . "/../functions/functions.php";

if (!isset($title)) {
    $title = "eshop - Products";
}
include __DIR__ . "/../includes/head.php";
include __DIR__ . "/../includes/header.php";
?>

<div class="container py-5">

    <!-- Section Title -->
    <div class="text-center mb-5">

        <span class="badge bg-danger px-3 py-2 rounded-pill mb-3 shadow-sm">
            HOT OFFERS
        </span>

        <h2 class="fw-bold display-6 mb-1">
            Current Deals
        </h2>

        <p class="text-muted mx-auto" style="max-width: 600px;">
            Discover amazing products at the best prices with exclusive offers made just for you.
        </p>

        <div class="d-flex justify-content-center align-items-center">

            <div class="bg-danger rounded-pill"
                style="height:2px; width:50px;"></div>

            <div class="mx-2">
                <i class="bi bi-stars text-danger fs-5"></i>
            </div>

            <div class="bg-danger rounded-pill"
                style="height:2px; width:50px;"></div>

        </div>

    </div>

    <!-- Products Centered -->
    <div class="row justify-content-center">

        <div class="col-12 col-md-11 col-lg-10 col-xl-12 products">

            <div class="row g-4">

                <?php
                getAllProducts();
                getProductsByCategories();
                ?>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>