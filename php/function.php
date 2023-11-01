<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "lyonregister");

if(isset($_POST["action"])){
  if($_POST["action"] == "register"){
    register();
  } elseif($_POST["action"] == "login"){
    login();
  }
}

function register(){
  global $conn;

  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $response = "";

  if(empty($name) || empty($username) || empty($password)){
    $response = "Please Fill Out The Form!";
  } elseif (strlen($password) < 6) {
    $response = "Password must be at least 6 characters long";
  } else {
    $user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($user) > 0){
      $response = "Username Has Already Been Taken";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $query = "INSERT INTO users VALUES('', '$name', '$username', '$hashedPassword')";
      mysqli_query($conn, $query);
      $response = "Registration Successful";
    }
  }
  echo $response;
}

function login(){
  global $conn;

  $username = $_POST["username"];
  $password = $_POST["password"];

  if(empty($username) || empty($password)){
    echo "Please fill out the form.";
    exit;
  }

  $user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if(mysqli_num_rows($user) > 0){

    $row = mysqli_fetch_assoc($user);
    $storedHashedPassword = $row['password'];

    if(password_verify($password, $storedHashedPassword)){
      echo "Login Successful";
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
    }
    else{
      echo "Wrong Password";
      exit;
    }
  }
  else{
    echo "User Not Registered";
    exit;
  }
}

function getChatMessages($senderUserId, $receiverUserId) {
    global $conn;

    $query = "SELECT chat.sender_userid, chat.timestamp, users.name as sender_name, chat.message
              FROM chat
              INNER JOIN users ON chat.sender_userid = users.id
              WHERE (chat.sender_userid = $senderUserId AND chat.reciever_userid = $receiverUserId)
              OR (chat.sender_userid = $receiverUserId AND chat.reciever_userid = $senderUserId)
              ORDER BY chat.timestamp";

    $result = mysqli_query($conn, $query);

    $messages = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }

    return $messages;
}

function sendMessage($senderUserId, $receiverUserId, $message) {
    global $conn;

    $message = mysqli_real_escape_string($conn, $message);

    $query = "INSERT INTO chat (sender_userid, reciever_userid, message) 
              VALUES ('$senderUserId', '$receiverUserId', '$message')";

    return mysqli_query($conn, $query);
}
?>