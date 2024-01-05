<?php
include 'database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
?>
    <?php include 'includes/head.php' ?>

    <body>
        <?php include 'includes/header.php' ?>
        <section id="page-header">
            <h2>#Play With Passion</h2>
            <p>Save up to 30% in 10-20 pairs</p>
        </section>
        <section class="p-4">
            <div class="row" id="products">
                <?php
                $stmt = $conn->prepare(' SELECT * FROM tbl_shirt ');
                $stmt->execute();
                $result = $stmt->get_result();
                while ($rows = $result->fetch_assoc()) {
                    echo '
                    <div class="col-lg-2 col-md-4 col-sm-12">
                        <a href="details.php?id=' . $rows['id'] . '" class="shirt-card">
                            <div class="card border">
                                <img src="IMG/products/' . $rows['img_url'] . '" height="230" width="230" alt="...">
                                <div class="card-body">
                                    <h5 class="mt-2">' . $rows['shirt_title'] . '</h5>
                                    <span>Code: ' . $rows['shirt_code'] . '</span><br />
                                    <span>Cost: ₱ ' . $rows['shirt_price'] . '</span>
                                </div>
                            </div>
                        </a>
                    </div>
                ';
                }
                ?>
            </div>
        </section>
        <?php include 'includes/footer.php' ?>
        <script src="script.js"></script>
        <!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
    </body>

    </html>

<?php
} else {
    header("Location: client-login.php");
    exit();
}
