<?php

include __DIR__ . "/../includes/db.php";

// Detect protocol
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    ? "https://"
    : "http://";

// Host (localhost or domain)
$host = $_SERVER['HTTP_HOST'];

// Detect base project folder correctly
$script_name = $_SERVER['SCRIPT_NAME'];
$project_folder = explode('/', trim($script_name, '/'))[0];

// Final base URL
define('BASE_URL', $protocol . $host . '/' . $project_folder . '/');

// Helper for URLs
function url($path = '')
{
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

function asset($path = '')
{
    return url('assets/' . ltrim($path, '/'));
}

function image($file = '')
{
    return asset('images/' . ltrim($file, '/'));
}

//Get All Categories from Database

function getAllCategories()
{
    global $conn;

    // 1. Write SQL (no variables yet)
    $sql = "SELECT category_id, category_title FROM categories";

    // 2. Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // 3. Execute it
    mysqli_stmt_execute($stmt);

    // 4. Get the result
    $result = mysqli_stmt_get_result($stmt);

    // 5. Loop through results
    while ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
?>

        <li class="ps-3 py-2 rounded">
            <a href="<?= url('index.php?category_id=' . $category_id); ?>"
                class="text-decoration-none d-block w-100 text-dark">
                <?= $category_title ?>
            </a>
        </li>

        <?php
    }

    // 6. Close the statement
    mysqli_stmt_close($stmt);
}

// Display Products to Homepage

function getAllProducts()
{
    global $conn;

    if (!isset($_GET['category_id']) && !isset($_GET['product_id'])) {

        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 0,12";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
        ?>

            <div class="col-md-3 col-sm-6">
                <div class="card product-card h-100 shadow-sm">
                    <img src="<?= image('products/' . $product_image); ?>" class="card-img-top">
                    <div class="card-body p-2">
                        <span class="badge bg-warning text-dark">Choice</span>
                        <span class="badge bg-danger">Sale</span>

                        <h6 class="mt-2 mb-1"><?= $product_title ?></h6>

                        <div class="price">Tsh: <?= number_format($product_price, 2) ?></div>
                        <div class="old-price">TZS31,953.67</div>
                        <div class="discount">Save TZS25,038.72</div>

                        <div class="rating">⭐⭐⭐⭐☆ 4.1 | 100K+ sold</div>

                        <div class="card_footer mt-2">
                            <a href="<?= url('index.php?product_id=' . $product_id); ?>" class="btn cart-btn py-1 px-2"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</a>
                            <a href="<?= url('products/product_details.php?product_id=' . $product_id); ?>" class="btn eye-btn"><i class="bi bi-eye-fill"></i>View</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        }
        mysqli_stmt_close($stmt);
    }
}

//Display products in according to Categories

function getProductsByCategories()
{
    global $conn;

    if (isset($_GET['category_id'])) {
        $category_id = intval($_GET['category_id']);

        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $category_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image = $row['product_image'];
                $product_price = $row['product_price'];
            ?>

                <div class="col-md-3 col-sm-6">
                    <div class="card product-card h-100 shadow-sm">
                        <img src="<?= image('products/' . $product_image); ?>" class="card-img-top">
                        <div class="card-body p-2">
                            <span class="badge bg-warning text-dark">Choice</span>
                            <span class="badge bg-danger">Sale</span>

                            <h6 class="mt-2 mb-1"><?= $product_title ?></h6>

                            <div class="price">Tsh: <?= number_format($product_price, 2) ?></div>
                            <div class="old-price">TZS31,953.67</div>
                            <div class="discount">Save TZS25,038.72</div>

                            <div class="rating">⭐⭐⭐⭐☆ 4.1 | 100K+ sold</div>

                            <div class="card_footer mt-2">
                            <a href="<?= url('index.php?product_id=' . $product_id); ?>" class="btn cart-btn py-1 px-2"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</a>
                            <a href="<?= url('products/product_details.php?product_id=' . $product_id); ?>" class="btn eye-btn"><i class="bi bi-eye-fill"></i>View</a>
                        </div>
                        </div>
                    </div>
                </div>

            <?php
            }
        } else {
            ?>
            <div class="col-12 d-flex justify-content-center mt-2">
                <div class="card border-0 shadow-lg text-center p-4" style="max-width:420px; background: linear-gradient(135deg, #ff4d4d, #c70039); color: #fff; border-radius: 15px;"> <i class="bi bi-exclamation-circle-fill" style="font-size:55px;"></i>
                    <h4 class="mt-3 mb-0 fw-bold">No Products Found</h4>
                    <p class="mb-3">This category is empty right now.</p> <a href="index.php" class="btn btn-light fw-semibold px-2"> <i class="bi bi-arrow-left me-2"></i>Back to Shop </a>
                </div>
            </div>
            <?php showRelatedProducts($category_id); ?>
        <?php
        }

        mysqli_stmt_close($stmt);
    }
}

//Showing related products

