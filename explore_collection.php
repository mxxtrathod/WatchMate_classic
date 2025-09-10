<?php
require("includes/header.php");

require('includes/db_connection.php');
$sql = "SELECT * FROM watches ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>

                <!-- Product Card Start -->
                <div class="col">
                    <a href="watch_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                        <div class="card h-100  product-card rounded-3 overflow-hidden transition-all">
                            <div class="position-relative overflow-hidden">
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid w-100 transition" alt="Watch">
                            </div>
                            <div class="card-body px-3 py-2">

                                <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($row['title']); ?></h6>
                                <p class="text-muted text-truncate small mb-2" style="max-width: 240px;"><?php echo htmlspecialchars($row['description']); ?></p>
                                <p class="text-dark fw-bold">$<?php echo htmlspecialchars($row['price']); ?></p>
                                <a href="cart.php?action=add&id=<?php echo $row['id']; ?>" class="btn btn-outline-dark btn-sm w-100 rounded-pill fw-semibold py-2 mb-2">
                                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                </div>
            <?php endwhile; ?>

        <?php else: ?>
        <?php endif; ?>

    </div>
</div>


<?php
require("includes/footer.php");

?>