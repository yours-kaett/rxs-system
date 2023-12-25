<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
    $get_invoice_number = $_GET['invoice_number'];
    $transaction_status_id = 1;
    $stmt = $conn->prepare('UPDATE tbl_orders SET transaction_status_id = ? WHERE invoice_number = ? AND client_id = ?');
    $stmt->bind_param('isi', $transaction_status_id, $get_invoice_number, $client_id);
    $stmt->execute();

    header("Location: ../cart-details.php?invoice=$get_invoice_number");
    exit();
} else {
    header("Location: ../client-login.php");
    exit();
}
