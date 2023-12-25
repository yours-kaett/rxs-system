<?php
include '../database_connection.php';
session_start();
$stmt = $conn->prepare(' DELETE FROM tbl_transaction WHERE id = ? ');
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
header("Location: ../cart.php");
exit();

?>