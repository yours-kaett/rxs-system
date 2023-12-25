<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
    $get_invoice_number = $_GET['invoice_number'];
    $transaction_status_id = 3;
    date_default_timezone_set('Asia/Manila');
    $updated_at = date("F j, Y");
    $stmt = $conn->prepare('UPDATE tbl_orders SET transaction_status_id = ?, updated_at = ? WHERE invoice_number = ? AND client_id = ?');
    $stmt->bind_param('issi', $transaction_status_id, $updated_at, $get_invoice_number, $client_id);
    $stmt->execute();

    header("Location: ../admin/orders.php?invoice_number");
    exit();
} else {
    header("Location: ../admin-login.php");
    exit();
}
