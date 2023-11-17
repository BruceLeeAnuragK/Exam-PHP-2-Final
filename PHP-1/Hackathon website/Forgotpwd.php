<?php
// forgot_password.php

include 'config.php';

$message = '';

$str = json_decode(file_get_contents('php://input'), true);
$data = array();

parse_str($str, $data);

$submit = $data['submit'];
$email2 = $data['email'];


if (isset($submit)) {
  $email = mysqli_real_escape_string($conn, $email2);

  // Check if email exists

  $query = "SELECT * FROM users WHERE UEmail = '$email'";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {

    // Generate a new random password

    $new_password = bin2hex(random_bytes(4)); // Generate an 8-character random string

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database

    $query = "UPDATE users SET UPassword = '$hashed_password' WHERE UEmail = '$email'";

    if (mysqli_query($conn, $query)) {

      $message = "Your new password is: " . $new_password;
    } else {
      $message = "Error updating password: " . mysqli_error($conn);
    }
  } else {
    $message = "Email not found.";
  }
}

echo json_encode($res['msg'] = $message);
?>