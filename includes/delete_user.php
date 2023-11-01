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

  if ($user) {
    if (isset($_POST['confirm_delete'])) {
      $query = "DELETE FROM users WHERE id = $user_id";
      mysqli_query($conn, $query);
      header("Location: ../includes/user_list.php");
    }
  } else {
    echo "User not found.";
  }
} else {
  echo "User ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Delete User</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="../js/delete_user.js"></script>
</head>
<body>
  <h2>Delete User</h2>
  <p style="color: red;">Are you sure you want to delete the user with ID: <?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>?</p>
  <form action="" method="post">
    <input type="hidden" name="user_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <input type="submit" name="confirm_delete" value="Delete">
    <a href="user_list.php">Cancel</a>
  </form>

  <script>
    var userId = <?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>;
  </script>
</body>
</html>
