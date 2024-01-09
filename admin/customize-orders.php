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

            <div class="pagetitle">
                <h1>Customize Orders</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Customize Orders</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <thead>
                                    <tr>
                                        <th class="p-2">Logo</th>
                                        <th class="p-2">Team Name</th>
                                        <th class="p-2">Client</th>
                                        <th class="p-2">Status</th>
                                        <th class="p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $on_cart = 1;
                                    $stmt = $conn->prepare(
                                    'SELECT
                                    tbl_customize.id,
                                    tbl_customize.logo,
                                    tbl_customize.team_name_input,
                                    tbl_client.firstname,
                                    tbl_client.middlename,
                                    tbl_client.lastname,
                                    tbl_transaction_status.transaction_status
                                    FROM tbl_customize
                                    INNER JOIN tbl_client ON tbl_customize.client_id = tbl_client.id
                                    INNER JOIN tbl_transaction_status ON tbl_customize.transaction_status_id = tbl_transaction_status.id
                                    WHERE tbl_customize.transaction_status_id <> ?
                                    ORDER BY tbl_customize.id DESC '
                                    );
                                    $stmt->bind_param('i', $on_cart);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        $logo = $row['logo'];
                                        $team_name_input = $row['team_name_input'];
                                        $firstname = $row['firstname'];
                                        $middlename = $row['middlename'];
                                        $lastname = $row['lastname'];
                                        $transaction_status = $row['transaction_status'];
                                        if ($transaction_status === "Pending") {
                                            $pendingIndicator = "none";
                                            $onprogressIndicator = "block";
                                            $deliveredIndicator = "none";
                                            $indicatorColor = 'bg-danger';
                                        }
                                        if ($transaction_status === "On-progress") {
                                            $onprogressIndicator = "none";
                                            $pendingIndicator = "block";
                                            $deliveredIndicator = "block";
                                            $indicatorColor = 'bg-warning text-primary';
                                        }
                                        if ($transaction_status === "Delivered") {
                                            $deliveredIndicator = "none";
                                            $indicatorColor = 'bg-success';
                                            $onprogressIndicator = "block";
                                            $pendingIndicator = "none";
                                        }
                                        echo '
                                    <tr>
                                        <td class="p-4"><img src="IMG/logos/' . $logo . '" style="width: 90px; height: 90px" /></td>
                                        <td class="pt-4">' . $team_name_input . '</td>
                                        <td class="pt-4">' . $firstname . ' ' . $middlename . ' ' . $lastname . '</td>
                                        <td class="pt-4"><span class="badge ' . $indicatorColor . '">' . $transaction_status . '<span></td>
                                        <td class="p-3">
                                            <div class="d-flex">
                                                <a href="client-customize-order?id=' . $id . '">
                                                    <button class="btn btn-primary btn-sm p-2 me-1" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="checking/pending-customize-order?id=' . $id . '" >
                                                    <button class="btn btn-danger btn-sm p-2 me-1" style="display: ' . $pendingIndicator . '">
                                                        <i class="bi bi-exclamation-circle"></i>&nbsp;<span class="to-hide">Pending</span>
                                                    </button>
                                                </a>
                                                <a href="checking/onprogress-customize-order?id=' . $id . '" >
                                                    <button class="btn btn-secondary btn-sm p-2 me-1" style="display: ' . $onprogressIndicator . '">
                                                        <i class="bi bi-graph-up-arrow"></i>&nbsp;<span class="to-hide">On-progress</span>
                                                    </button>
                                                </a>
                                                <a href="checking/delivered-customize-order?id=' . $id . '">
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

<?php
} else {
    header("Location: logout.php");
    exit();
}
