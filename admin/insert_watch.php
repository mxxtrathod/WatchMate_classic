<?php
require('../includes/db_connection.php');

$response = [];

if (isset($_FILES['image']['name'])) {
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $uploadDir = "../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    move_uploaded_file($imageTmp, $uploadDir . $imageName);
} else {
    $imageName = null;
}

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];

$sql = "INSERT INTO watches (image, title, description, price) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $imageName, $title, $description, $price);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$stmt->close();
$conn->close();

// echo json_encode($response);
?>

