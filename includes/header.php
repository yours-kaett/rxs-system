<?php
include '../database_connection.php';
session_start();
$client_id = $_SESSION['id'];
?>
<header id="header">
    <a href="#"><img src="IMG/LOGO.png" class="logo"></a>
    <div class="navbar">
        <ul id="navbar">
            <li>
                <a href="index.php">
                    <i class="bi bi-house"></i>&nbsp; Home
                </a>
            </li>
            <li>
                <a href="shop.php">
                    <i class="bi bi-basket"></i>&nbsp; Shop
                </a>
            </li>
            <li>
                <a href="cart.php" class="position-relative">
                    <span class="cart-notif" id="cart-notif">
                        <?php
                        $stmt = $conn->prepare(' SELECT * FROM tbl_orders WHERE client_id = ? GROUP BY invoice_number ');
                        $stmt->bind_param('i', $client_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $cart_quantity = mysqli_num_rows($result);
                        if ($cart_quantity > 0) {
                            echo $cart_quantity;
                        } else {
                            echo '
                            <script>
                                document.getElementById("cart-notif").style.display = "none";
                            </script>';
                        }
                        ?>
                    </span>
                    <i class="bi bi-cart"></i>&nbsp; Cart
                </a>
            </li>
            <li>
                <a href="contact.php">
                    <i class="bi bi-telephone"></i>&nbsp; Contact
                </a>
            </li>

            <li class="dropdown">
                <a class="d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <span class="dropdown-toggle">More</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="customize.php">
                            <i class="bi bi-columns-gap"></i>
                            &nbsp; Customize
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="my-customize.php">
                            <i class="bi bi-columns"></i>
                            &nbsp; My Saved Designs
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="account.php">
                            <i class="bi bi-person-circle"></i>
                            &nbsp; Account
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="logout.php">
                            <i class="bi bi-power"></i>
                            &nbsp; Signout
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li>
        </ul>
    </div>
    <!-- <div id="mobile">
        <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
        <i id="bar">Menu</i>
    </div> -->
</header>