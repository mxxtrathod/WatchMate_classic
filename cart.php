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

              <button class="btn btn-primary checkout-btn w-100 mb-3" onclick="checkLogin(event)">
                Confirm Order
              </button>

              <script>
                function checkLogin(e) {
                  <?php if (!isset($_SESSION['user_id'])): ?>
                    e.preventDefault(); // stop button action
                    alert("⚠️ You must be logged in to confirm your order!");
                    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                    loginModal.show(); // open Bootstrap modal

                  <?php else: ?>
                    window.location.href = "confirm_order.php"; // proceed to confirm order
                  <?php endif; ?>
                }
              </script>



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


  <!-- Combined Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">

        <!-- Modal Header with Stylish Tabs -->
        <div class="modal-header border-0 flex-column align-items-start">
          <h5 class="fw-bold text-dark mb-3">Login</h5>

          <!-- Stylish Tabs -->
          <ul class="nav nav-pills custom-tabs mb-1" id="loginTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#userLogin"
                type="button" role="tab">User</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#adminLogin"
                type="button" role="tab">Admin</button>
            </li>
          </ul>
          <!-- Close Button -->
          <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
            aria-label="Close"></button>

        </div>

        <!-- Modal Body with Tabs -->
        <div class="modal-body p-4">
          <div class="tab-content" id="loginTabContent">

            <!-- User Login Form -->
            <div class="tab-pane fade show active" id="userLogin" role="tabpanel">
              <form action="login.php" method="post">
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-envelope"></i></span>
                    <input type="email" name="loginemail" class="form-control border-start-0"
                      placeholder="Email Address" required>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-lock"></i></span>
                    <input type="password" name="loginPassword" id="loginPassword"
                      class="form-control border-start-0 border-end-0" placeholder="Password"
                      required>
                    <span class="input-group-text bg-white border-start-0" style="cursor:pointer;"
                      onclick="togglePassword('loginPassword',this)"><i
                        class="bi bi-eye-fill"></i></span>
                  </div>
                </div>
                <button type="submit" class="btn btn-warning w-100">Login</button>
              </form>
              <div class="mt-3 text-center">
                <p class="small">Don't have an account? <a href="#" data-bs-toggle="modal"
                    data-bs-target="#registerModal" class="text-primary fw-semibold">Register</a></p>
              </div>
            </div>

            <!-- Admin Login Form -->
            <div class="tab-pane fade" id="adminLogin" role="tabpanel">
              <h5 class="text-center mb-3">Welcome, Admin</h5>
              <form action="admin/admin_login.php" method="post">
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-envelope"></i></span>
                    <input type="email" name="admin_email" class="form-control border-start-0"
                      placeholder="Email Address" required>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-lock"></i></span>
                    <input type="password" id="adminPassword" name="admin_password"
                      class="form-control border-start-0 border-end-0" placeholder="Password"
                      required>
                    <span class="input-group-text bg-white border-start-0"
                      onclick="togglePassword('adminPassword',this)" style="cursor:pointer;"><i
                        class="bi bi-eye-fill"></i></span>
                  </div>
                </div>
                <button type="submit" class="btn btn-warning w-100">Login</button>
              </form>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>


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