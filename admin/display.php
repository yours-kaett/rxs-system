<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $admin_id = $_SESSION['id'];
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
            <div class="d-flex align-items-center justify-content-between">
                <div class="pagetitle">
                    <h1>Display</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Display</li>
                        </ol>
                    </nav>
                </div>
                <button class="btn btn-primary rounded-0" type="button" data-bs-toggle="modal" data-bs-target="#addmodal">
                    <i class="bi bi-plus-lg"></i>&nbsp; Add Product
                </button>
            </div>

            <section class="section dashboard">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table p-5">
                                        <col width="3%">
                                        <col width="15%">
                                        <col width="5%">
                                        <col width="5%">
                                        <col width="8%">
                                        <col width="10%">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Code</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Jersey Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare('SELECT 
                                    tbl_shirt.id,
                                    tbl_shirt.img_url,
                                    tbl_shirt.shirt_title,
                                    tbl_shirt.shirt_code,
                                    tbl_shirt.shirt_price,
                                    tbl_shirt_category.shirt_category,
                                    tbl_jersey_type.jersey_type
                                    FROM tbl_shirt
                                    INNER JOIN tbl_shirt_category ON tbl_shirt.shirt_category_id = tbl_shirt_category.id
                                    INNER JOIN tbl_jersey_type ON tbl_shirt.jersey_type_id = tbl_jersey_type.id
                                    ');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $img_url = $row['img_url'];
                                                $shirt_title = $row['shirt_title'];
                                                $shirt_code = $row['shirt_code'];
                                                $shirt_price = $row['shirt_price'];
                                                $shirt_category = $row['shirt_category'];
                                                $jersey_type = $row['jersey_type'];
                                                echo '
                                        <tr>
                                            <td><img src="../IMG/products/' . $img_url . '" width="100" height="100" /></td>
                                            <td>' . $shirt_title . '</td>
                                            <td>' . $shirt_code . '</td>
                                            <td>' . $shirt_price . '</td>
                                            <td>' . $shirt_category . '</td>
                                            <td>' . $jersey_type . '</td>
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
                <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-3">
                            <form action="checking/add-product-check.php" method="post" enctype="multipart/form-data" class="row">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addmodalLabel">Add Product Display</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 mb-2">
                                        <label for="shirt_title">Shirt Title</label>
                                        <input type="text" name="shirt_title" class="form-control" id="shirt_title" required />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="shirt_code">Shirt Code</label>
                                        <input type="text" name="shirt_code" class="form-control" id="shirt_code" required />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="shirt_price">Shirt Price</label>
                                        <input type="number" name="shirt_price" class="form-control" id="shirt_price" required />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="img_url">Image</label>
                                        <input type="file" name="img_url" class="form-control" id="img_url" required />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="schirt_category_id">Shirt Category</label>
                                        <select name="schirt_category_id" id="schirt_category_id" class="form-select">
                                            <option disabled selected>-select-</option>
                                            <?php
                                            $stmt = $conn->prepare('SELECT * FROM tbl_shirt_category');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $shirt_category = $row['shirt_category'];
                                                echo "<option value='$id'>$shirt_category</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="jersey_type_id">Jersey Type</label>
                                        <select name="jersey_type_id" id="jersey_type_id" class="form-select">
                                            <option disabled selected>-select-</option>
                                            <?php
                                            $stmt = $conn->prepare('SELECT * FROM tbl_jersey_type');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $jersey_type = $row['jersey_type'];
                                                echo "<option value='$id'>$jersey_type</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="loaderButton">
                                        <span id="submitBlank">
                                            <span id="submit">Save</span>
                                        </span>
                                    </button>
                                </div>
                            </form>
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
