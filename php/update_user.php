<?php
require './function.php';

if (!isset($_SESSION["id"])) {
  http_response_code(403);
  exit;
}

if (isset($_POST['user_id'], $_POST['name'], $_POST['username'])) {
  $user_id = $_POST['user_id'];
  $name = $_POST['name'];
  $username = $_POST['username'];

  $existingUser = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username' AND id <> $user_id");

  if (mysqli_num_rows($existingUser) > 0) {
    echo "Username already exists. Please choose a different username.";
  } else {
    $query = "UPDATE users SET name = ?, username = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $name, $username, $user_id);

    if (mysqli_stmt_execute($stmt)) {
      echo "User updated successfully";
    } else {
      echo "Error updating user";
    }
  }
} else {
  http_response_code(400);
  echo "Invalid data provided.";
}
?>
