$(document).ready(function () {
  loadUserData();
});

function loadUserData() {
  $.ajax({
    url: "../php/get_users.php",
    method: "GET",
    success: function (data) {
      $("#userTable tbody").html(data);
    },
    error: function (xhr, status, error) {
      console.error("Error loading user data: " + error);
    },
  });
}
