<?php
require './php/function.php';
if(isset($_SESSION["id"])){
  $id = $_SESSION["id"];
  $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));
}
else{
  header("Location: ./includes/login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
  </head>
  <body>
    <h1>Welcome <?php echo $user["name"]; ?></h1>
    <a href="includes/user_list.php">Users List</a>
    <br>
    <a href="php/logout.php">Logout</a>
  </body>
</html>