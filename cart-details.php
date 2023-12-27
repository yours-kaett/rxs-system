<?php
include 'database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
    $get_invoice = $_GET['invoice'];
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'includes/head.php' ?>

    <body>
        <?php include 'includes/header.php' ?>
        <section id="page-header">
            <h2>Cart Details</h2>
        </section>
        <section class="container mt-5">
            <div class="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $stmt = $conn->prepare(' SELECT
                            tbl_orders.img_url,
                            tbl_orders.shirt_id,
                            tbl_orders.invoice_number,
                            tbl_orders.team_name,
                            tbl_transaction_status.transaction_status
                            FROM tbl_orders
                            INNER JOIN tbl_transaction_status ON tbl_orders.transaction_status_id = tbl_transaction_status.id
                            WHERE client_id = ? AND invoice_number = ?');
                            $stmt->bind_param('is', $client_id, $get_invoice);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            $shirt_id = $row['shirt_id'];
                            $invoice_number = $row['invoice_number'];
                            $team_name = $row['team_name'];
                            $transaction_status = $row['transaction_status'];
                            $img_url = $row['img_url'];
                            if ($transaction_status === "On-cart") {
                                $visibility = 'hidden';
                                $btn_visibility = 'visible';
                            }
                            if ($transaction_status === "Pending") {
                                $indicatorColor = '#ff0000';
                                $visibility = 'visible';
                                $btn_visibility = 'visible';
                            }
                            if ($transaction_status === "On-progress") {
                                $indicatorColor = '#ffae00';
                                $visibility = 'hidden';
                                $btn_visibility = 'hidden';
                            }
                            if ($transaction_status === "Delivered") {
                                $indicatorColor = '#109d00';
                                $visibility = 'hidden';
                                $btn_visibility = 'hidden';
                            }
                            echo "
                                <a href='details.php?id=$shirt_id'>
                                    <img src='IMG/products/$img_url' alt='$img_url' width='200' height='200' class='my-3'>
                                </a>
                                <h3>Team Name: $team_name</h3>
                                <h3>Invoice Number: $invoice_number</h3>
                                <h3>Transaction Status: 
                                    <span style='color: $indicatorColor'>$transaction_status</span>
                                    <span>
                                        <button style='visibility: $visibility' class='btn' type='button' data-bs-toggle='modal' data-bs-target='#changeModal'>Change</button>
                                    </span>
                                </h3>
                                <div class='modal fade' id='changeModal' tabindex='-1' aria-labelledby='changeModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content p-1'>
                                            <form action='checking/client-change-order.php?invoice_number=$invoice_number' method='post' class='row p-2 needs-validation' novalidate>
                                                <div class='modal-header'>
                                                    <h1 class='modal-title fs-5' id='changeModalLabel'>Orders</h1>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p>Are you sure you want to cancel order?</p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>No</button>
                                                    <button type='submit' class='btn btn-primary' id='loaderButton'>
                                                        <span id='submitBlank'>
                                                            <span id='submit'>Yes</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            ";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive rounded">
                <table class="table">
                    <colgroup>
                        <col width="30%">
                        <col width="25%">
                        <col width="30%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="p-4">Member Name</th>
                            <th class="p-4">Jersey #</th>
                            <th class="p-4">Jersey Size</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare(' SELECT 
                            tbl_orders.id,
                            tbl_orders.name,
                            tbl_orders.jersey_number, 
                            tbl_orders.size_id, 
                            tbl_size.size,
                            tbl_orders.shirt_id,
                            tbl_orders.invoice_number,
                            tbl_transaction_status.transaction_status,
                            tbl_shirt.shirt_title,
                            tbl_jersey_type.jersey_type,
                            tbl_orders.client_id
                            FROM tbl_orders 
                            INNER JOIN tbl_size ON tbl_orders.size_id = tbl_size.id
                            INNER JOIN tbl_transaction_status ON tbl_orders.transaction_status_id = tbl_transaction_status.id
                            INNER JOIN tbl_shirt ON tbl_orders.shirt_id = tbl_shirt.id
                            INNER JOIN tbl_jersey_type ON tbl_orders.jersey_type_id = tbl_jersey_type.id
                            WHERE tbl_orders.client_id = ? AND tbl_orders.invoice_number = ? ');
                        $stmt->bind_param('is', $client_id, $get_invoice);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($rows = $result->fetch_assoc()) {
                            $id = $rows['id'];
                            $shirt_id = $rows['shirt_id'];
                            $name = $rows['name'];
                            $jersey_number = $rows['jersey_number'];
                            $size = $rows['size'];
                            $size_id = $rows['size_id'];
                            $transaction_status = $rows['transaction_status'];
                            $shirt_title = $rows['shirt_title'];
                            $jersey_type = $rows['jersey_type'];
                            echo '
                                <tr>
                                    <td class="p-4">' . $name . '</td>
                                    <td class="p-4">' . $jersey_number . '</td>
                                    <td class="p-4">' . $size . '</td>
                                    <td class="p-4">
                                        <button class="btn btn-danger p-2" title="Remove" style="visibility: '.$btn_visibility.';" id="btn-remove" data-bs-toggle="modal" data-bs-target="#deleteModal' . $id . '">
                                            <i class="bi bi-trash"></i>&nbsp; Remove
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteModal' . $id . '" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content p-1">
                                            <form action="checking/remove-member-check.php?id=' . $id . '" method="post" class="row p-2 needs-validation" novalidate>
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Remove Member</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to remove ' . $name . '?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" id="loaderButton">Yes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <?php include 'includes/footer.php' ?>
        <script src="script.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: client-login.php");
    exit();
}
