<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $transaction_status_id = 3;
    $client_id = $_SESSION['id'];
    $id = $_GET['id'];
    $stmt = $conn->prepare(' UPDATE tbl_customize SET transaction_status_id = ? WHERE client_id = ? AND id = ? ');
    $stmt->bind_param('iii', $transaction_status_id, $client_id, $id);
    $stmt->execute();
    header("Location: ../my-customize.php?ordered");
    exit();
} else {
    header("Location: ../client-login.php");
    exit();
}
