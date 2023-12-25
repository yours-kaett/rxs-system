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
                    <h1>Clients</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Clients</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <section class="section dashboard">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table p-5">
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                        <col width="25%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare('SELECT * FROM tbl_client ');
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                $firstname = $row['firstname'];
                                                $middlename = $row['middlename'];
                                                $lastname = $row['lastname'];
                                                $email = $row['email'];
                                                $username = $row['username'];
                                                $password = $row['password'];
                                                echo '
                                        <tr>
                                            <td>' . $firstname . " " . $middlename . " " . $lastname . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $username . '</td>
                                            <td>' . $password . '</td>
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

        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js"></script>

    </body>

    </html>

<?php
} else {
    header("Location: logout.php");
    exit();
}
