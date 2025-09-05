<?php

require '../includes/db_connection.php';

$id = (int) $_POST['id']; // Cast to int for safety
$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = mysqli_real_escape_string($conn, $_POST['price']);

// Fetch existing image name first
$currentImage = '';
$getImage = $conn->query("SELECT image FROM watches WHERE id = $id");
if ($getImage && $getImage->num_rows > 0) {
    $currentImage = $getImage->fetch_assoc()['image'];
}

$imageName =  $currentImage;


$sql = "UPDATE watches SET title='$title', description='$description', price='$price'";

// Check if new image uploaded
if (!empty($_FILES['image']['name'])) {
    $targetDir = "../uploads/";
    $imageName = time() . "_" . basename($_FILES["image"]["name"]); // unique name
    $targetFilePath = $targetDir . $imageName;

    // Move uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Append image update in SQL
        $sql .= ", image='$imageName'";
    } else {
        echo json_encode(['status' => '203', 'message' => 'Image upload failed.']);
        exit;
    }
}

$sql .= " WHERE id=$id";

// ✅ Update SQL
// if ($imageName) {
//     $sql = "UPDATE watches 
//             SET title='$title', description='$description', price='$price', image='$imageName' 
//             WHERE id=$id";
// } else {
//     $sql = "UPDATE watches 
//             SET title='$title', description='$description', price='$price' 
//             WHERE id=$id";
// }


if ($conn->query($sql)) {
    echo json_encode([
        'status' => '201',
        'message' => 'Watch updated successfully',
        'data' => [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'image' => $imageName
        ]
    ]);
} else {

    echo json_encode(['status' => '203', 'message' => $conn->error]);
}
$conn->close();
?>