<?php

include __DIR__ . "/../includes/db.php";

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // add to cart logic here
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
            <a href="index.php?category_id=<?= $category_id ?>"
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

        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 0,9";
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
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow">
                    <img src="eshop-images/<?= $product_image ?>" class="card-img-top img-fluid" alt="product images" style="width: 100%; max-width: 450px; height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold" style="font-size: 15px;"><?= $product_title ?></h5>
                        <p class="card-text mb-2" style="font-size: 15px;"><?= substr($product_description, 0, 85) ?>...</p>
                        <span class="fw-normal" style="font-size: 15px;">Tsh: <?= number_format($product_price, 2) ?></span>
                        <div class="card_footer mt-2">
                            <a href="index.php?product_id=<?= $product_id ?>" class="btn cart-btn py-1 px-2"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</a>
                            <a href="products/product_details.php?product_id=<?= $product_id ?>" class="btn eye-btn"><i class="bi bi-eye-fill"></i>View</a>
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

                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow">
                        <img src="eshop-images/<?= $product_image ?>" class="card-img-top img-fluid" style="height:250px; object-fit:cover;">
                        <div class="card-body">
                            <h5><?= $product_title ?></h5>
                            <p><?= substr($product_description, 0, 85) ?>...</p>
                            <span>Tsh: <?= number_format($product_price, 2) ?></span>
                            <div class="mt-3 d-flex gap-3">
                                <a href="index.php?product_id=<?= $product_id ?>" class="btn cart-btn py-1 px-2"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</a>
                                <a href="products/product_details.php?product_id=<?= $product_id ?>" class="btn eye-btn"><i class="bi bi-eye-fill"></i>View</a>
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
    $sql = "SELECT * FROM products WHERE category_id != ? ORDER BY RAND() LIMIT 0,4";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        ?>
        <div class='col-12 mt-5'>
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

            <div class="col-12 col-md-3 my-4">
                <div class="card border-0 shadow h-100"> <img src="<?= BASE_URL . 'eshop-images/' . $product_image; ?>" class="card-img-top img-fluid related-img">
                    <div class="card-body p-2">
                        <h6 class="mb-1" style="font-size:14px;"> <?= $product_title ?> </h6>
                        <p class="fw-bold mb-2" style="font-size:13px;"> Tsh: <?= number_format($product_price, 2) ?> </p> <a href="<?= BASE_URL; ?>products/product_details.php?product_id=<?= $product_id ?>" class="btn btn-sm btn-dark w-100 py-1"> View Product </a>
                    </div>
                </div>
            </div>
        <?php
        }
        mysqli_stmt_close($stmt);
    }
}

//Product details for each product

function productDetails()
{
    global $conn;

    if (isset($_GET['product_id'])) {
        $product_id = (int)$_GET['product_id'];

        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_title = htmlspecialchars($row['product_title']);
            $product_description = htmlspecialchars($row['product_description']);
            $product_image = htmlspecialchars($row['product_image']);
            $product_image2 = htmlspecialchars($row['product_image2']);
            $product_image3 = htmlspecialchars($row['product_image3']);
            $product_price = htmlspecialchars($row['product_price']);
            $category_id = $row['category_id'];

            $base_image_path = "eshop-images/";

        ?>
            <!--Left side-->
            <div class="col-md-6 text-center">
                <img src="<?= BASE_URL . 'eshop-images/' . $product_image; ?>"
                    class="img-fluid rounded mb-2 main-image">

                <div class="d-flex justify-content-center gap-3">
                    <?php if (!empty($product_image)) { ?>
                        <img src="<?= BASE_URL . 'eshop-images/' . $product_image; ?>"
                            class="img-fluid rounded thumb-img"
                            style="width:100px; height:100px; cursor:pointer;"
                            onclick="changeImage(this.src)">
                    <?php } ?>

                    <?php if (!empty($product_image)) { ?>
                        <img src="<?= BASE_URL . 'eshop-images/' . $product_image2; ?>"
                            class="img-fluid rounded thumb-img"
                            style="width:100px; height:100px; cursor:pointer;"
                            onclick="changeImage(this.src)">
                    <?php } ?>

                    <?php if (!empty($product_image)) { ?>
                        <img src="<?= BASE_URL . 'eshop-images/' . $product_image3; ?>"
                            class="img-fluid rounded thumb-img"
                            style="width:100px; height:100px; cursor:pointer;"
                            onclick="changeImage(this.src)">
                    <?php } ?>

                </div>

                <script>
                    function changeImage(newSrc) {
                        const mainImage = document.querySelector('.main-image');
                        if (mainImage) {
                            mainImage.src = newSrc;
                        }
                    }
                </script>
            </div>
            <!--Right side-->
            <div class="col-md-6">
                <h2 class="product-title"><?= $product_title ?></h2>
                <p class="product-description w-75 mt-5"><?= $product_description ?></p>
                <span class="product-price fw-semibold">Tsh: <?= number_format($product_price, 2) ?></span>
                <div class="mt-3 d-flex gap-3">
                    <a href="index.php?product_id=<?= $product_id ?>" class="btn cart-btn py-1 px-2"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</a>
                    <a href="index.php?product_id=<?= $product_id ?>" class="btn btn-outline-primary py-1 px-2"><i class="bi bi-credit-card-fill me-2"></i>Purchase</a>
                </div>

            </div>
            <?php showRelatedProducts($category_id); ?>

<?php
        }
    }
}
