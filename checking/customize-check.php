<?php
include '../database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
    $client_id = $_SESSION['id'];

    if (
        isset($_POST['bg_color']) &&
        isset($_POST['name_input']) &&
        isset($_POST['name_direction']) &&
        isset($_POST['team_name_input']) &&
        isset($_POST['team_name_direction']) &&
        isset($_POST['number_input']) &&
        isset($_POST['number_direction']) &&
        isset($_POST['logo']) &&
        isset($_POST['pattern']) &&
        isset($_POST['font'])
    ) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        };
        $bg_color = validate($_POST['bg_color']);
        $name_input = validate($_POST['name_input']);
        $name_direction = validate($_POST['name_direction']);
        $team_name_input = validate($_POST['team_name_input']);
        $team_name_direction = validate($_POST['team_name_direction']);
        $number_input = validate($_POST['number_input']);
        $number_direction = validate($_POST['number_direction']);
        $logo = validate($_POST['logo']);
        $pattern = validate($_POST['pattern']);
        $font = validate($_POST['font']);
        $transaction_status_id = 2;
        date_default_timezone_set('Asia/Manila');
        $created_at = date("F j, Y");
        $updated_at = date("F j, Y");

        $stmt = $conn->prepare(' INSERT INTO tbl_customize (bg_color, name_input, name_direction, team_name_input, 
        team_name_direction, number_input, number_direction, logo, pattern, font, transaction_status_id, client_id, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ');
        $stmt->bind_param('ssssssssssiiss', $bg_color, $name_input, $name_direction, $team_name_input, $team_name_direction, $number_input, $number_direction, $logo, $pattern, $font, $transaction_status_id, $client_id, $created_at, $updated_at);
        $stmt->execute();
        $stmt->close();

        header("Location: ../customize.php?success");
        exit();
    }
} else {
    header("Location: ../client-login.php");
    exit();
}