function showRelatedProducts($category_id)
{
    global $conn;

    // show products from OTHER categories
    $sql = "SELECT * FROM products WHERE category_id != ? ORDER BY RAND() LIMIT 0,6";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        ?>
        <div class='col-12 mt-5 mb-4'>
            <div class='d-flex align-items-center justify-content-center'>
                <div style='height:1px; background:#ddd; width:100px;'></div>
                <h5 class='mx-3 mb-0 fw-semibold text-dark'>
                    You may also like
                </h5>
                <div style='height:1px; background:#ddd; width:100px;'></div>
            </div>
        </div>
        <?php

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
        ?>

            <div class="col-md-2 col-sm-6">
                <div class="card product-card h-100 shadow-sm">
                    <img src="<?= image('products/' . $product_image); ?>" class="card-img-top">
                    <div class="card-body p-2">

                        <h6 class="mt-2 mb-1"><?= $product_title ?></h6>

                        <div class="price">Tsh: <?= number_format($product_price, 2) ?></div>

                        <div class="card_footer mt-2">
                            <a href="<?= url('products/product_details.php?product_id=' . $product_id); ?>" class="btn btn-sm btn-dark w-100 py-1"> View Product </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        mysqli_stmt_close($stmt);
    }
}

//Product details of each product

function productDetails()
{
    global $conn;

    if (isset($_GET['product_id']) && filter_var($_GET['product_id'], FILTER_VALIDATE_INT)) {

        $product_id = (int)$_GET['product_id'];

        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // Check if product exists

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $product_title = htmlspecialchars($row['product_title']);
                $product_description = htmlspecialchars($row['product_description']);
                $product_image = htmlspecialchars($row['product_image']);
                $product_image2 = htmlspecialchars($row['product_image2']);
                $product_image3 = htmlspecialchars($row['product_image3']);
                $product_price = htmlspecialchars($row['product_price']);
                $category_id = $row['category_id'];

            ?>

                <div class="row">

                    <!-- Left: Images -->
                    <div class="col-md-6">
                        <div class="product-gallery">

                            <!-- Main Image -->
                            <div class="main-img-wrapper mb-3 text-center">
                                <img src="<?= image('products/' . $product_image); ?>"
                                    class="img-fluid rounded-4 shadow-sm main-image">
                            </div>

                            <!-- Thumbnails -->
                            <div class="d-flex gap-3 justify-content-center flex-wrap">

                                <?php if (!empty($product_image)) { ?>
                                    <img src="<?= image('products/' . $product_image); ?>"
                                        class="thumb-img active-thumb"
                                        onclick="changeImage(this)">
                                <?php } ?>

                                <?php if (!empty($product_image2)) { ?>
                                    <img src="<?= image('products/' . $product_image); ?>"
                                        class="thumb-img"
                                        onclick="changeImage(this)">
                                <?php } ?>

                                <?php if (!empty($product_image3)) { ?>
                                    <img src="<?= image('products/' . $product_image); ?>"
                                        class="thumb-img"
                                        onclick="changeImage(this)">
                                <?php } ?>

                            </div>
                        </div>

                        <script>
                            function changeImage(el) {
                                const mainImage = document.querySelector('.main-image');
                                const thumbs = document.querySelectorAll('.thumb-img');

                                mainImage.src = el.src;

                                thumbs.forEach(img => img.classList.remove('active-thumb'));
                                el.classList.add('active-thumb');
                            }
                        </script>
                    </div>

                    <!-- Right: Details -->
                    <div class="col-md-6">

                        <div class="product-details p-3 p-lg-4 shadow-sm rounded-4 bg-white">

                            <h3 class="fw-bold mb-2"><?= $product_title ?></h3>

                            <!-- Price -->
                            <div class="mb-3">
                                <span class="text-muted small">Price</span><br>
                                <span class="product-price">
                                    Tsh <?= number_format($product_price, 2) ?>
                                </span>
                            </div>

                            <!-- Description -->
                            <p class="product-description text-muted mb-4">
                                <?= $product_description ?>
                            </p>

                            <!-- Actions -->
                            <div class="d-flex flex-row gap-2">
                                <a href="<?= url('index.php?product_id=' . $product_id); ?>" class="btn cart-btn py-1"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</a>

                                <a href="<?= url('index.php?product_id=' . $product_id); ?>"
                                    class="btn btn-outline-dark py-1">
                                    Buy Now
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

                <?php showRelatedProducts($category_id); ?>

            <?php
            }
        } else {

            // Product not found

            ?>

            <div class="container py-5">
                <div class="text-center">

                    <h1 class="display-1 fw-bold text-danger">404</h1>

                    <h3 class="mb-3">Product Not Found</h3>

                    <p class="text-muted mb-4">
                        Sorry, this product does not exist.
                    </p>

                    <a href="<?= BASE_URL; ?>index.php" class="btn btn-danger">
                        Back Home
                    </a>

                </div>
            </div>
        <?php
        }

        mysqli_stmt_close($stmt);
    } else {

        // Invalid Product ID

        ?>
        <div class="container py-5">
            <div class="text-center">

                <h1 class="display-1 fw-bold text-danger">404</h1>

                <h3 class="mb-3">Invalid Product</h3>

                <p class="text-muted mb-4">
                    Invalid product ID supplied.
                </p>

                <a href="<?= BASE_URL; ?>index.php" class="btn btn-danger">
                    Back Home
                </a>

            </div>
        </div>
<?php
    }
}
