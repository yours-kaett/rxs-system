<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $get_id = $_GET['id'];
    $client_id = $_SESSION['id'];

    if (
        isset($_POST['team_name']) &&
        isset($_POST['jersey_type_id']) &&
        isset($_POST['name']) &&
        isset($_POST['jersey_number']) &&
        isset($_POST['size_id'])
    ) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $stmt = $conn->prepare('SELECT * FROM tbl_shirt WHERE id = ? ');
        $stmt->bind_param('i', $get_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $invoice_number = "rxs6122-00" . $row['id'];
        $names = $_POST['name'];
        $shirt_code = $row['shirt_code'];
        $shirt_price = $row['shirt_price'];
        $jersey_numbers = $_POST['jersey_number'];
        $size_ids = $_POST['size_id'];
        $team_name = validate($_POST['team_name']);
        $jersey_type_id = validate($_POST['jersey_type_id']);
        $img_url = $row['img_url'];
        $transaction_status_id = 1;
        date_default_timezone_set('Asia/Manila');
        $created_at = date("F j, Y");

        for ($i = 0; $i < count($names); $i++) {
            $name = validate($names[$i]);
            $jersey_number = validate($jersey_numbers[$i]);
            $size_id = validate($size_ids[$i]);

            $stmt = $conn->prepare(' INSERT INTO tbl_orders (img_url, shirt_id, invoice_number, name, shirt_code, shirt_price, jersey_number, size_id, team_name, jersey_type_id, transaction_status_id, client_id, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ');
            $stmt->bind_param('sissssiisiiis', $img_url, $get_id, $invoice_number, $name, $shirt_code, $shirt_price, $jersey_number, $size_id, $team_name, $jersey_type_id, $transaction_status_id, $client_id, $created_at);
            $stmt->execute();
        }

        $stmt->close();

        header("Location: ../details.php?id=$get_id&success");
        exit();
    }
} else {
    header("Location: ../client-login.php");
    exit();
}
