<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "lyonregister");

if (!isset($_SESSION["id"])) {
    header("Location: ../includes/login.php");
    exit;
}

$query = "SELECT id, name, username FROM users";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

$html = '';
foreach ($users as $user) {
    $receiverId = $user['id'];
    $senderId = $_SESSION["id"];

    $html .= "<tr>
             <td>{$user['id']}</td>
             <td>{$user['name']}</td>
             <td>{$user['username']}</td>
             <td>
                 <a href='edit_user.php?id={$user['id']}'>Edit</a>
                 <a href='delete_user.php?id={$user['id']}'>Delete</a>
                 <a href='change_password.php?id={$user['id']}'>Change Password'";
    
    $html .= "<a href='chat.php?receiver_id={$receiverId}&sender_id={$senderId}'>Message</a>";

    $html .= "</td>
           </tr>";
}

echo $html;
?>
