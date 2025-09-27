<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/images/logo/web_logo_tab.png">

</head>

<body>

    <!-- Sidebar -->
    <?php require('../includes/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        <div id="dashboardSection">
            <div class="container-fluid py-2">
                <div class="p-4 bg-white shadow-sm rounded mb-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-shop fs-2 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-1 fw-bold">
                                Welcome back, Admin
                            </h5>
                            <p class="mb-0 text-muted">Manage and grow your business with YourApp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require '../includes/db_connection.php';

        // Query to count total watches
        $sql = "SELECT COUNT(*) AS total_watches FROM watches";
        $result = $conn->query($sql);

        $total_watches = 0;
        if ($result && $row = $result->fetch_assoc()) {
            $total_watches = $row['total_watches'];
        }

        // Query to count total users
        $sql_users = "SELECT COUNT(*) AS total_users FROM tbl_user";
        $result_users = $conn->query($sql_users);
        $total_users = 0;
        if ($result_users && $row_users = $result_users->fetch_assoc()) {
            $total_users = $row_users['total_users'];
        }

        // Query to count total Orders
        $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders";
        $result_orders = $conn->query($sql_orders);

        $total_orders = 0;
        if ($result_orders && $row_orders = $result_orders->fetch_assoc()) {
            $total_orders = $row_orders['total_orders'];
        }
        ?>

        <div class="container ">
            <div class="row g-4">
                <!-- Watches Card -->
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="icon-circle watch-icon">
                            <i class="bi bi-watch"></i>
                        </div>
                        <h5>Watches</h5>
                        <h5 class="fw-medium"> <?php echo $total_watches; ?></h5>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="icon-circle user-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5>Users</h5>
                        <h5 class="fw-medium"> <?php echo $total_users; ?></h5>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="icon-circle order-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5>Orders</h5>
                        <h5 class="fw-medium"> <?php echo $total_orders; ?></h5>
                    </div>
                </div>

                <!-- Reports Card (extra) -->
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="icon-circle report-icon">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                        <h5>Reports</h5>
                        <p class="text-muted">View sales and business reports</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>