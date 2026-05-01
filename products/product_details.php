<?php
include __DIR__ . "/../functions/functions.php";

if (!isset($title)) {
    $title = "eshop - Product Details";
}
include __DIR__ . "/../includes/head.php";
include __DIR__ . "/../includes/header.php";
?>

<div class="container d-flex flex-column justify-content-center">
    <div class="container product-banner text-center mx-auto position-relative my-5">
        <h2 class="fw-bold mb-0 px-2 d-inline-block bg-white position-relative">
                Product Details
        </h2>
    </div>

    <div class="container">
        <div class="row">
            <?php productDetails(); ?>
        </div>
    </div>

</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>