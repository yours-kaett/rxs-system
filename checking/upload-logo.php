<?php
// include "../database_connection.php";
// session_start();
// $id = $_SESSION['id'];
// if (isset($_FILES['img_url'])) {

//     $img_name = $_FILES['img_url']['name'];
//     $img_size = $_FILES['img_url']['size'];
//     $tmp_name = $_FILES['img_url']['tmp_name'];
//     $error = $_FILES['img_url']['error'];

//     if ($error === 0) {
//         if ($img_size > 10000000) {
//             header("Location: ../customize.php?error=Sorry, your file is too large.");
//         } else {
//             $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
//             $img_ex_lc = strtolower($img_ex);
//             $allowed_exs = array("jpg", "jpeg", "png");
//             if (in_array($img_ex_lc, $allowed_exs)) {
//                 // $new_img_url = uniqid("IMG-", true) . '.' . $img_ex_lc;
//                 $img_upload_path = '../IMG/my-logo/' . $img_name;
//                 move_uploaded_file($tmp_name, $img_upload_path);
//                 $stmt = $conn->prepare(' INSERT INTO tbl_client_logos (img_url, client_id) VALUES (?, ?) ');
//                 $stmt->bind_param('si', $img_name, $id);
//                 $stmt->execute();
//                 $target_dir = "../IMG/my-logo/";
//                 $target_file = $target_dir . basename($_FILES["img_url"]["name"]);
//                 header("Location: ../customize.php?success=Your logo has been uploaded.");
//                 exit();
//             } else {
//                 header("Location: ../customize.php?error=You can't upload files with this type.");
//                 exit();
//             }
//         }
//     }
// } else {
//     header("Location: ../customize.php?error=Unknown error occured.");
//     exit();
// }
