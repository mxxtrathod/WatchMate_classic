<?php
require ('../includes/db_connection.php');

$sql = "SELECT id, image, title, description, price FROM watches";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   echo '

   <div class="table-responsive">
   <table class="table align-middle text-center shadow-sm rounded-4 overflow-hidden table-striped">
        <thead class="bg-light border-bottom table-dark tbl">
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
    echo '<tr class="align-middle table-row-hover">
            <td class="fw-bold text-secondary">' . $row['id'] . '</td>
            <td>
                <img src="../uploads/' . $row['image'] . '" 
                     class="rounded-circle border border-2 border-light shadow-sm watch-image" 
                     style="width: 55px; height: 55px; object-fit: cover;">
            </td>
            <td class="fw-semibold text-dark">' . $row['title'] . '</td>
            <td class="text-truncate" style="max-width: 250px;">' 
                . $row['description'] . '</td>
            <td>
                <span class="badge rounded-pill bg-gradient bg-primary-subtle text-dark px-3 py-2 fs-6">
                    $' . $row['price'] . '
                </span>
            </td>
            <td>
                <button class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="editWatch(' . $row['id'] . ')">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </td>
          </tr>';
}

echo '</tbody></table></div>
';


} else {
    echo "No watches found.";
}

$conn->close();
?>