<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_POST['total_payment'])) {
        $get_id = $_GET['id'];
        $total_payment = $_POST['total_payment'];
        $transaction_status = 2;
        $stmt = $conn->prepare(' UPDATE tbl_transaction SET total_payment = ?, transaction_status = ? WHERE id = ? ');
        $stmt->bind_param('sii', $total_payment, $transaction_status, $get_id);
        $stmt->execute();
        $stmt->close();
        header("Location: ../cart.php?id=$get_id");
        exit();
    }
} else {
    header("Location: ../client-login.php");
    exit();
}
