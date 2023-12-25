<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $get_id = $_GET['id'];

    $stmt = $conn->prepare(' SELECT id, transaction_id FROM tbl_orders WHERE id = ? ');
    $stmt->bind_param('i', $get_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $transaction_id = $row['transaction_id'];

    $stmt = $conn->prepare(' DELETE FROM tbl_orders WHERE id = ? ');
    $stmt->bind_param('i', $get_id);
    $stmt->execute();

    header("Location: ../my-order.php?id=$transaction_id");
    exit();
} else {
    header("Location: ../client-login.php");
    exit();
}
