<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $get_id = $_GET['id'];

    $stmt = $conn->prepare(' SELECT id, invoice_number FROM tbl_orders WHERE id = ? ');
    $stmt->bind_param('i', $get_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $invoice_number = $row['invoice_number'];

    $stmt = $conn->prepare(' DELETE FROM tbl_orders WHERE id = ? ');
    $stmt->bind_param('i', $get_id);
    $stmt->execute();

    header("Location: ../cart-details.php?invoice=$invoice_number");
    exit();
} else {
    header("Location: ../client-login.php");
    exit();
}
