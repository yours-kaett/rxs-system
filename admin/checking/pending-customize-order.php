<?php
include '../../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $transaction_status_id = 2;
    $stmt = $conn->prepare('UPDATE tbl_customize SET transaction_status_id = ? WHERE id = ?');
    $stmt->bind_param('ii', $transaction_status_id, $id);
    $stmt->execute();

    header("Location: ../customize-orders.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
