<?php
require './function.php';

if (isset($_POST['senderUserId']) && isset($_POST['receiverUserId']) && isset($_POST['message'])) {
    $senderUserId = $_POST['senderUserId'];
    $receiverUserId = $_POST['receiverUserId'];
    $message = $_POST['message'];

    if (sendMessage($senderUserId, $receiverUserId, $message)) {
        echo "Message sent successfully";
    } else {
        echo "Error sending message";
    }
}
?>
