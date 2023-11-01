$(document).ready(function () {
  function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  let receiverUserId = getUrlParameter("receiver_id");
  let senderUserId = getUrlParameter("sender_id");

  if (receiverUserId === null || senderUserId === null) {
    console.log("Receiver and/or sender user ID not found in the URL");
    return;
  }

  loadChat();

  $("#send").on("click", function () {
    sendMessage(senderUserId, receiverUserId);
  });

  $("#message").on("keypress", function (e) {
    if (e.which === 13) {
      sendMessage(senderUserId, receiverUserId);
    }
  });

  setInterval(function () {
    loadChat();
  }, 1000);

  function loadChat() {
    $.ajax({
      type: "GET",
      url: "../php/load_chat.php",
      data: { senderUserId: senderUserId, receiverUserId: receiverUserId },
      success: function (response) {
        $("#chat-messages").html(response);
      },
    });
  }

  function sendMessage(senderUserId, receiverUserId) {
    let message = $("#message").val();

    $.ajax({
      type: "POST",
      url: "../php/send_message.php",
      data: {
        senderUserId: senderUserId,
        receiverUserId: receiverUserId,
        message: message,
      },
      success: function (response) {
        $("#message").val("");
        loadChat();
      },
    });
  }
});
