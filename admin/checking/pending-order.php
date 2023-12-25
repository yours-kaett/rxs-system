<?php
include '../../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $get_invoice_number = $_GET['invoice_number'];
    $transaction_status_id = 2;
    $stmt = $conn->prepare('UPDATE tbl_orders SET transaction_status_id = ? WHERE invoice_number = ?');
    $stmt->bind_param('is', $transaction_status_id, $get_invoice_number);
    $stmt->execute();

    header("Location: ../orders.php?invoice_number");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
