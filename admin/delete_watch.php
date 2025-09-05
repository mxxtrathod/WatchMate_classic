<?php
require('../includes/db_connection.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM watches WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
