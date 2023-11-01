<?php
require '../php/function.php';
if(isset($_SESSION["id"])){
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
  </head>
  <body>
    <h2>Login</h2>
    <form action="" method="post">
      <input type="hidden" id="action" value="login">
      <label for="">Username</label>
      <input type="text" id="username" value=""> <br>
      <label for="">Password</label>
      <input type="password" id="password" value=""> <br>
      <button type="button" onclick="submitDataLogin();">Login</button>
    </form>
    <br>
    <a href="register.php">Go To Register</a>

    <script>
      document.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
          submitDataLogin();
        }
      });
    </script>
  </body>
</html>