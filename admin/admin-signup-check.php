<?php
include "../database_connection.php";
session_start();

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['email']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $firstname = "admin_fn-" . $username;
    $middlename = "admin_mn-" . $username;
    $lastname = "admin_ln-" . $username;

    if (mysqli_num_rows($result) > 0) {
        header("Location: admin-signup.php?taken");
        exit();
    } else {
        $password = md5($password);
        $stmt = $conn->prepare("INSERT INTO tbl_admin (email, username, password, firstname, middlename, lastname) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $email, $username, $password, $firstname, $middlename, $lastname);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: admin-signup.php?success");
        exit();
    }
} else {
    header("Location: admin-signup.php?unknown");
    exit();
}
