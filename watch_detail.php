<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php
require('includes/db_connection.php');
require('includes/header.php');

// Check if ID exists
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM watches WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $watch = $result->fetch_assoc();
    } else {
        echo "<div class='container mt-5'><h4>Watch not found!</h4></div>";
        require('includes/footer.php');
        exit;
    }
} else {
    echo "<div class='container mt-5'><h4>Invalid Watch ID!</h4></div>";
    require('includes/footer.php');
    exit;
}
?>

<div class="container mt-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-4">
            <img src="uploads/<?php echo htmlspecialchars($watch['image']); ?>" alt="<?php echo htmlspecialchars($watch['title']); ?>" class="img-fluid rounded mb-3 detail-watch" id="mainImage">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3"><?php echo htmlspecialchars($watch['title']); ?></h2>
            <p class="mb-4"><?php echo htmlspecialchars($watch['description']); ?></p>
            <!-- <p class="text-muted mb-4">ID: <?php echo $watch['id']; ?></p> -->
            <div class="mb-3">
                <span class="h6">MRP :</span>
                <span class="h4 me-2"> $<?php echo htmlspecialchars($watch['price']); ?></span>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
            </div>
            <div class="d-flex gap-3 mt-5">
    
                <a href="cart.php?action=add&id=<?php echo $watch['id']; ?>" class="btn btn-outline-dark px-5 py-2">
                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                </a>

                <button class="btn px-5 py-2" style="background-color:#e89c34; color:#000; font-weight:500;">
                    BUY NOW
                </button>

            </div>
            <div class="mt-5  py-2">
                <div class="row text-center">
                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-truck fa-2x mb-2"></i>
                        <p class="mb-0">Free shipping <br> Countrywide</p>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-watch fa-2x mb-2"></i>
                        <p class="mb-0">Serviced <br>Across India</p>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-box-seam fa-2x mb-2"></i>
                        <p class="mb-0">Easy <br> Return </p>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <i class="bi bi-wallet2 fa-2x mb-2"></i>
                        <p class="mb-0">Pay on<br>Delivery</p>
                    </div>
                </div>
            </div>

        </div>

        <section class="bg-light-subtle py-5 text-center scroll-fade" id="login-section">
            <div class="container">
                <h3 class="fw-semibold mb-4">LOGIN FOR THE BEST EXPERIENCE</h3>

                <a href="#" class="btn btn-warning text-uppercase px-4 py-2 fw-medium mb-3" data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    Login Now
                </a>

                <div class="create_account">
                    <a class="text-decoration-underline text-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Create
                        An Account</a>
                </div>
            </div>
        </section>

    </div>
</div>

<?php
require('includes/modals/login_modal.php');
require('includes/modals/register_modal.php');
?>


<?php require('includes/footer.php');
?>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>