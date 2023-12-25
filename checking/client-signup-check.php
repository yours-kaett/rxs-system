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

    $stmt = $conn->prepare("SELECT * FROM tbl_client WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $firstname = "fn-" . $row['username'];
    $middlename = "mn-" . $row['username'];
    $lastname = "ln-" . $row['username'];

    if (mysqli_num_rows($result) > 0) {
        header("Location: ../client-signup.php?error=Username already taken.");
        exit();
    } 
    else {
        $password = md5($password);
        $stmt = $conn->prepare("INSERT INTO tbl_client (email, username, password, firstname, middlename, lastname) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $email, $username, $password, $firstname, $middlename, $lastname);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: ../client-login.php?success");
        exit();
    }
} else {
    header("Location: ../client-signup.php?error=Unknown error occured!");
    exit();
}
