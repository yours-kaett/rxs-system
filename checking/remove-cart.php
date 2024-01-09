<?php
include '../database_connection.php';
session_start();
$stmt = $conn->prepare(' DELETE FROM tbl_orders WHERE invoice_number = ? ');
$stmt->bind_param('s', $_GET['invoice']);
$stmt->execute();
header("Location: ../cart.php");
exit();

?>