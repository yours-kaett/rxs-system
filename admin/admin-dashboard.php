<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
  $admin_id = $_SESSION['id'];
  $stmt = $conn->prepare(' SELECT * FROM tbl_orders');
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $orders_updated_at = $row['updated_at'];
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>RXS - Admin Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/logo.png" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
      .chart-container {
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
      }
    </style>
  </head>

  <body>
    <?php include 'top-nav.php' ?>
    <?php include 'side-nav.php' ?>

    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </nav>
      </div>

      <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">

              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">My Sales</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3">
                        <?php
                        $transaction_status = 1;
                        $stmt = $conn->prepare('SELECT transaction_status_id, SUM(shirt_price) AS sales FROM tbl_orders WHERE transaction_status_id <> ?');
                        $stmt->bind_param('i', $transaction_status);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $sales_row = $result->fetch_assoc();
                        $sales = $sales_row['sales'];
                        $stmt->close();
                        ?>
                        <h6>₱ <?php echo $sales ?></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <h5 class="card-title">My Orders</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart"></i>
                      </div>
                      <div class="ps-3">
                        <div class="d-flex align-items-center flex-start">
                          <?php
                          $transaction_status = 1;
                          $stmt = $conn->prepare('SELECT * FROM tbl_orders WHERE transaction_status_id <> ? GROUP BY invoice_number');
                          $stmt->bind_param('i', $transaction_status);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $orders_row = $result->fetch_assoc();
                          $orders = mysqli_num_rows($result);
                          if ($orders <= 1) {
                            echo "<h6>$orders Cart</h6>";
                          } else {
                            echo "<h6>$orders Carts</h6>";
                          }
                          ?>
                          <a href="orders.php">
                            <button class="btn btn-primary ms-3">
                              <i class="bi bi-eye"></i>&nbsp; View
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">
                  <div class="card-body">
                    <h5 class="card-title">My Customers</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        <div class="d-flex align-items-center flex-start">
                          <?php
                          $stmt = $conn->prepare('SELECT COUNT(username) AS clients FROM tbl_client');
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_assoc();
                          $clients = $row['clients'];
                          $stmt->close();
                          ?>
                          <h6><?php echo $clients ?> People</h6>
                          <a href="clients.php">
                            <button class="btn btn-primary ms-3">
                              <i class="bi bi-eye"></i>&nbsp; View
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Orders Statistical Analysis</h5>
                    <div class="px-4 chart-container">
                      <div style="width: 100%;">
                        <canvas id="ordersChart"></canvas>
                      </div>
                      <?php
                      $transaction_status = 1;
                      $stmt = $conn->prepare('SELECT 
                      transaction_status_id, 
                      invoice_number,
                      COUNT(invoice_number) AS orders,
                      updated_at 
                      FROM tbl_orders 
                      WHERE transaction_status_id <> ? 
                      GROUP BY invoice_number
                      ORDER BY updated_at ');
                      $stmt->bind_param('i', $transaction_status);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      if ($result->num_rows > 0) {
                        $orders_updated_at = [];
                        $orders = [];
                        while ($row = $result->fetch_assoc()) {
                          $orders_updated_at[] = $row['updated_at'];
                          $orders[] = $row['orders'];
                        }
                      } else {
                        echo "You have an empty orders.";
                      }
                      $stmt->close();
                      ?>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales overflow-auto">
                  <div class="card-body">
                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">Invoice #</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><a href="#">#2457</a></th>
                          <td>Brandon Jacob</td>
                          <td>Volleyball Jersey - Full Sublimation </td>
                          <td>₱ 200</td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2147</a></th>
                          <td>Bridie Kessler</td>
                          <td>Basketball Jersey - Full Sublimation</td>
                          <td>₱ 200</td>
                          <td><span class="badge bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2049</a></th>
                          <td>Ashleigh Langosh</td>
                          <td>Volleyball Jersey - Full Sublimation</td>
                          <td>₱ 200</td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2644</a></th>
                          <td>Angus Grady</td>
                          <td>Basketball Jersey - Full Sublimation</td>
                          <td>₱ 200</td>
                          <td><span class="badge bg-danger">Rejected</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2644</a></th>
                          <td>Raheem Lehner</td>
                          <td>Volleyball Jersey - Full Sublimation</td>
                          <td>₱ 200</td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      var hexColors = [
        '#3498db', '#2ecc71', '#e74c3c', '#f39c12', '#9b59b6',
        '#1abc9c', '#d35400', '#34495e', '#95a5a6', '#c0392b'
      ];
      var ctx = document.getElementById('ordersChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($orders_updated_at); ?>,
          datasets: [{
            label: 'Orders',
            data: <?php echo json_encode($orders); ?>,
            backgroundColor: '#3498db',
            borderWidth: 2,
          }]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          scales: {
            x: {
              type: 'category',
              maxBarThickness: 50,
            },
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>

  </body>

  </html>

<?php
} else {
  header("Location: logout.php");
  exit();
}
