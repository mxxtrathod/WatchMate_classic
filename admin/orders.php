<?php
require_once __DIR__ . '/../includes/db_connection.php';

// Ensure orders table has a status column
$hasStatus = false;
$colRes = $conn->query("SHOW COLUMNS FROM orders LIKE 'status'");
if ($colRes && $colRes->num_rows > 0) {
    $hasStatus = true;
}
if (!$hasStatus) {
    // Add status with default 'Pending'
    $conn->query("ALTER TABLE orders ADD COLUMN status VARCHAR(20) NOT NULL DEFAULT 'Pending'");
}

// Fetch orders
$orders = [];
$filterStatus = isset($_GET['status']) ? trim($_GET['status']) : '';
$allowedStatus = ['Pending','Delivered','Cancelled'];
$where = '';
if ($filterStatus !== '' && in_array($filterStatus, $allowedStatus, true)) {
    $stmt = $conn->prepare("SELECT id, user_email, full_name, phone, address_line1, address_line2, city, state, zip, country, subtotal, shipping, total, created_at, status FROM orders WHERE status = ? ORDER BY id DESC");
    $stmt->bind_param('s', $filterStatus);
    $stmt->execute();
    $ordersRes = $stmt->get_result();
} else {
    $ordersRes = $conn->query("SELECT id, user_email, full_name, phone, address_line1, address_line2, city, state, zip, country, subtotal, shipping, total, created_at, status FROM orders ORDER BY id DESC");
}
if ($ordersRes) {
    while ($row = $ordersRes->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders</title>
  <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">
</head>

<body>
  <!-- Sidebar -->
  <?php require('../includes/sidebar.php'); ?>

  <div class="main-content">
    <div class="container-fluid py-1">
      <div class="p-2 bg-white shadow-sm rounded-3 mb-3">
        <div class="d-flex align-items-center">
          <i class="bi bi-box-seam fs-2 text-primary me-3"></i>
          <div>
            <h5 class="mt-2 fw-bold">
              Orders Management
            </h5>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <!-- Filter Pills -->
      <div class="mb-3 d-flex flex-wrap gap-2">
        <a href="orders.php" class="btn btn-sm <?php echo ($filterStatus===''?'btn-primary':'btn-outline-primary'); ?>">All</a>
        <a href="orders.php?status=Pending" class="btn btn-sm <?php echo ($filterStatus==='Pending'?'btn-warning':'btn-outline-warning'); ?>">Pending</a>
        <a href="orders.php?status=Delivered" class="btn btn-sm <?php echo ($filterStatus==='Delivered'?'btn-success':'btn-outline-success'); ?>">Delivered</a>
        <a href="orders.php?status=Cancelled" class="btn btn-sm <?php echo ($filterStatus==='Cancelled'?'btn-danger':'btn-outline-danger'); ?>">Cancelled</a>
      </div>

      <!-- Orders Table -->
      <div class="table-responsive">
        <table class="table align-middle text-center shadow-sm rounded-4 overflow-hidden table-striped">
          <thead class="bg-light border-bottom table-dark tbl">
            <tr class="text-uppercase text-muted small">
              <th scope="col" class="py-3">Order ID</th>
              <th scope="col" class="py-3">Customer</th>
              <th scope="col" class="py-3">Amount</th>
              <th scope="col" class="py-3">Address</th>
              <th scope="col" class="py-3">Date</th>
              <th scope="col" class="py-3">Status</th>
              <th scope="col" class="py-3">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if (empty($orders)): ?>
            <tr>
              <td colspan="7" class="text-center text-muted py-4">No orders found.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($orders as $o): ?>
              <tr class="align-middle table-row-hover">
                <td class="fw-bold text-secondary">#<?php echo str_pad((int)$o['id'], 4, '0', STR_PAD_LEFT); ?></td>
                <td>
                  <div class="fw-semibold text-dark"><?php echo htmlspecialchars($o['full_name'] ?: 'Unknown User'); ?></div>
                  <small class="text-muted"><?php echo htmlspecialchars($o['user_email']); ?></small>
                </td>
                <td>
                  <span class="badge rounded-pill bg-gradient bg-success-subtle text-dark px-3 py-2 fs-6">
                    $<?php echo number_format((float)$o['total'], 2); ?>
                  </span>
                </td>
                <td class="text-truncate" style="max-width: 200px;">
                  <?php 
                    $addr = $o['address_line1'];
                    if (!empty($o['address_line2'])) { $addr .= ', ' . $o['address_line2']; }
                    $addr .= ', ' . $o['city'] . ', ' . $o['state'] . ' ' . $o['zip'] . ', ' . $o['country'];
                    echo htmlspecialchars($addr);
                  ?>
                </td>
                <td class="text-muted small">
                  <?php echo date('M d, Y', strtotime($o['created_at'])); ?><br>
                  <?php echo date('h:i A', strtotime($o['created_at'])); ?>
                </td>
                <td>
                  <?php 
                    $status = $o['status'] ?: 'Pending';
                    $statusClass = '';
                    switch($status) {
                      case 'Pending': $statusClass = 'bg-warning'; break;
                      case 'Delivered': $statusClass = 'bg-success'; break;
                      case 'Cancelled': $statusClass = 'bg-danger'; break;
                    }
                  ?>
                  <span class="badge <?php echo $statusClass; ?> text-white px-2 py-1">
                    <?php echo htmlspecialchars($status); ?>
                  </span>
                </td>
                <td>
                  <form action="update_order_status.php" method="post" class="d-inline me-1">
                    <input type="hidden" name="order_id" value="<?php echo (int)$o['id']; ?>">
                    <input type="hidden" name="status" value="Delivered">
                    <button type="submit" class="btn btn-outline-success btn-sm rounded-pill px-3 shadow-sm" 
                      <?php echo ($status==='Delivered' || $status==='Cancelled'?'disabled':''); ?>
                      <?php if($status==='Cancelled'): ?>title="Cannot deliver cancelled orders"<?php endif; ?>>
                      <i class="bi bi-check2-circle"></i> Deliver
                    </button>
                  </form>
                  <form action="update_order_status.php" method="post" class="d-inline">
                    <input type="hidden" name="order_id" value="<?php echo (int)$o['id']; ?>">
                    <input type="hidden" name="status" value="Cancelled">
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm" 
                      <?php echo ($status==='Cancelled' || $status==='Delivered'?'disabled':''); ?>
                      <?php if($status==='Delivered'): ?>title="Cannot cancel delivered orders"<?php endif; ?>>
                      <i class="bi bi-x-circle"></i> Cancel
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../assets/js/script.js"></script>
</body>
</html>
