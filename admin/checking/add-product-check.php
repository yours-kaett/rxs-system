<?php
include '../../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    if (
        isset($_FILES['img_url']) &&
        isset($_POST['shirt_title']) &&
        isset($_POST['shirt_code']) &&
        isset($_POST['shirt_price']) &&
        isset($_POST['schirt_category_id']) &&
        isset($_POST['jersey_type_id'])
    ) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $shirtTitle = validate($_POST['shirt_title']);
        $shirtCode = validate($_POST['shirt_code']);
        $shirtPrice = validate($_POST['shirt_price']);
        $shirtCategoryId = validate($_POST['schirt_category_id']);
        $jerseyTypeId = validate($_POST['jersey_type_id']);
        $img_name = $_FILES['img_url']['name'];
        $img_size = $_FILES['img_url']['size'];
        $tmp_name = $_FILES['img_url']['tmp_name'];
        // $error = $_FILES['img_url']['error'];


        if ($img_size > 1000000) {
            header("Location: ../display.php?error=Sorry, your file is too large.");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $img_upload_path = '../../IMG/products/' . $img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $stmt = $conn->prepare('INSERT INTO tbl_shirt (shirt_title, shirt_code, shirt_price, img_url, shirt_category_id, jersey_type_id) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('ssssii', $shirtTitle, $shirtCode, $shirtPrice, $img_name, $shirtCategoryId, $jerseyTypeId);
                $stmt->execute();
                header("Location: ../display.php?success");
                exit();
            } else {
                header("Location: ../display.php?invalid_type");
                exit();
            }
        }
    } else {
        echo "Invalid request method.";
    }
} else {
    header("Location: ../index.php");
    exit();
}
