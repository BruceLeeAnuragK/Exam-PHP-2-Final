<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "himanidb") or die("Connect failed: %s\n" . $conn->error);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>