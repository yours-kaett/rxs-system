<?php
include '../../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $transaction_status_id = 4;
    date_default_timezone_set('Asia/Manila');
    $updated_at = date("F j, Y");
    $stmt = $conn->prepare('UPDATE tbl_customize SET transaction_status_id = ?, updated_at = ? WHERE id = ? ');
    $stmt->bind_param('iss', $transaction_status_id, $updated_at, $id);
    $stmt->execute();

    header("Location: ../customize-orders.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
