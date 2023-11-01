$(document).ready(function () {
  $("#editForm").submit(function (e) {
    e.preventDefault();

    let name = $("input[name='name']").val();
    let username = $("input[name='username']").val();
    let errorMessage = $("#errorMessage");

    errorMessage.text("");

    if (userId > 0) {
      $.ajax({
        url: "../php/update_user.php",
        method: "POST",
        data: {
          user_id: userId,
          name: name,
          username: username,
        },
        success: function (data) {
          if (data === "User updated successfully") {
            window.location.href = "../includes/user_list.php";
          } else {
            errorMessage.text(data);
          }
        },
        error: function (xhr, status, error) {
          console.error("Error updating user: " + error);
          errorMessage.text("An error occurred while updating the user.");
        },
      });
    } else {
      errorMessage.text("Invalid user ID");
    }
  });
});
