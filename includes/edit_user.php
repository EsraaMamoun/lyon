<?php
require '../php/function.php';

if (!isset($_SESSION["id"])) {
  http_response_code(403); 
  exit;
}

if (isset($_GET['id'])) {
  $user_id = $_GET['id'];
  $query = "SELECT * FROM users WHERE id = $user_id";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
} else {
  echo "User ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit User</title>
  <style>
    .error-message {
      color: red;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="../js/edit_user.js"></script>
</head>
<body>
  <h2>Edit User</h2>
  <form id="editForm">
    <input type="text" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" placeholder="Name">
    <br>
    <input type="text" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" placeholder="Username">
    <br>
    <div class="error-message" id="errorMessage"></div>
    <input type="submit" name="update" value="Update">
  </form>
  <br>
  <a href="user_list.php">Back to User List</a>
  <script>
    var userId = <?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>;
  </script>
</body>
</html>
