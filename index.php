<?php require 'includes/header.php'; ?>

<!-- Black separator strip -->
<div class="row-fluid">
    <div class="text-center h6 py-2">
        WatchMate - Elegance that endures
    </div>
</div>

<!-- Carousel -->
<!--carousel-fade FOR SLIDING EFFECT -->
<div id="watchSlider" class="carousel-fade slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="assets/images/image slider/1.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 1">
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/2.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 2">
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/3.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 3">
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/4.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 4">
        </div>

        <!-- Slide 5 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/5.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 5">
        </div>

        <!-- Slide 6 -->
        <div class="carousel-item">
            <img src="assets/images/image slider/6.jpg" class="d-block w-100 object-fit-cover" alt="Watch Slide 6">
        </div>

    </div>


</div>

<section class="container-fluid my-5">
    <div class="row align-items-center">

        <!-- Classic Trends Image -->
        <div class="col-md-6 mb-3 mb-md-0">
            <img src="assets/images/male model.jpg" class="img-fluid w-100 rounded shadow-md object-fit-cover model-img"
                alt="Classic Trends">
        </div>

        <!-- Classic Trends Description -->
        <div class="col-md-6 mb-3 scroll-slide-right">
            <div class="p-4 p-sm-3 p-md-4">
                <h2 class="fw-bold">CLASSIC</h2>
                <h4 class="text-muted mb-3">TRENDS for you</h4>
                <p class="text-secondary">
                    Discover timeless elegance with our collection of classic men's watches.
                    Crafted with precision and designed to impress, each piece complements your sophisticated style.
                    Choose from a variety of leather and metal straps, premium dials, and luxury designs that never go
                    out of fashion.
                </p>
                <a href="explore_collection.php" class="btn btn-dark mt-3">Explore Collection</a>
            </div>
        </div>


    </div>
</section>

<?php
require('includes/db_connection.php');
$sql = "SELECT * FROM watches ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);
?>

<section class="container my-5">
    <h4 class="mb-4 fw-bold">Collection</h4>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>

                <!-- Watch Card -->
                <div class="col">
                    <a href="watch_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                        <div class="card card-hover border-0 shadow-sm h-100">
                            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top img-fluid object-fit-cover"
                                alt="Watch">
                            <div class="card-body px-2 py-3">
                                <h6 class="card-title mb-1 fw-semibold text-truncate"><?php echo htmlspecialchars($row['title']); ?></h6>
                                <p class="card-text text-muted small mb-2 text-truncate"><?php echo htmlspecialchars($row['description']); ?></p>
                                <p class="fw-bold mt-3">$<?php echo htmlspecialchars($row['price']); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">No watches available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-end mt-2">
        <div class="col align-self-end">
            <a href="explore_collection.php" class="text-end">Explore Now <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</section>

<?php if (!isset($_SESSION['user_name'])): ?>
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
<?php endif; ?>

<?php
require('includes/modals/login_modal.php');
require('includes/modals/register_modal.php');
?>



<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>

<?php require 'includes/footer.php'; ?>