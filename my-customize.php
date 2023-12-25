<?php
include 'database_connection.php';
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
    $stmt = $conn->prepare('SELECT * FROM tbl_customize WHERE client_id = ?');
    $stmt->bind_param('i', $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $bg_color = $row['bg_color'];
    $name_input = $row['name_input'];
    $name_direction = $row['name_direction'];
    $team_name_input = $row['team_name_input'];
    $team_name_direction = $row['team_name_direction'];
    $number_input = $row['number_input'];
    $number_direction = $row['number_direction'];
    $logo = $row['logo'];
    $pattern = $row['pattern'];
    $font = $row['font'];
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
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    </head>

    <body>
        <?php include 'top-nav.php' ?>
        <?php include 'side-nav.php' ?>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>My Customize Templates</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">My Customize Templates</li>
                    </ol>
                </nav>
            </div>
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="print">
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 relative">
                                            <h5 style="position: relative;">Front</h5>
                                            <div style="position: relative;">
                                                <input type="number" value="<?php echo $number_input ?>" id="number-position-front1" readonly />
                                                <input type="number" value="<?php echo $number_input ?>" id="number-position-front2" readonly />
                                                <input type="text" value="<?php echo $team_name_input ?>" id="team-name-position-front1" readonly />
                                                <input type="text" value="<?php echo $team_name_input ?>" id="team-name-position-front2" readonly />
                                                <i class="bx bxs-t-shirt shirts" style="color: <?php echo $bg_color; ?>; position: relative;"></i>
                                                <?php
                                                $stmt = $conn->prepare(' SELECT * FROM tbl_logos ORDER BY id ASC');
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {
                                                    $num = $row['id'];
                                                    $img_url = $row['img_url'];
                                                    echo '
                                                            <img src="IMG/logos/' . $img_url . '" 
                                                            id="IMG/logos/' . $img_url . '_logo" 
                                                            style="display: none; position: relative; 
                                                            left: 85px; bottom: 145px; width: 80px; 
                                                            z-index: 1000; border-radius: 50%;" alt="">
                                                        ';
                                                }

                                                $stmt = $conn->prepare(' SELECT * FROM tbl_patterns ORDER BY id ASC');
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {
                                                    $num = $row['id'];
                                                    $img_url = $row['img_url'];
                                                    echo '
                                                            <img src="IMG/patterns/' . $img_url . '" 
                                                            id="f_pattern' . $num . '" 
                                                            style="display: none; position: relative; 
                                                            left: 5px; bottom: 310px; width: 240px; 
                                                            height: 300px; z-index: 1000; 
                                                            mix-blend-mode: overlay; opacity: 30%;" alt="">
                                                        ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 relative">
                                            <h5 style="position: relative;">Back</h5>
                                            <div style="position: relative;">
                                                <input type="text" value="<?php echo $name_input; ?>" id="name-position-back1" readonly>
                                                <input type="text" value="<?php echo $name_input; ?>" id="name-position-back2" readonly>
                                                <i class="bx bxs-t-shirt shirts mt-4" id="back" style="color: <?php echo $bg_color; ?>; position: relative;"></i>
                                                <input type="number" value="<?php echo $number_input; ?>" id="number-position-back" readonly>
                                                <?php
                                                $stmt = $conn->prepare(' SELECT * FROM tbl_patterns ORDER BY id ASC');
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($row = $result->fetch_assoc()) {
                                                    $num = $row['id'];
                                                    $img_url = $row['img_url'];
                                                    echo '
                                                        <img src="IMG/patterns/' . $img_url . '" id="b_pattern' . $num . '" 
                                                        style="display: none; position: relative; left: 5px; 
                                                        bottom: 320px; width: 240px; z-index: 1000; 
                                                        mix-blend-mode: overlay; opacity: 30%;" alt="">
                                                        ';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button onclick="PrintPage()" class="btn btn-success btn-lg" type="button">Print this template</button>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js" defer></script>
        <script>
            // function printCustomizedShirt() {
            //     html2canvas(document.querySelector('.print')).then(canvas => {
            //         var imageData = canvas.toDataURL("image/png");
            //         var printWindow = window.open();
            //         printWindow.document.write('<img src="' + imageData + '" alt="Customized Shirt">');
            //         var downloadLink = document.createElement('a');
            //         downloadLink.href = imageData;
            //         downloadLink.download = 'customized_shirt.png';
            //         downloadLink.click();
            //     });
            // }

            function PrintPage() {
                window.print();
                setTimeout(function() {
                    window.close()
                }, 900);
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: client-login.php");
    exit();
}