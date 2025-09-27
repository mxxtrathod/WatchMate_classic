<?php
require_once __DIR__ . '/../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: orders.php');
    exit;
}

$order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
$status   = isset($_POST['status']) ? trim($_POST['status']) : '';

$allowed = ['Pending','Delivered','Cancelled'];
if ($order_id <= 0 || !in_array($status, $allowed, true)) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'error', title: 'Invalid Request', text: 'Invalid order or status.' })
          .then(() => { window.location.href = 'orders.php'; });
      });
    </script>";
    exit;
}

// Check current order status to enforce business rules
$stmt = $conn->prepare("SELECT status FROM orders WHERE id = ?");
$stmt->bind_param('i', $order_id);
$stmt->execute();
$result = $stmt->get_result();
$currentOrder = $result->fetch_assoc();
$stmt->close();

if (!$currentOrder) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'error', title: 'Order Not Found', text: 'The specified order does not exist.' })
          .then(() => { window.location.href = 'orders.php'; });
      });
    </script>";
    exit;
}

$currentStatus = $currentOrder['status'];

// Business rule validations
if ($status === 'Cancelled' && $currentStatus === 'Delivered') {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'error', title: 'Action Not Allowed', text: 'Cannot cancel a delivered order.' })
          .then(() => { window.location.href = 'orders.php'; });
      });
    </script>";
    exit;
}

if ($status === 'Delivered' && $currentStatus === 'Cancelled') {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'error', title: 'Action Not Allowed', text: 'Cannot deliver a cancelled order.' })
          .then(() => { window.location.href = 'orders.php'; });
      });
    </script>";
    exit;
}

$stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
$stmt->bind_param('si', $status, $order_id);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'success', title: 'Updated', text: 'Order status updated to $status.' })
          .then(() => { window.location.href = 'orders.php'; });
      });
    </script>";
} else {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({ icon: 'error', title: 'Update Failed', text: 'Please try again.' })
          .then(() => { window.location.href = 'orders.php'; });
      });
    </script>";
}
