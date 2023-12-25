<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $admin_id = $_SESSION['id'];
    $invoice_number = $_GET['invoice_number'];
    $stmt = $conn->prepare('SELECT
    tbl_orders.img_url,
    tbl_shirt.shirt_title,
    tbl_orders.invoice_number,
    tbl_orders.name,
    tbl_orders.shirt_code,
    tbl_orders.shirt_price,
    tbl_orders.jersey_number,
    tbl_size.size,
    tbl_orders.team_name,
    tbl_jersey_type.jersey_type,
    tbl_transaction_status.transaction_status
    FROM tbl_orders
    INNER JOIN tbl_shirt ON tbl_orders.shirt_id = tbl_shirt.id
    INNER JOIN tbl_size ON tbl_orders.size_id = tbl_size.id
    INNER JOIN tbl_jersey_type ON tbl_orders.jersey_type_id = tbl_jersey_type.id
    INNER JOIN tbl_transaction_status ON tbl_orders.transaction_status_id = tbl_transaction_status.id
    WHERE tbl_orders.invoice_number = ?');
    $stmt->bind_param('s', $invoice_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $img_url = $row['img_url'];
    $shirt_title = $row['shirt_title'];
    $invoice_number = $row['invoice_number'];
    $shirt_code = $row['shirt_code'];
    $shirt_price = $row['shirt_price'];
    $team_name = $row['team_name'];
    $jersey_type = $row['jersey_type'];
    $transaction_status = $row['transaction_status'];
    if ($transaction_status === "On-cart") {
        $indicatorColor = 'bg-dark';
    }
    if ($transaction_status === "Pending") {
        $indicatorColor = 'bg-danger';
    }
    if ($transaction_status === "On-progress") {
        $indicatorColor = 'bg-warning';
    }
    if ($transaction_status === "Delivered") {
        $indicatorColor = 'bg-success';
    }
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
    </head>

    <body>
        <?php include 'top-nav.php' ?>
        <?php include 'side-nav.php' ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Client Order</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Client Order</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">
                <a href="orders.php">
                    <i class="bi bi-arrow-left"></i>&nbsp; Back
                </a>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-12">
                                <p class="d-flex align-items-end">Image: &nbsp;<span><img src="IMG/products/<?php echo $img_url; ?>" alt="" width="100" height="100"></span></p>
                                <p>Shirt Title: <span><?php echo $shirt_title ?></span> </p>
                                <p>Shirt Code: <span><?php echo $shirt_code ?></span></p>
                                <p>Price: <span><?php echo $shirt_price ?></span></p>
                                <p>Team Name: <span><?php echo $team_name ?></span></p>
                                <p>Jersey Type: <span><?php echo $jersey_type ?></span></p>
                                <p>Invoice Number: <span><?php echo $invoice_number ?></span></p>
                                <p>Status: <span class="text-white p-1 badge <?php echo $indicatorColor ?>"><?php echo $transaction_status ?></span></p>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Member Name</th>
                                                <th>Jersey Number</th>
                                                <th>Jersey Size</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                            <?php
                                            while ($order_row = $result->fetch_assoc()) {
                                                $name = $order_row['name'];
                                                $jersey_number = $order_row['jersey_number'];
                                                $size = $order_row['size'];
                                                echo '
                                            <tr>
                                                <td>' . $name . '</td>
                                                <td>' . $jersey_number . '</td>
                                                <td>' . $size . '</td>
                                            </tr>
                                            ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location: logout.php");
    exit();
}
