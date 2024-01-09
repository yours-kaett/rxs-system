<?php
include 'database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
    $stmt = $conn->prepare('SELECT 
    tbl_customize.id,
    tbl_customize.bg_color,
    tbl_customize.name_input,
    tbl_customize.name_direction,
    tbl_customize.team_name_input,
    tbl_customize.team_name_direction,
    tbl_customize.number_input,
    tbl_customize.number_direction,
    tbl_customize.logo,
    tbl_customize.pattern,
    tbl_customize.font,
    tbl_customize.client_id,
    tbl_customize.transaction_status_id,
    tbl_transaction_status.transaction_status
    FROM tbl_customize
    INNER JOIN tbl_transaction_status ON tbl_customize.transaction_status_id = tbl_transaction_status.id
    WHERE tbl_customize.client_id = ?
    ORDER BY tbl_customize.id DESC ');
    $stmt->bind_param('i', $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Web-based Customized Apparel Design and Ordering System</title>
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
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="print">
                                <div class="mt-5 pt-5">
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
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
                                        $transaction_status = $row['transaction_status'];
                                        if ($transaction_status === "Pending") {
                                            $status_indicator = "bg-danger p-1 text-white";
                                            $display = "";
                                        }
                                        if ($transaction_status === "On-progress") {
                                            $status_indicator = "bg-warning p-1 text-primary";
                                            $display = "d-none";
                                        }
                                        if ($transaction_status === "Delivered") {
                                            $status_indicator = "bg-success p-1 text-white";
                                            $display = "d-none";
                                        }
                                        echo '
                                        <div class="row">
                                            <div class="col-12 py-4">
                                                <p>Status: <span class="' . $status_indicator . '">' . $transaction_status . '</span></p>
                                                <a href="checking/order-customize.php?id=' . $id . '">
                                                    <button class="btn btn-success ' . $display . '" type="button">
                                                        <i class="bi bi-basket"></i>&nbsp; Order
                                                    </button>
                                                </a>
                                                <a href="checking/remove-customize.php?id=' . $id . '">
                                                    <button class="btn btn-danger ' . $display . '">
                                                        <i class="bi bi-trash"></i>&nbsp; Remove
                                                    </button>
                                                </a>
                                            </div>
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
                                    }
                                    ?>

                                </div>
                            </div>
                            <!-- <button onclick="PrintPage()" class="btn btn-success btn-lg" type="button">Print this template</button> -->
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script>
            function captureScreenshot() {
            // Send a request to the server to generate the document file
            fetch('generateDocument.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ content: document.documentElement.outerHTML }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server (e.g., provide a download link)
                var link = document.createElement('a');
                link.href = data.fileUrl;
                link.download = 'document.docx';
                link.click();
            });
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'p' || event.key === 'P') {
                captureScreenshot();
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
