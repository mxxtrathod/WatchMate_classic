<?php
// session_start();  
require("includes/header.php");
require('includes/db_connection.php');

// Remove item from cart
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
  $watchId = (int)$_GET['id'];
  if (($key = array_search($watchId, $_SESSION['cart'])) !== false) {
    unset($_SESSION['cart'][$key]);
  }
  header("Location: cart.php");
  exit;
}


// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Handle add to cart action
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
  $watchId = (int)$_GET['id'];

  // Prevent duplicates
  if (!in_array($watchId, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $watchId;
  }

  header("Location: cart.php");
  exit;
}

// Fetch cart items from database
$cartItems = [];
if (!empty($_SESSION['cart'])) {
  $ids = implode(',', array_map('intval', $_SESSION['cart']));
  $sql = "SELECT * FROM watches WHERE id IN ($ids)";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $cartItems[] = $row;
    }
  }
}
?>

<body>


  <?php if (empty($cartItems)): ?>
    <div class="container text-center my-5">
      <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart" class="mb-5 me-3 mt-5" style="width: 150px; height: auto;">
      <h3 class="fw-bold text-dark">Your Cart is Empty!</h3>
      <p class="text-muted">Let’s fill it with WatchMate</p>
      <a href="explore_collection.php" class="btn btn-warning text-uppercase px-5 py-2 mt-3">Continue Shopping</a>
    </div>
  <?php else: ?>

    <div class="cart-wrapper">
      <div class="container">
        <div class="row g-4">
          <!-- Cart Items Section -->
          <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="mb-0"><i class="bi bi-bag"></i> Shopping Cart</h4>
              <span class="text"><?php echo count($cartItems); ?> items</span>
            </div>

            <!-- Product Cards -->
            <div class="d-flex flex-column gap-3">
              <?php foreach ($cartItems as $item): ?>
                <!-- Product 1 -->
                <div class="product-card p-3 shadow-sm">
                  <div class="row align-items-center">
                    <div class="col-md-2">
                      <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" alt="Product" class="product-image">
                    </div>
                    <div class="col-md-4">
                      <h6 class="mb-1"><?php echo htmlspecialchars($item['title']); ?></h6>
                      <p class="text-muted mb-0 text-truncate" style="width: 200px;"><?php echo htmlspecialchars($item['description']); ?></p>
                    </div>
                    <div class="col-md-3">
                      <div class="d-flex align-items-center gap-2">
                        <button class="quantity-btn" onclick="updateQuantity(1, -1)">-</button>
                        <input type="number" class="quantity-input" value="1" min="1">
                        <button class="quantity-btn" onclick="updateQuantity(1, 1)">+</button>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <span class="fw-bold">$<?php echo htmlspecialchars($item['price']); ?></span>
                    </div>
                    <div class="col-md-1">
                      <a href="cart.php?action=remove&id=<?php echo $item['id']; ?>">
                        <i class="bi bi-trash remove-btn fs-5"></i>
                      </a>                  
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              <div class="text-start mb-4"> <a href="explore_collection.php" class="btn btn-outline-primary"> <i class="bi bi-arrow-left me-2"></i> Continue Shopping </a> </div>
            </div>
          </div>

          <!-- Summary Section -->
          <div class="col-lg-4 mt-5">
            <div class="summary-card p-4 shadow-sm">
              <h5 class="mb-4">Order Summary</h5>

              <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Subtotal</span>
                <span>$<?php echo array_sum(array_column($cartItems, 'price')); ?></span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Shipping</span>
                <span>$10.00</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-4">
                <span class="fw-bold">Total</span>
                <span class="fw-bold">$<?php echo array_sum(array_column($cartItems, 'price')) + 10; ?></span>
              </div>
              <button class="btn btn-primary checkout-btn w-100 mb-3">
                Confirm Order
              </button>

              <div class="d-flex justify-content-center gap-2">
                <i class="bi bi-shield-check text-success"></i>
                <small class="text-muted">Secure checkout</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endif; ?>

  <!-- DEMO LINK  -->
  <!-- https://bootstrapexamples.com/@kemaya/shopping-cart-design-using-bootstrap-5 -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function updateQuantity(productId, change) {
      const input = event.target.parentElement.querySelector('.quantity-input');
      let value = parseInt(input.value) + change;
      if (value >= 1) {
        input.value = value;
      }
    }

  </script>

</body>

</html>