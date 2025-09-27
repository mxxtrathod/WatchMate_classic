<?php
// session_start();
require 'includes/db_connection.php';
require 'includes/header.php';

// Require user login
if (!isset($_SESSION['user_email'])) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          icon: 'warning',
          title: 'Login Required',
          text: 'Please login to proceed to checkout.'
        }).then(() => {
          var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
          loginModal.show();
          window.location.href = 'cart.php';
        });
      });
    </script>";
    exit;
}

// Ensure cart exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
          icon: 'info',
          title: 'Your cart is empty',
          text: 'Add items to the cart before checkout.'
        }).then(() => { window.location.href = 'explore_collection.php'; });
      });
    </script>";
    exit;
}

// Fetch cart items with quantities
$cartItems = [];
$total = 0.0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
    $sql = "SELECT * FROM watches WHERE id IN ($ids)";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quantity = $_SESSION['cart'][$row['id']];
            $price = (float)$row['price'];
            $lineTotal = $price * $quantity;
            
            $row['quantity'] = $quantity;
            $row['price'] = $price;
            $row['line_total'] = $lineTotal;
            $cartItems[] = $row;
            $total += $lineTotal;
        }
    }
}
$shipping = 10.00;
$grandTotal = $total + $shipping;

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name     = trim($_POST['full_name'] ?? '');
    $phone         = trim($_POST['phone'] ?? '');
    $address_line1 = trim($_POST['address_line1'] ?? '');
    $address_line2 = trim($_POST['address_line2'] ?? '');
    $city          = trim($_POST['city'] ?? '');
    $state         = trim($_POST['state'] ?? '');
    $zip           = trim($_POST['zip'] ?? '');
    $country       = trim($_POST['country'] ?? '');

    // Basic validation
    if ($full_name === '' || $phone === '' || $address_line1 === '' || $city === '' || $state === '' || $zip === '' || $country === '') {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
              icon: 'error',
              title: 'Missing fields',
              text: 'Please fill all required address fields.'
            });
          });
        </script>";
    } else {
        $user_email = $_SESSION['user_email'];

        // Create tables if not exist
        $conn->query("CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_email VARCHAR(50) NOT NULL,
            full_name VARCHAR(100) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            address_line1 VARCHAR(255) NOT NULL,
            address_line2 VARCHAR(255) NULL,
            city VARCHAR(100) NOT NULL,
            state VARCHAR(100) NOT NULL,
            zip VARCHAR(20) NOT NULL,
            country VARCHAR(100) NOT NULL,
            subtotal DECIMAL(10,2) NOT NULL,
            shipping DECIMAL(10,2) NOT NULL,
            total DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        $conn->query("CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            watch_id INT NOT NULL,
            title VARCHAR(100) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            quantity INT NOT NULL DEFAULT 1,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        // Insert into orders
        $stmt = $conn->prepare("INSERT INTO orders (user_email, full_name, phone, address_line1, address_line2, city, state, zip, country, subtotal, shipping, total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param(
            'ssssssssssdd',
            $user_email,
            $full_name,
            $phone,
            $address_line1,
            $address_line2,
            $city,
            $state,
            $zip,
            $country,
            $total,
            $shipping,
            $grandTotal
        );
        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;
            $stmt->close();

            // Insert order items with correct quantities
            $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, watch_id, title, price, quantity) VALUES (?,?,?,?,?)");
            foreach ($cartItems as $ci) {
                $itemStmt->bind_param('iisdi', $order_id, $ci['id'], $ci['title'], $ci['price'], $ci['quantity']);
                $itemStmt->execute();
            }
            $itemStmt->close();

            // Clear cart
            $_SESSION['cart'] = [];

            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                  icon: 'success',
                  title: 'Order Placed',
                  text: 'Your order #$order_id has been placed successfully!',
                  confirmButtonText: 'OK'
                }).then(() => { window.location.href = 'index.php'; });
              });
            </script>";
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                  icon: 'error',
                  title: 'Order Failed',
                  text: 'Unable to place order. Please try again.'
                });
              });
            </script>";
        }
    }
}
?>

<div class="container my-5">
  <h3 class="mb-4">Confirm Your Order</h3>
  <div class="row g-4">
    <div class="col-lg-7">
      <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Order Items (<?php echo array_sum(array_column($cartItems, 'quantity')); ?> items)</h5>
        <?php foreach ($cartItems as $item): ?>
          <div class="d-flex align-items-center justify-content-between border-bottom py-2">
            <div class="d-flex align-items-center gap-3">
              <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
              <div>
                <div class="fw-semibold"><?php echo htmlspecialchars($item['title']); ?></div>
                <small class="text-muted">ID: <?php echo (int)$item['id']; ?> | Qty: <?php echo (int)$item['quantity']; ?></small>
              </div>
            </div>
            <div class="text-end">
              <div class="fw-bold">$<?php echo number_format($item['line_total'], 2); ?></div>
              <small class="text-muted">$<?php echo number_format($item['price'], 2); ?> each</small>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card p-3 shadow-sm mb-3">
        <h5 class="mb-3">Shipping Address</h5>
        <form method="post">
          <div class="mb-2">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Address Line 1</label>
            <input type="text" name="address_line1" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Address Line 2</label>
            <input type="text" name="address_line2" class="form-control" placeholder="Apartment, suite, etc. (optional)">
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">City</label>
              <input type="text" name="city" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label">State</label>
              <input type="text" name="state" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label class="form-label">ZIP</label>
              <input type="text" name="zip" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
              <label class="form-label">Country</label>
              <input type="text" name="country" class="form-control" value="India" required>
            </div>
          </div>

          <div class="mt-3 d-flex justify-content-between">
            <span>Subtotal</span>
            <span>$<?php echo number_format($total, 2); ?></span>
          </div>
          <div class="d-flex justify-content-between">
            <span>Shipping</span>
            <span>$<?php echo number_format($shipping, 2); ?></span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold">
            <span>Total</span>
            <span>$<?php echo number_format($grandTotal, 2); ?></span>
          </div>

          <button type="submit" class="btn btn-success w-100 mt-3">Place Order</button>
        </form>
      </div>
      <a href="cart.php" class="btn btn-outline-secondary w-100">Back to Cart</a>
    </div>
  </div>
</div>

<?php require 'includes/footer.php'; ?>
