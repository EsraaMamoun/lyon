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
    <title>Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
  </head>
  <body>
    <h2>Register</h2>
    <form autocomplete="off" action="" method="post">
      <input type="hidden" id="action" value="register">
      <label for="name">Name</label>
      <input type="text" id="name" name="name">
      <p id="nameError" style="color: red;"></p>
      <label for="username">Username</label>
      <input type="text" id="username" name="username"> 
      <p id="usernameError" style="color: red;"></p> 
      <label for="password">Password</label>
      <input type="password" id="password" name="password"> 
      <p id="passwordError" style="color: red;"></p> 
      <div id="successfulMessage" style="color: green;"></div>
      <button type="button" onclick="submitData();">Register</button>
    </form>
    <br>
    <a href="login.php">Go To Login</a>
    <script>
      document.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
          submitData();
        }
      });
    </script>
  </body>
</html>