<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare('SELECT
    tbl_customize.id,
    tbl_customize.bg_color,
    tbl_customize.name_input,
    tbl_customize.name_direction,
    tbl_customize.team_name_direction,
    tbl_customize.number_input,
    tbl_customize.number_direction,
    tbl_customize.logo,
    tbl_customize.pattern,
    tbl_customize.font,
    tbl_customize.team_name_input,
    tbl_client.firstname,
    tbl_client.middlename,
    tbl_client.lastname,
    tbl_transaction_status.transaction_status
    FROM tbl_customize
    INNER JOIN tbl_client ON tbl_customize.client_id = tbl_client.id
    INNER JOIN tbl_transaction_status ON tbl_customize.transaction_status_id = tbl_transaction_status.id
    WHERE tbl_customize.id = ?
    ORDER BY tbl_customize.id DESC ');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $bg_color = $row['bg_color'];
    $name_input = $row['name_input'];
    $name_direction = $row['name_direction'];
    $team_name_direction = $row['team_name_direction'];
    $number_input = $row['number_input'];
    $number_direction = $row['number_direction'];
    $logo = $row['logo'];
    $pattern = $row['pattern'];
    $font = $row['font'];
    $team_name_input = $row['team_name_input'];
    $firstname = $row['firstname'];
    $middlename = $row['middlename'];
    $lastname = $row['lastname'];
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
        <title>Web-based Customized Apparel Design and Ordering System</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link href="../assets/img/logo.png" rel="icon">
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
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
                <a href="customize-orders.php">
                    <i class="bi bi-arrow-left"></i>&nbsp; Back
                </a>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-12">
                                <p>Team Name: <span><?php echo $team_name_input ?></span></p>
                                <p>Client Name: <span><?php echo $firstname . ' ' . $middlename . ' ' . $lastname; ?></span></p>
                                <p>Status: <span class="text-white p-1 badge <?php echo $indicatorColor ?>"><?php echo $transaction_status ?></span></p>
                            </div>
                            <div class="col-lg-12">
                                <?php
                                echo '
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 relative">
                                        <h5 style="position: relative;">Front</h5>
                                        <div style="position: relative;">
                                            <input type="number" value="' . $number_input . '" style="font-family: ' . $font . '; ' . $number_direction . '" />
                                            <input type="text" value="' . $team_name_input . '" style="background: transparent; font-size: 15px; font-family: ' . $font . '; ' . $team_name_direction . '" />
                                            <i class="bx bxs-t-shirt shirts" style="color: ' . $bg_color . '; position: relative;"></i>
                                            <img src="IMG/logos/' . $logo . '" style="position: relative; 
                                                        right: 170px; bottom: 85px; width: 80px; 
                                                        z-index: 1; border-radius: 50%;" alt="">
                                            <img id="pattern1" src="IMG/patterns/' . $pattern . '" style="position: relative; 
                                                        left: 5px; bottom: 260px; width: 240px; 
                                                        height: 300px; mix-blend-mode: overlay; opacity: 30%;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 relative">
                                        <h5 style="position: relative;">Back</h5>
                                        <div style="position: relative;">
                                            <input type="text" value="' . $name_input . '" style="font-size: 15px; font-family: ' . $font . '; ' . $name_direction . '">
                                            <i class="bx bxs-t-shirt shirts mt-4" id="back" style="color: ' . $bg_color . '; position: relative;"></i>
                                            <input type="text" value="' . $number_input . '" style="font-family: ' . $font . ';" id="number-position-back">
                                            <img id="pattern2" src="IMG/patterns/' . $pattern . '" style=" position: relative; 
                                                        left: 5px; bottom: 332px; width: 240px; 
                                                        height: 300px; mix-blend-mode: overlay; opacity: 30%;" alt="">
                                        </div>
                                    </div>
                                </div>
                                ';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/main.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location: logout.php");
    exit();
}
