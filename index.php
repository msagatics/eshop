<?php
include __DIR__ . "/functions/functions.php";
define('BASE_URL', '/eshop/');

if (!isset($title)) {
    $title = "eshop - Home";
}

include __DIR__ . "/includes/head.php";
include __DIR__ . "/includes/header.php";

?>

<div class="container">

    <div class="container-fluid position-relative text-white rounded mt-3 overflow-hidden p-0" style="min-height: 65vh;">

        <!-- 🎥 Background Video -->
        <video id="heroVideo" autoplay muted loop playsinline
            class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
            <source src="eshop-slide/slideshow_1.mp4" type="video/mp4">
        </video>

        <!-- 🌈 Gradient Overlay (better than flat dark) -->
        <div class="position-absolute top-0 start-0 w-100 h-100 
        bg-dark bg-opacity-75"></div>

        <!-- 📝 Content (Bottom Left, Styled) -->
        <div class="position-absolute bottom-0 start-0 p-4 p-md-5 text-start" style="max-width: 600px;">

            <span class="badge bg-danger mb-3 px-3 py-2">New Collection</span>

            <h1 class="fw-bold display-5 lh-sm">
                Find the perfect <br> product for you
            </h1>

            <p class="lead opacity-75" style="font-size: 16px;">
                Discover quality items at the best prices. Simple, fast, and reliable shopping.
            </p>

            <div class="mt-3 d-flex gap-2">
                <a href="#" class="btn btn-primary py-1 px-4">Shop Now</a>
                <a href="#" class="btn btn-outline-light py-1 px-4">Browse</a>
            </div>

        </div>

    </div>

    <script>
        const video = document.getElementById('heroVideo');
        video.addEventListener('loadeddata', () => {
            video.playbackRate = 0.7; // smoother cinematic feel
        });
    </script>

    <div class="container my-3 p-0">
        <div class="row p-0">

            <div class="container py-4 text-center bg-body-tertiary">

                <div class="d-flex align-items-center justify-content-center">
                    <div style="height:2px; width:80px; background:#db3e4d;"></div>

                    <h2 class="fw-bold mx-3 mb-0" style="color:#db3e4d;">
                        Discover What You Love
                    </h2>

                    <div style="height:2px; width:80px; background:#db3e4d;"></div>
                </div>

                <p class="text-muted mt-1 mb-0">
                    Explore Our Collection
                </p>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-md-4 col-lg-3 col-xl-2 mt-4 p-0">
                <div class="sidebar">
                    <div class="bg-body-tertiary rounded pt-2">
                        <h5 class="fw-semibold ms-3 border-2 border-danger pb-1 border-bottom d-inline-block">Products by Category</h5>
                        <ul class=" list-unstyled category-list">
                            <?php getAllCategories(); ?>
                        </ul>
                    </div>

                    <div class="bg-body-tertiary rounded mt-4 pt-2">
                        <h5 class="fw-semibold ms-3 border-2 border-danger pb-1 border-bottom d-inline-block">Help & Settings</h5>
                        <ul class=" list-unstyled help-list">
                            <li class="ps-3 py-2 rounded"><i class="bi bi-gear me-1"></i>Your Account</li>
                            <li class="ps-3 py-2 rounded"><i class="bi bi-translate text-primary me-2"></i>English</li>
                            <li class="ps-3 py-2 rounded">🇹🇿 Tanzania</li>
                            <li class="ps-3 py-2 rounded"><i class="bi bi-headset text-primary me-2"></i>Customer Service</li>
                            <li class="ps-3 py-2 rounded"><i class="bi bi-box-arrow-in-right text-success me-2"></i>Sign In</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-12 col-md-8 col-lg-9 col-xl-10 mt-4 products">
                <div class="row">
                    <?php
                    getAllProducts();
                    getProductsByCategories();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
