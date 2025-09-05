<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-header {
      background: #3c4b64;
      color: #fff;
      font-size: 20px;
      font-weight: bold;
    }
    .status-delivered {
      color: green;
      font-weight: 500;
    }
    .status-shipped {
      color: #0dcaf0;
      font-weight: 500;
    }
    .status-cancelled {
      color: red;
      font-weight: 500;
    }
    .status-pending {
      color: orange;
      font-weight: 500;
    }
    .customer-img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }
    .table td, .table th {
      vertical-align: middle;
    }
    .pagination .page-link {
      color: #3c4b64;
    }
    .pagination .active .page-link {
      background-color: #3c4b64;
      border-color: #3c4b64;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span>Order <b>Details</b></span>
      <div>
        <button class="btn btn-sm btn-light me-2"><i class="bi bi-file-earmark-excel"></i> Export to Excel</button>
        <button class="btn btn-sm btn-primary"><i class="bi bi-arrow-clockwise"></i> Refresh List</button>
      </div>
    </div>
    <div class="card-body">
      <!-- Filters -->
      <div class="row mb-3">
        <div class="col-md-2">
          <select class="form-select form-select-sm">
            <option>5</option>
            <option>10</option>
            <option>25</option>
          </select>
        </div>
        <div class="col-md-2">
          <select class="form-select form-select-sm">
            <option>Status Any</option>
            <option>Delivered</option>
            <option>Shipped</option>
            <option>Pending</option>
            <option>Cancelled</option>
          </select>
        </div>
        <div class="col-md-2">
          <select class="form-select form-select-sm">
            <option>Location All</option>
            <option>London</option>
            <option>Madrid</option>
            <option>Berlin</option>
            <option>New York</option>
          </select>
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control form-control-sm" placeholder="Search by Name">
        </div>
        <div class="col-md-1">
          <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i></button>
        </div>
      </div>

      <!-- Table -->
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Location</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Net Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><img src="https://i.pravatar.cc/50?img=12" class="customer-img"> Michael Holz</td>
            <td>London</td>
            <td>Jun 15, 2017</td>
            <td class="status-delivered"><i class="bi bi-circle-fill"></i> Delivered</td>
            <td>$254</td>
            <td><button class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-right"></i></button></td>
          </tr>
          <tr>
            <td>2</td>
            <td><img src="https://i.pravatar.cc/50?img=5" class="customer-img"> Paula Wilson</td>
            <td>Madrid</td>
            <td>Jun 21, 2017</td>
            <td class="status-shipped"><i class="bi bi-circle-fill"></i> Shipped</td>
            <td>$1,260</td>
            <td><button class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-right"></i></button></td>
          </tr>
          <tr>
            <td>3</td>
            <td><img src="https://i.pravatar.cc/50?img=33" class="customer-img"> Antonio Moreno</td>
            <td>Berlin</td>
            <td>Jul 04, 2017</td>
            <td class="status-cancelled"><i class="bi bi-circle-fill"></i> Cancelled</td>
            <td>$350</td>
            <td><button class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-right"></i></button></td>
          </tr>
          <tr>
            <td>4</td>
            <td><img src="https://i.pravatar.cc/50?img=60" class="customer-img"> Mary Saveley</td>
            <td>New York</td>
            <td>Jul 16, 2017</td>
            <td class="status-pending"><i class="bi bi-circle-fill"></i> Pending</td>
            <td>$1,572</td>
            <td><button class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-right"></i></button></td>
          </tr>
          <tr>
            <td>5</td>
            <td><img src="https://i.pravatar.cc/50?img=21" class="customer-img"> Martin Sommer</td>
            <td>Paris</td>
            <td>Aug 04, 2017</td>
            <td class="status-delivered"><i class="bi bi-circle-fill"></i> Delivered</td>
            <td>$580</td>
            <td><button class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-right"></i></button></td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="d-flex justify-content-between align-items-center">
        <small>Showing 5 out of 25 entries</small>
        <nav>
          <ul class="pagination pagination-sm mb-0">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item active"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
