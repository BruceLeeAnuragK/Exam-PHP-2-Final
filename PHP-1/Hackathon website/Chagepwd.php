<?php
// change_password.php

include 'config.php';
session_start();

$str = json_decode(file_get_contents('php://input'), true);
$data = array();

parse_str($str, $data);

$submit = $data['submit'];
$current_password2 = $data['curr_psw'];
$new_password2 = $data['new_psw'];
$confirm_new_password2 = $data['confirm_psw'];
$message = '';
$res = array();

if (isset($submit)) {
    $current_password = mysqli_real_escape_string($conn, $current_password2);
    $new_password = mysqli_real_escape_string($conn, $new_password2);
    $confirm_new_password = mysqli_real_escape_string($conn, $confirm_new_password2);

    // Check if the current password matches the user's password

    $user_id = $_SESSION['UId'];
    $query = "SELECT * FROM users WHERE UId = '$user_id'";

    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if (password_verify($current_password, $user['UPassword'])) {
        // Check if the new passwords match

        if ($new_password === $confirm_new_password) {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password
            $query = "UPDATE users SET UPassword = '$hashed_new_password' WHERE UId = '$user_id'";

            if (mysqli_query($conn, $query)) {
                $message = "Password changed successfully.";
            } else {
                $message = "Error updating password: " . mysqli_error($conn);
            }
        } else {
            $message = "New passwords do not match.";
        }
    } else {
        $message = "Incorrect current password.";
    }
} else {
    $message = "Have Not Submiited";
}
echo json_encode($res['msg'] = $message);

?>