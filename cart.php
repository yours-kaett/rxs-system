<?php
include 'database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'includes/head.php' ?>

    <body>
        <?php include 'includes/header.php' ?>
        <main>
            <section id="page-header">
                <h2>Your Cart</h2>
            </section>
            <section class="container mt-5">
                <?php
                if (isset($_GET['success'])) {
                ?>
                    <span class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                        <span><?php echo $_GET['success'], 'Order placed successfully.' ?></span>
                        <a href="cart.php" class="btn-close"></a>
                    </span>
                <?php
                }
                ?>
                <div class="row ms-1">
                    <div class="col-lg-8 mb-5">
                        <?php
                        $stmt = $conn->prepare(' SELECT * FROM tbl_orders WHERE client_id = ? ');
                        $stmt->bind_param('i', $client_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if (empty(mysqli_num_rows($result))) {
                            echo
                            '
                            <div class="d-flex align-items-center justify-content-center mb-5">
                                <p>Your cart is empty. 
                                    <a href="shop.php">
                                        <button class="btn btn-primary p-3">Shop now!</button>
                                    </a>
                                </p>
                            </div>
                            <script>
                                document.getElementById("cart-add").style.display = "none";
                            </script>
                            ';
                        } else {
                            $stmt = $conn->prepare(
                                ' SELECT 
                            tbl_orders.id,
                            tbl_orders.invoice_number,
                            tbl_orders.img_url,
                            tbl_shirt.shirt_title,
                            tbl_orders.shirt_code, 
                            tbl_orders.shirt_price,
                            SUM(tbl_orders.shirt_price) AS total_payment,
                            tbl_orders.team_name,
                            tbl_jersey_type.jersey_type,
                            COUNT(tbl_orders.invoice_number) AS total_quantity,
                            tbl_transaction_status.transaction_status
                            FROM tbl_orders
                            INNER JOIN tbl_shirt ON tbl_orders.shirt_id = tbl_shirt.id
                            INNER JOIN tbl_jersey_type ON tbl_orders.jersey_type_id = tbl_jersey_type.id
                            INNER JOIN tbl_transaction_status ON tbl_orders.transaction_status_id = tbl_transaction_status.id
                            WHERE tbl_orders.client_id = ? GROUP BY tbl_orders.invoice_number ORDER BY tbl_orders.id DESC '
                            );
                            $stmt->bind_param('i', $client_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                        ?>
                            <form action="checking/client-order.php" method="POST">
                            <?php
                            while ($rows = $result->fetch_assoc()) {
                                $img_url = $rows['img_url'];
                                $shirt_title = $rows['shirt_title'];
                                $shirt_code = $rows['shirt_code'];
                                $shirt_price = $rows['shirt_price'];
                                $team_name = $rows['team_name'];
                                $jersey_type = $rows['jersey_type'];
                                $invoice_number = $rows['invoice_number'];
                                $total_quantity = $rows['total_quantity'];
                                $total_payment = $rows['total_payment'];
                                $transaction_status = $rows['transaction_status'];
                                if ($transaction_status === "On-cart") {
                                    $indicatorColor = '#000';
                                }
                                if ($transaction_status === "Pending") {
                                    $indicatorColor = '#ff0000';
                                }
                                if ($transaction_status === "On-progress") {
                                    $indicatorColor = '#ffae00';
                                }
                                if ($transaction_status === "Ordered") {
                                    $indicatorColor = '#109d00';
                                }
                                echo '
                                        <div class="row cart-bg rounded p-3 mb-3">
                                            <div class="col-lg-1 col-md-1 col-sm-1 mt-2 d-flex align-items-center">
                                                <input type="checkbox" name="invoice_number[' . $invoice_number . ']" value="' . $invoice_number . '" id="select' . $invoice_number . '" class="form-check-input border" style="cursor: pointer;" />
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 mt-2 d-flex align-items-center">
                                                <img src="IMG/products/' . $img_url . '" alt="' . $img_url . '" style="width: 100%; height: 100%;">
                                                </div>
                                            <div class="col-lg-7 col-md-12 ms-2">
                                                <div class="d-flex flex-column">
                                                    <span class="fs-5 fw-bold mt-2">' . $shirt_title . '</span>
                                                    <span class="fs-5 fw-bold">₱ ' . $shirt_price . '</span>
                                                    <span class="fs-6 mt-1">Code: ' . $shirt_code . '</span>
                                                    <span class="fs-6">Team Name: ' . $team_name . '</span>
                                                    <span class="fs-6">Type: ' . $jersey_type . '</span>
                                                    <span class="d-flex align-items-center justify-content-between">
                                                        <span class="fs-5 fw-bold" id="t-quantity" style="color: ' . $indicatorColor . '">' . $total_quantity . ' items</span>
                                                        <span class="fs-5 fw-bold" id="t-payment" style="visibility: hidden;">' . $total_payment . '</span>
                                                        <a href="cart-details.php?invoice=' . $invoice_number . '">
                                                            <button class="add-cart-btn" type="button">
                                                                <i class="bi bi-eye"></i>&nbsp; View Cart Details
                                                            </button>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                            }
                        }
                            ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="card p-3">
                            <div class="row g-2">
                                <div class="col-lg-12 mb-2">
                                    <h5 class="fw-bold">Location</h5>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <span><i class="bi bi-geo-alt"></i>&nbsp; Current Address</span>
                                </div>
                                <hr class="my-3" />
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <h5>Quantity</h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5># </h5>
                                                <input type="number" id="total-quantity" name="" value="0" class="ms-3 mb-2" style="background: none; outline: none; border: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <h5>Total Payment</h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <h5>₱ </h5>
                                                <input type="number" id="total-payment" name="" value="0" class="ms-3 mb-2" style="background: none; outline: none; border: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="add-cart-btn mt-3" type="submit" id="submit" style="visibility: hidden;">
                                <i class="bi bi-basket"></i>&nbsp; Order now
                            </button>
                            </form>
                            <p class="mt-4"><em>Note: <br /> For order confirmation, please pay downpayment with half of the total payment</em></p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php include 'includes/footer.php' ?>
        <script src="script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var checkboxes = document.querySelectorAll('[type="checkbox"]');
                var totalQuantity = document.getElementById("total-quantity");
                var totalPayment = document.getElementById("total-payment");
                var submit = document.getElementById("submit");

                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener("change", function() {
                        updateTotalQuantity();
                    });
                });

                function updateTotalQuantity() {
                    var checkedCheckboxes = document.querySelectorAll('[type="checkbox"]:checked');
                    var sumQuantity = 0;
                    var sumPayment = 0;
                    submit.style.visibility = "hidden";

                    checkedCheckboxes.forEach(function(checkbox) {
                        var parentRow = checkbox.closest('.row');
                        var quantityElement = parentRow.querySelector('#t-quantity');
                        var priceElement = parentRow.querySelector('#t-payment');

                        var quantity = parseInt(quantityElement.textContent);
                        var price = parseFloat(priceElement.textContent.replace('₱', '').trim());

                        sumQuantity += quantity;
                        sumPayment += +price;
                    });

                    totalQuantity.value = sumQuantity;
                    totalPayment.value = sumPayment;
                    if (sumQuantity > 0) {
                        submit.style.visibility = "visible";
                    }
                }

            });
        </script>
    </body>

    </html>

<?php
} else {
    header("Location: client-login.php");
    exit();
}
