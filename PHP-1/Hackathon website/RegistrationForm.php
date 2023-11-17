<?php

include 'config.php';

$res = array();

$str = json_decode(file_get_contents('php://input'), true);

$data = array();

parse_str($str, $data);

$submit = $data['submit'];
$username2 = $data['username'];
$password2 = $data['password'];
$confirm_new_password2 = $data['conf_psw'];
$gender2 = $data['gender'];
$phnumber2 = $data['phnum'];
$email2 = $data['email'];
$fullname2 = $data['fullname'];
$confirm_new_password2 = $data['conf_psw'];

if (isset($submit)) {

  $fullname = mysqli_real_escape_string($conn, $fullname2);
  $username = mysqli_real_escape_string($conn, $username2);
  $email = mysqli_real_escape_string($conn, $email2);
  $phnumber = mysqli_real_escape_string($conn, $phnumber2);
  $password = mysqli_real_escape_string($conn, $password2);
  $confirm_password = mysqli_real_escape_string($conn, $confirm_password2);
  $gender = mysqli_real_escape_string($conn, $gender2);

  // Validate fullname
  if (empty($fullname)) {
    $errors[] = "Fullname is required.";
    $res['msg'] = "Fullname is required.";
  } elseif (strlen($fullname) < 3 || strlen($fullname) > 255) {
    $errors[] = "Fullname must be between 3 and 255 characters.";
    $res["msg"] = "Fullname must be between 3 and 255 characters.";
  }

  // Validate username
  if (empty($username)) {
    $errors[] = "Username is required.";
    $res["msg"] = "Username is required.";
  } elseif (strlen($username) < 3 || strlen($username) > 255) {
    $errors[] = "Username must be between 3 and 255 characters.";
    $res["msg"] = "Username must be between 3 and 255 characters.";
  } else {
    // Check if username already exists
    $username_check_query = "SELECT * FROM Users WHERE UUsername = '$username'";
    $username_check_result = mysqli_query($conn, $username_check_query);

    if (mysqli_num_rows($username_check_result) > 0) {
      $errors[] = "Username is already taken.";
      $res['msg'] = "Username is already taken.";
    }
  }

  // Validate email
  if (empty($email)) {
    $errors[] = "Email is required.";
    $res['msg'] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $errors[] = "Email is not valid.";
    $res['msg'] = "Email is not valid.";
  }


  // Validate Phnumber
  if (empty($phnumber)) {
    $errors[] = "Phone number is required.";
    $res["msg"] = "Phone number is required.";
  } elseif ((strlen($phnumber) >= 11)) {
    $errors[] = "Phone number must be at least 10 characters.";
    $res['msg'] = "Phone number must be at least 10 characters.";
  } else {
    // Check if phnumber already exists
    $phnumber_check_query = "SELECT * FROM Users WHERE UPhNumber = '$phnumber'";
    $phnumber_check_result = mysqli_query($conn, $phnumber_check_query);

    if (mysqli_num_rows($phnumber_check_result) > 0) {
      $errors[] = "Phone Number is already taken.";
      $res["msg"] = "Phone Number is already taken.";
    }
  }

  // Validate password
  if (empty($password)) {
    $errors[] = "Password is required.";
    $res["msg"] = "Password is required.";
  } elseif (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
    $res["msg"] = "Password must be at least 6 characters.";
  } elseif ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
    $res["msg"] = "Passwords do not match.";
  }

  // If no validation errors, insert user

  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO  Users(UFullname ,UUsername ,UEmail, UPhNumber, UPassword, UGender) VALUES ('$fullname','$username','$email','$phnumber', '$hashed_password','$gender')";

    if (mysqli_query($conn, $query)) {
      header('Location: login.php');
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
  }
}
echo json_encode($res);
?>