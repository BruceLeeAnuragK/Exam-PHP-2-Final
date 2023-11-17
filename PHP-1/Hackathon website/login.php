<?php
// login.php

include 'config.php';

$str = json_decode(file_get_contents('php://input'), true);

$data = array();

parse_str($str, $data);

$submit = $data['submit'];
$username2 = $data['username'];
$password2 = $data['password'];

session_start();

$errors = [];
$res = array();
if (isset($submit)) {

    $username = mysqli_real_escape_string($conn, $username2);
    $password = mysqli_real_escape_string($conn, $password2);

    // Check if the user exists
    $query = "SELECT * FROM users WHERE UEmail = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {

        // Check if the password matches
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['UPassword'])) {
            // Set session variables and redirect to the dashboard
            $_SESSION['UId'] = $user['UId'];
            $_SESSION['UEmail'] = $user['UEmail'];
            $res['msg'] = 'All Correct';
        } else {
            $errors[] = "Incorrect password.";
            $res['msg'] = "Incorrect password.";
        }
    } else {
        $errors[] = "User not found.";
        $res["msg"] = "User not found.";
    }
} else {
    $res['msg'] = "Have Not submitted Yet !!";
}

echo json_encode($res);

?>