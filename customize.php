<?php
include 'database_connection.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
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
                <h1>Customize</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">Customize</li>
                    </ol>
                </nav>
            </div>
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-6">
                                <?php
                                if (isset($_GET['success'])) {
                                ?>
                                    <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                                        <span><?php echo $_GET['success'], 'Your template has been saved successfully.' ?></span>
                                        <a href="customize.php">
                                            <button class="btn-close" type="button"></button>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <form action="checking/customize-check.php" method="post">
                                            <div class="d-flex flex-column">
                                                <h5>Background</h5>
                                                <fieldset class="fieldset d-flex align-items-center">
                                                    <div class="fieldset-item me-2">
                                                        <input class="form-check-input" type="radio" name="bg_color" id="bg-primary" value="bg-primary" style="display: none;" checked required>
                                                        <label class="form-check-label rounded-radio" for="bg-primary" title="Blue">
                                                            <div class="bg-primary p-3 rounded-5"></div>
                                                        </label>
                                                    </div>
                                                    <div class="fieldset-item me-2">
                                                        <input class="form-check-input" type="radio" name="bg_color" id="bg-secondary" value="bg-secondary" style="display: none;" required>
                                                        <label class="form-check-label rounded-radio" for="bg-secondary" title="Gray">
                                                            <div class="bg-secondary p-3 rounded-5"></div>
                                                        </label>
                                                    </div>
                                                    <div class="fieldset-item me-2">
                                                        <input class="form-check-input" type="radio" name="bg_color" id="bg-success" value="bg-success" style="display: none;" required>
                                                        <label class="form-check-label rounded-radio" for="bg-success" title="Green">
                                                            <div class="bg-success p-3 rounded-5"></div>
                                                        </label>
                                                    </div>
                                                    <div class="fieldset-item me-2">
                                                        <input class="form-check-input" type="radio" name="bg_color" id="bg-warning" value="bg-warning" style="display: none;" required>
                                                        <label class="form-check-label rounded-radio" for="bg-warning" title="Yellow">
                                                            <div class="bg-warning p-3 rounded-5"></div>
                                                        </label>
                                                    </div>
                                                    <div class="fieldset-item me-2">
                                                        <input class="form-check-input" type="radio" name="bg_color" id="bg-danger" value="bg-danger" style="display: none;" required>
                                                        <label class="form-check-label rounded-radio" for="bg-danger" title="Red">
                                                            <div class="bg-danger p-3 rounded-5"></div>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                                <hr class="my-3">
                                                <h5>Surname</h5>
                                                <input type="text" name="name_input" id="name-input" class="form-control">
                                                <div class="d-flex align-items-center mt-2">
                                                    <div class="me-4">
                                                        <input class="form-check-input" type="radio" name="name_direction" id="name-position-top" value="name-position-top" checked required>
                                                        <label class="form-check-label" for="name-position-top" onclick="namePositionTopfn()">Top</label>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" name="name_direction" id="name-position-bottom" value="name-position-bottom" required>
                                                        <label class="form-check-label" for="name-position-bottom" onclick="namePositionBottomfn()">Bottom</label>
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                <h5>Team Name</h5>
                                                <input type="text" name="team_name_input" id="team-name-input" class="form-control">
                                                <div class="d-flex align-items-center mt-2">
                                                    <label for="" class="me-3">Front: </label>
                                                    <div class="me-4">
                                                        <input class="form-check-input" type="radio" name="team_name_direction" id="team-name-position-top" value="team-name-position-top" checked required>
                                                        <label class="form-check-label" for="team-name-position-top" onclick="teamnamePositionTopfn()">Top</label>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" name="team_name_direction" id="team-name-position-bottom" value="team-name-position-bottom" required>
                                                        <label class="form-check-label" for="team-name-position-bottom" onclick="namePositionBottomfn()">Bottom</label>
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                <h5>Number</h5>
                                                <input type="number" name="number_input" id="number-input" class="form-control">
                                                <div class="d-flex align-items-center mt-2">
                                                    <label for="" class="me-3">Front: </label>
                                                    <div class="me-3">
                                                        <input class="form-check-input" type="radio" name="number_direction" id="number-position-front-left" value="number-position-front-left" checked required>
                                                        <label class="form-check-label" for="number-position-front-left" onclick="numberPositionFrontRightfn()">Top Right</label>
                                                    </div>
                                                    <div class="me-3">
                                                        <input class="form-check-input" type="radio" name="number_direction" id="number-position-front-right" value="number-position-front-right" required>
                                                        <label class="form-check-label" for="number-position-front-right" onclick="numberPositionFrontLeftfn()">Top Left</label>
                                                    </div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" name="number_direction" id="blank" onclick="blankFn()" required>
                                                        <label class="form-check-label" for="blank">Blank</label>
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                <h5>Available Logo</h5>
                                                <fieldset class="fieldset d-flex align-items-center">
                                                    <?php
                                                    $stmt = $conn->prepare(' SELECT * FROM tbl_logos ORDER BY id ASC');
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        $num = $row['id'];
                                                        $img_url = $row['img_url'];
                                                        echo '
                                                        <div class="fieldset-item me-2">
                                                            <input class="form-check-input" type="radio" name="logo" id="logo' . $num . '" value="logo' . $num . '" style="position: absolute; left: -9999px;" required>
                                                            <label class="form-check-label rounded-radio" for="logo' . $num . '" onclick="logo' . $num . 'Fn()">
                                                                <img src="IMG/logos/' . $img_url . '" width="50" style="cursor: pointer; border-radius: 50%" alt="">
                                                            </label>
                                                        </div>
                                                        ';
                                                    }
                                                    ?>
                                                </fieldset>
                                                <hr class="my-3">
                                                <h5>Patterns</h5>
                                                <fieldset class="fieldset d-flex align-items-center">
                                                    <?php
                                                    $stmt = $conn->prepare(' SELECT * FROM tbl_patterns ORDER BY id ASC');
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        $num = $row['id'];
                                                        $img_url = $row['img_url'];
                                                        echo '
                                                        <div class="fieldset-pattern me-2 mb-2">
                                                            <input class="form-check-input" type="radio" name="pattern" id="pattern' . $num . '" value="pattern' . $num . '" style="position: absolute; left: -9999px;" required>
                                                            <label class="form-check-label square-radio" for="pattern' . $num . '" onclick="pattern' . $num . 'Fn()">
                                                                <img src="IMG/patterns/' . $img_url . '" style="width: 70px; height: 70px; cursor: pointer;" alt="">
                                                            </label>
                                                        </div>
                                                        ';
                                                    }
                                                    ?>
                                                </fieldset>
                                                <hr class="my-3">
                                                <h5>Fonts</h5>
                                                <select name="font" id="font" class="form-select">
                                                    <option disabled selected>-select-</option>
                                                    <option value="Arial">Arial</option>
                                                    <option value="Times New Roman">Times New Roman</option>
                                                    <option value="Courier New">Courier New</option>
                                                    <option value="Consolas">Consolas</option>
                                                </select>
                                                <hr class="my-3">
                                                <button class="btn btn-success p-3" type="submit">Save Template</button>
                                                <a href="my-customize.php">
                                                    <button class="btn btn-primary p-3 mt-2 w-100" type="button">My Templates</button>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="print">
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 relative">
                                                <h5 style="position: relative;">Front</h5>
                                                <div style="position: relative;">
                                                    <input type="number" value="" id="number-position-front1" readonly />
                                                    <input type="number" value="" id="number-position-front2" readonly />
                                                    <input type="text" id="team-name-position-front1" readonly />
                                                    <input type="text" id="team-name-position-front2" readonly />
                                                    <i class="bx bxs-t-shirt shirts" id="front" style="color: #007BFF; position: relative;"></i>
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
                                            <div class="col-lg-6 col-md-6 col-sm-12 relative">
                                                <h5 style="position: relative;">Back</h5>
                                                <div style="position: relative;">
                                                    <input type="text" id="name-position-back1" readonly>
                                                    <input type="text" id="name-position-back2" readonly>
                                                    <i class="bx bxs-t-shirt shirts mt-4" id="back" style="color: #007BFF; position: relative;"></i>
                                                    <input type="number" id="number-position-back" readonly>
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
                                <!-- <button onclick="PrintPage()" class="btn btn-success btn-lg" type="button">Export Cusomized Shirt</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js" defer></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var radioName = document.querySelectorAll('input[name="bg_color"]');
                var frontIcon = document.getElementById('front');
                var backIcon = document.getElementById('back');
                var nameInput = document.getElementById('name-input');
                var teamnameInput = document.getElementById('team-name-input');
                var numberInput = document.getElementById('number-input');
                var namePositionFront1 = document.getElementById('team-name-position-front1');
                var namePositionFront2 = document.getElementById('team-name-position-front2');
                var namePositionBack1 = document.getElementById('name-position-back1');
                var namePositionBack2 = document.getElementById('name-position-back2');
                var numberPositionBack = document.getElementById('number-position-back');
                var numberPositionFrontLeft = document.getElementById('number-position-front1');
                var numberPositionFrontRight = document.getElementById('number-position-front2');
                radioName.forEach(function(radio) {
                    radio.addEventListener('input', function() {
                        var selectedColor = this.value;
                        updateIconsColor(selectedColor);
                    });
                });
                nameInput.addEventListener('input', function() {
                    var newName = this.value;
                    updateNamePosition(newName);
                });
                teamnameInput.addEventListener('input', function() {
                    var newTeamName = this.value;
                    updateTeamNamePosition(newTeamName);
                });
                numberInput.addEventListener('input', function() {
                    var newNumber = this.value;
                    updateNumberPosition(newNumber);
                });

                function updateIconsColor(color) {
                    if (color === 'bg-color1') {
                        frontIcon.style.color = '#000';
                        backIcon.style.color = '#000';
                    } else if (color === 'bg-primary') {
                        frontIcon.style.color = '#007bff';
                        backIcon.style.color = '#007bff';
                    } else if (color === 'bg-secondary') {
                        frontIcon.style.color = '#6c757d';
                        backIcon.style.color = '#6c757d';
                    } else if (color === 'bg-success') {
                        frontIcon.style.color = '#28a745';
                        backIcon.style.color = '#28a745';
                    } else if (color === 'bg-warning') {
                        frontIcon.style.color = '#ffc107';
                        backIcon.style.color = '#ffc107';
                    } else if (color === 'bg-danger') {
                        frontIcon.style.color = '#dc3545';
                        backIcon.style.color = '#dc3545';
                    }
                }

                function updateNamePosition(newName) {
                    namePositionBack1.value = newName;
                    namePositionBack1.textContent = newName;
                    namePositionBack2.value = newName;
                    namePositionBack2.textContent = newName;
                }

                function updateTeamNamePosition(newTeamName) {
                    namePositionFront1.value = newTeamName;
                    namePositionFront1.textContent = newTeamName;
                    namePositionFront2.value = newTeamName;
                    namePositionFront2.textContent = newTeamName;
                }

                function updateNumberPosition(newNumber) {
                    numberPositionBack.value = newNumber;
                    numberPositionBack.textContent = newNumber;
                    numberPositionFrontLeft.value = newNumber;
                    numberPositionFrontLeft.textContent = newNumber;
                    numberPositionFrontRight.value = newNumber;
                    numberPositionFrontRight.textContent = newNumber;
                }

                function teamnamePositionTopfn() {
                    namePositionFront1.style.display = "flex";
                    namePositionFront2.style.display = "none";
                }

                function teamnamePositionBottomfn() {
                    namePositionFront1.style.display = "none";
                    namePositionFront2.style.display = "flex";
                }

                function namePositionTopfn() {
                    namePositionBack1.style.display = "flex";
                    namePositionBack2.style.display = "none";
                }

                function namePositionBottomfn() {
                    namePositionBack1.style.display = "none";
                    namePositionBack2.style.display = "flex";
                }

                function numberPositionFrontRightfn() {
                    numberPositionFrontLeft.style.display = "flex";
                    numberPositionFrontRight.style.display = "none";
                    numberPositionFrontRight.style.visibility = "visible";
                    numberPositionFrontLeft.style.visibility = "visible";
                }

                function numberPositionFrontLeftfn() {
                    numberPositionFrontRight.style.display = "flex";
                    numberPositionFrontLeft.style.display = "none";
                    numberPositionFrontRight.style.visibility = "visible";
                    numberPositionFrontLeft.style.visibility = "visible";
                }

                function blankFn() {
                    numberPositionFrontRight.style.visibility = "hidden";
                    numberPositionFrontLeft.style.visibility = "hidden";
                }
                var fronttopRadioButton = document.getElementById('team-name-position-top');
                var frontbottomRadioButton = document.getElementById('team-name-position-bottom');
                var topRadioButton = document.getElementById('name-position-top');
                var bottomRadioButton = document.getElementById('name-position-bottom');
                var frontLeftRadioButton = document.getElementById('number-position-front-left');
                var frontRightRadioButton = document.getElementById('number-position-front-right');
                var blankRadioButton = document.getElementById('blank');
                fronttopRadioButton.addEventListener('change', teamnamePositionTopfn);
                frontbottomRadioButton.addEventListener('change', teamnamePositionBottomfn);
                topRadioButton.addEventListener('change', namePositionTopfn);
                bottomRadioButton.addEventListener('change', namePositionBottomfn);
                frontLeftRadioButton.addEventListener('change', numberPositionFrontRightfn);
                frontRightRadioButton.addEventListener('change', numberPositionFrontLeftfn);
                blankRadioButton.addEventListener('change', blankFn);
            });

            function logo1Fn() {
                document.getElementById("IMG/logos/GSW.png_logo").style.display = "block";
                document.getElementById("IMG/logos/WOLVES.png_logo").style.display = "none";
                document.getElementById("IMG/logos/MAVERICKS.png_logo").style.display = "none";
                document.getElementById("IMG/logos/RAPTORS.png_logo").style.display = "none";
            }

            function logo2Fn() {
                document.getElementById("IMG/logos/MAVERICKS.png_logo").style.display = "block";
                document.getElementById("IMG/logos/GSW.png_logo").style.display = "none";
                document.getElementById("IMG/logos/WOLVES.png_logo").style.display = "none";
                document.getElementById("IMG/logos/RAPTORS.png_logo").style.display = "none";
            }

            function logo3Fn() {
                document.getElementById("IMG/logos/RAPTORS.png_logo").style.display = "block";
                document.getElementById("IMG/logos/MAVERICKS.png_logo").style.display = "none";
                document.getElementById("IMG/logos/GSW.png_logo").style.display = "none";
                document.getElementById("IMG/logos/WOLVES.png_logo").style.display = "none";
            }

            function logo4Fn() {
                document.getElementById("IMG/logos/WOLVES.png_logo").style.display = "block";
                document.getElementById("IMG/logos/GSW.png_logo").style.display = "none";
                document.getElementById("IMG/logos/MAVERICKS.png_logo").style.display = "none";
                document.getElementById("IMG/logos/RAPTORS.png_logo").style.display = "none";
            }

            function pattern1Fn() {
                document.getElementById("f_pattern1").style.display = "block";
                document.getElementById("f_pattern2").style.display = "none";
                document.getElementById("f_pattern3").style.display = "none";
                document.getElementById("b_pattern1").style.display = "block";
                document.getElementById("b_pattern2").style.display = "none";
                document.getElementById("b_pattern3").style.display = "none";
            }

            function pattern2Fn() {
                document.getElementById("f_pattern1").style.display = "none";
                document.getElementById("f_pattern2").style.display = "block";
                document.getElementById("f_pattern3").style.display = "none";
                document.getElementById("b_pattern1").style.display = "none";
                document.getElementById("b_pattern2").style.display = "block";
                document.getElementById("b_pattern3").style.display = "none";
            }

            function pattern3Fn() {
                document.getElementById("f_pattern1").style.display = "none";
                document.getElementById("f_pattern2").style.display = "none";
                document.getElementById("f_pattern3").style.display = "block";
                document.getElementById("b_pattern1").style.display = "none";
                document.getElementById("b_pattern2").style.display = "none";
                document.getElementById("b_pattern3").style.display = "block";
            }
        </script>
        <script>
            $('#font').change(function() {
                var selectedFont = $(this).val();
                $('#number-position-front1, #number-position-front2, #team-name-position-front1, #team-name-position-front2, #name-position-back1, #name-position-back2, #number-position-back').css('font-family', selectedFont);
            });
        </script>
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

            // function PrintPage() {
            //     window.print();
            //     setTimeout(function() {
            //         window.close()
            //     }, 900);
            // }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: client-login.php");
    exit();
}
