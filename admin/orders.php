<?php
include '../database_connection.php';
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
            <h1>Orders</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table">
                            <col width="10%">
                            <col width="8%">
                            <col width="16%">
                            <col width="8%">
                            <col width="5%">
                            <col width="8%">
                            <col width="20%">
                            <thead>
                                <tr>
                                    <th class="p-2">Image</th>
                                    <th class="p-2">Code</th>
                                    <th class="p-2">Client</th>
                                    <th class="p-2">Price</th>
                                    <th class="p-2">Quantity</th>
                                    <th class="p-2">Status</th>
                                    <th class="p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $on_cart = 1;
                                $stmt = $conn->prepare('SELECT
                                tbl_orders.img_url,
                                tbl_client.firstname,
                                tbl_client.middlename,
                                tbl_client.lastname,
                                tbl_orders.shirt_code,
                                tbl_orders.shirt_price,
                                tbl_orders.invoice_number,
                                tbl_orders.transaction_status_id,
                                COUNT(tbl_orders.invoice_number) AS total_quantity,
                                tbl_transaction_status.transaction_status
                                FROM tbl_orders
                                INNER JOIN tbl_client ON tbl_orders.client_id = tbl_client.id
                                INNER JOIN tbl_transaction_status ON tbl_orders.transaction_status_id = tbl_transaction_status.id 
                                WHERE tbl_orders.transaction_status_id <> ?
                                GROUP BY tbl_orders.invoice_number');
                                $stmt->bind_param('i', $on_cart);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $img_url = $row['img_url'];
                                    $firstname = $row['firstname'];
                                    $middlename = $row['middlename'];
                                    $lastname = $row['lastname'];
                                    $shirt_price = $row['shirt_price'];
                                    $shirt_code = $row['shirt_code'];
                                    $total_quantity = $row['total_quantity'];
                                    $transaction_status = $row['transaction_status'];
                                    $invoice_number = $row['invoice_number'];
                                    if ($transaction_status === "Pending") {
                                        $pendingIndicator = "none";
                                        $onprogressIndicator = "block";
                                        $deliveredIndicator = "none";
                                        $indicatorColor = '#ff0000';
                                    }
                                    if ($transaction_status === "On-progress") {
                                        $onprogressIndicator = "none";
                                        $pendingIndicator = "block";
                                        $deliveredIndicator = "block";
                                        $indicatorColor = '#e69d00';
                                    }
                                    if ($transaction_status === "Delivered") {
                                        $deliveredIndicator = "none";
                                        $indicatorColor = '#109d00';
                                    }
                                    echo '
                                    <tr>
                                        <td class="p-4"><img src="../IMG/products/' . $img_url . '" style="width: 90px; height: 90px" /></td>
                                        <td class="pt-4">' . $shirt_code . '</td>
                                        <td class="pt-4">' . $firstname . ' ' . $middlename . ' ' . $lastname . '</td>
                                        <td class="pt-4">' . $shirt_price . '</td>
                                        <td class="pt-4">' . $total_quantity . '</td>
                                        <td class="pt-4"><span class="text-white p-1" style="background: ' . $indicatorColor . '">' . $transaction_status . '<span></td>
                                        <td class="p-3">
                                            <div class="d-flex">
                                                <a href="client-order?invoice_number=' . $invoice_number . '">
                                                    <button class="btn btn-primary btn-sm p-2 me-1" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="../checking/pending-order?invoice_number=' . $invoice_number . '" >
                                                    <button class="btn btn-danger btn-sm p-2 me-1" style="display: ' . $pendingIndicator . '">
                                                        <i class="bi bi-exclamation-circle"></i>&nbsp;<span class="to-hide">Pending</span>
                                                    </button>
                                                </a>
                                                <a href="../checking/onprogress-order?invoice_number=' . $invoice_number . '" >
                                                    <button class="btn btn-secondary btn-sm p-2 me-1" style="display: ' . $onprogressIndicator . '">
                                                        <i class="bi bi-graph-up-arrow"></i>&nbsp;<span class="to-hide">On-progress</span>
                                                    </button>
                                                </a>
                                                <a href="../checking/delivered-order?invoice_number=' . $invoice_number . '">
                                                    <button class="btn btn-success btn-sm p-2" style="display: ' . $deliveredIndicator . '">
                                                        <i class="bi bi-check"></i>&nbsp;<span class="to-hide">Delivered</span>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
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