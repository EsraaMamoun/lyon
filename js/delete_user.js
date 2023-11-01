$(document).ready(function () {
  $("#deleteBtn").click(function () {
    if (userId > 0) {
      $.ajax({
        url: "../includes/delete_user.php",
        method: "POST",
        data: { user_id: userId },
        success: function (data) {
          if (data === "User deleted successfully") {
            window.location.href = "/user_list.php";
          } else {
            console.error("Error deleting user: " + data);
          }
        },
        error: function (xhr, status, error) {
          console.error("Error deleting user: " + error);
        },
      });
    } else {
      console.error("Invalid user ID");
    }
  });
});
