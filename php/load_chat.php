<?php
require 'function.php';

if (isset($_GET['senderUserId']) && isset($_GET['receiverUserId'])) {
    $senderUserId = $_GET['senderUserId'];
    $receiverUserId = $_GET['receiverUserId'];

    $chatMessages = getChatMessages($senderUserId, $receiverUserId);

    foreach ($chatMessages as $message) {
        echo "<p><strong>" . $message['sender_name'] . ":</strong> " . $message['message'] . "</p><p style='color: gray; font-size: 10px; margin-top: -15px'>" .  $message['timestamp'] . "</p>";
    }
}
?>
