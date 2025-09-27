<?php
session_start();
require('includes/db_connection.php');

// Handle quantity update via AJAX
if (isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    $watchId = (int)$_POST['watch_id'];
    $quantity = (int)$_POST['quantity'];
    
    // Initialize cart if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if ($quantity > 0) {
        $_SESSION['cart'][$watchId] = $quantity;
    } else {
        unset($_SESSION['cart'][$watchId]);
    }
    
    // Calculate new totals
    $subtotal = 0;
    $totalItems = 0;
    
    if (!empty($_SESSION['cart'])) {
        $ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
        $sql = "SELECT id, price FROM watches WHERE id IN ($ids)";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $qty = $_SESSION['cart'][$row['id']];
                $subtotal += (float)$row['price'] * $qty;
                $totalItems += $qty;
            }
        }
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'subtotal' => number_format($subtotal, 2),
        'total' => number_format($subtotal + 10, 2),
        'item_count' => $totalItems,
        'line_total' => number_format((float)$_POST['price'] * $quantity, 2)
    ]);
    exit;
}

// Return error if invalid request
header('Content-Type: application/json');
echo json_encode(['success' => false, 'error' => 'Invalid request']);
exit;
?>
