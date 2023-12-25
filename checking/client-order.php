<?php
include '../database_connection.php';
session_start();

if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['invoice_number'])) {
        $invoice_number = $_POST['invoice_number'];
        $stmt = $conn->prepare(' SELECT * FROM tbl_orders WHERE client_id = ? ');
        $stmt->bind_param('i', $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($rows = $result->fetch_assoc()) {
            $transaction_status_id = 2;
            date_default_timezone_set('Asia/Manila');
            $created_at = date("F j, Y");
            $updated_at = date("F j, Y");
            $stmt = $conn->prepare('UPDATE tbl_orders SET transaction_status_id = ?, created_at = ?, updated_at = ? WHERE invoice_number = ? AND client_id = ?');
            foreach ($invoice_number as $invoiceNumber) {
                $stmt->bind_param('isssi', $transaction_status_id, $created_at, $updated_at, $invoiceNumber, $client_id);
                $stmt->execute();
            }
        }
        header("Location: ../cart.php?success");
        exit;
    } else {
        // echo 'Invalid request method.';
        header("Location: ../cart.php?invalid_request");
        exit;
    }
} else {
    // echo 'Unauthorized access.';
    header("Location: ../cart.php?unauthorized");
    exit;
}
?>
