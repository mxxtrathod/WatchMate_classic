<?php
require('../includes/db_connection.php');

$sql = "SELECT id, image, title, description, price FROM watches";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   echo '

   <div class="table-responsive">
   <table class="table align-middle text-center shadow-sm rounded-4 overflow-hidden table-striped">
        <thead class="bg-light border-bottom table-dark">
            <tr class="text-uppercase text-muted small">
                <th scope="col" class="py-3">ID</th>
                <th scope="col" class="py-3">Image</th>
                <th scope="col" class="py-3">Title</th>
                <th scope="col" class="py-3">Description</th>
                <th scope="col" class="py-3">Price</th>
                <th scope="col" class="py-3">Action</th>
            </tr>
        </thead>
        <tbody>
        
        ';
        
while ($row = $result->fetch_assoc()) {
    echo '<tr id="row-'.$row['id'].'" class="align-middle table-row-hover">
            <td class="fw-bold text-secondary">' . $row['id'] . '</td>
            <td>
                <img src="../uploads/' . $row['image'] . '" 
                     class="rounded-circle border border-2 border-light shadow-sm" 
                     style="width: 55px; height: 55px; object-fit: cover;">
            </td>
            <td class="fw-semibold text-dark">' . $row['title'] . '</td>
            <td class="text-truncate" style="max-width: 250px;">' 
                . $row['description'] . '</td>
            <td class="text-center">
                <span class="badge rounded-pill bg-gradient bg-primary-subtle text-dark px-3 py-2 fs-6">
                    $' . $row['price'] . '
                </span>
            </td>
            <td>
                <button class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 shadow-sm delete-btn" data-id="' . $row['id'] . '">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </td>
          </tr>';
}

echo '</tbody></table></div> ';

} else {
    echo "No watches found.";
}

$conn->close();
?>

<!-- 

if ($result->num_rows > 0) {
   echo '

   <table class="table table-striped table-hover align-middle shadow-sm rounded">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        
        ';
        
while ($row = $result->fetch_assoc()) {
    echo '<tr>
            <td>' . $row['id'] . '</td>
            <td><img src="../uploads/' . $row['image'] . '" class="img-thumbnail" style="max-width: 60px;"></td>
            <td>' . $row['title'] . '</td>
            <td>' . $row['description'] . '</td>
            <td><span class="badge bg-success py-2">$ ' . $row['price'] . '</span></td>
            <td>
                <button class="btn btn-md btn-danger ms-1 delete-btn" data-id="' . $row['id'] . '">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
          </tr>';
}

echo '</tbody></table>'; -->