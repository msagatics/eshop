<?php
include __DIR__ . "/../functions/functions.php";
define('BASE_URL', '/eshop/');

if (!isset($title)) {
    $title = "eshop - Product Details";
}
include __DIR__ . "/../includes/head.php";
include __DIR__ . "/../includes/header.php";
?>

<div class="container d-flex flex-column justify-content-center mt-3">
   <div class="container my-5">
    <div class="product-banner text-center mx-auto position-relative">
        
        <h2 class="fw-bold mb-0 px-4 d-inline-block bg-white position-relative">
            Product Details
        </h2>

    </div>
</div>
<div class="container">
    <div class="row">
        <?php productDetails(); ?>
    </div>
</div>

</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>