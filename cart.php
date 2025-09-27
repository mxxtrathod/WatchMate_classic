<?php
// session_start();
require("includes/header.php");
require('includes/db_connection.php');

// Remove item from cart
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
  $watchId = (int)$_GET['id'];
  if (isset($_SESSION['cart'][$watchId])) {
    unset($_SESSION['cart'][$watchId]);
  }
  header("Location: cart.php");
  exit;
}

// Clear entire cart
if (isset($_GET['action']) && $_GET['action'] === 'clear_cart') {
  $_SESSION['cart'] = [];
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

  // Add or increase quantity
  if (isset($_SESSION['cart'][$watchId])) {
    $_SESSION['cart'][$watchId]++;
  } else {
    $_SESSION['cart'][$watchId] = 1;
  }

  header("Location: cart.php");
  exit;
}


// Fetch cart items from database
$cartItems = [];
$subtotal = 0;
if (!empty($_SESSION['cart'])) {
  $ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
  $sql = "SELECT * FROM watches WHERE id IN ($ids)";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $row['quantity'] = $_SESSION['cart'][$row['id']];
      $row['line_total'] = (float)$row['price'] * $row['quantity'];
      $subtotal += $row['line_total'];
      $cartItems[] = $row;
    }
  }
}
?>
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
              <div class="d-flex align-items-center gap-3">
                <span class="text" id="item-count"><?php echo array_sum($_SESSION['cart'] ?? []); ?> items</span>
                <a href="cart.php?action=clear_cart" class="btn btn-sm btn-outline-danger" onclick="return confirm('Clear entire cart?')">
                  <i class="bi bi-trash"></i> Clear Cart
                </a>
              </div>
            </div>
            
            <!-- Debug info (remove in production) -->
            <?php if (isset($_GET['debug'])): ?>
            <div class="alert alert-info mb-3">
              <strong>Debug Info:</strong><br>
              Session Cart: <?php echo json_encode($_SESSION['cart'] ?? []); ?><br>
              Total Items: <?php echo array_sum($_SESSION['cart'] ?? []); ?><br>
              Cart Items Count: <?php echo count($cartItems); ?>
            </div>
            <?php endif; ?>

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
                        <button class="quantity-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, -1)">-</button>
                        <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" min="1" data-watch-id="<?php echo $item['id']; ?>" data-price="<?php echo $item['price']; ?>">
                        <button class="quantity-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 1)">+</button>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <span class="fw-bold item-total" data-watch-id="<?php echo $item['id']; ?>">$<?php echo number_format($item['line_total'], 2); ?></span>
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
                <span id="subtotal">$<?php echo number_format($subtotal, 2); ?></span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Shipping</span>
                <span>$10.00</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-4">
                <span class="fw-bold">Total</span>
                <span class="fw-bold" id="total">$<?php echo number_format($subtotal + 10, 2); ?></span>
              </div>

              <button class="btn btn-primary checkout-btn w-100 mb-3" onclick="checkLogin(event)">
                Proceed to checkout
              </button>

              <script>
                function checkLogin(e) {
                  <?php if (!isset($_SESSION['user_email'])): ?>
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
    function updateQuantity(watchId, change) {
      const input = document.querySelector(`input[data-watch-id="${watchId}"]`);
      let newQuantity = parseInt(input.value) + change;
      
      if (newQuantity >= 1) {
        input.value = newQuantity;
        updateCartQuantity(watchId, newQuantity);
      }
    }

    function updateCartQuantity(watchId, quantity) {
      const input = document.querySelector(`input[data-watch-id="${watchId}"]`);
      const price = parseFloat(input.dataset.price);
      
      // Show loading state
      const itemTotal = document.querySelector(`.item-total[data-watch-id="${watchId}"]`);
      const originalText = itemTotal.textContent;
      itemTotal.textContent = 'Updating...';
      
      // Send AJAX request to update quantity
      fetch('update_cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=update_quantity&watch_id=${watchId}&quantity=${quantity}&price=${price}`
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          // Update item total
          itemTotal.textContent = '$' + data.line_total;
          
          // Update summary
          document.getElementById('subtotal').textContent = '$' + data.subtotal;
          document.getElementById('total').textContent = '$' + data.total;
          document.getElementById('item-count').textContent = data.item_count + ' items';
          
          console.log('Cart updated successfully');
        } else {
          throw new Error(data.error || 'Update failed');
        }
      })
      .catch(error => {
        console.error('Error updating cart:', error);
        // Restore original text on error
        itemTotal.textContent = originalText;
        alert('Failed to update cart. Please try again.');
      });
    }

    // Handle direct input changes
    document.addEventListener('DOMContentLoaded', function() {
      const quantityInputs = document.querySelectorAll('.quantity-input');
      quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
          const watchId = this.dataset.watchId;
          const newQuantity = parseInt(this.value);
          
          if (newQuantity >= 1) {
            updateCartQuantity(watchId, newQuantity);
          } else {
            this.value = 1; // Reset to minimum
            updateCartQuantity(watchId, 1);
          }
        });
        
        // Prevent invalid input
        input.addEventListener('input', function() {
          if (this.value < 1) {
            this.value = 1;
          }
        });
      });
    });
  </script>

<?php require 'includes/footer.php'; ?>