<?php
require '../php/function.php';

$message = ""; 

if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['id'])) {
  $user_id = $_GET['id'];
  $query = "SELECT * FROM users WHERE id = $user_id";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if (isset($_POST['update_password'])) {
      $currentPassword = $_POST['current_password'];
      $newPassword = $_POST['new_password'];

      $storedHashedPassword = $user['password'];

      if (password_verify($currentPassword, $storedHashedPassword)) {
        if (!empty($newPassword) && strlen($newPassword) >= 6) {
          $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

          $query = "UPDATE users SET password = '$hashedPassword' WHERE id = $user_id";
          mysqli_query($conn, $query);
          header("Location: user_list.php");
        } else {
          $message = "New password must be at least 6 characters long.";
        }
      } else {
        $message = "Current password is incorrect.";
      }
    }
  } else {
    $message = "User not found.";
  }
} else {
  $message = "User ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Change Password</title>
  <style>
    .error-message {
      color: red;
    }
  </style>
</head>
<body>
  <h2>Change Password</h2>
  <form action="" method="post">
    <input type="password" name="current_password" placeholder="Current Password" required>
    <br>
    <input type="password" name="new_password" placeholder="New Password" required>
    <br>
    <div class="error-message">
      <?php echo $message; ?>
    </div>
    <input type="submit" name="update_password" value="Update Password">
  </form>
  <br>
  <a href="user_list.php">Back to User List</a>
</body>
</html>
