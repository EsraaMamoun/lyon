function submitData() {
  let data = {
    name: $("#name").val(),
    username: $("#username").val(),
    password: $("#password").val(),
    action: $("#action").val(),
  };

  $.ajax({
    url: "../php/function.php",
    type: "post",
    data: data,
    success: function (response) {
      if (response === "Registration Successful") {
        $("#successfulMessage").html(response);
        $("#name").val("");
        $("#username").val("");
        $("#password").val("");

        setTimeout(function () {
          $("#successfulMessage").html("");
        }, 5000);
      } else if (response === "Please Fill Out The Form!") {
        alert(response);
      }

      $("#nameError").html(response.includes("Name") ? response : "");
      $("#usernameError").html(response.includes("Username") ? response : "");
      $("#passwordError").html(response.includes("Password") ? response : "");
    },
  });
}

function submitDataLogin() {
  let username = $("#username").val();
  let password = $("#password").val();
  let action = $("#action").val();

  let data = {
    username: username,
    password: password,
    action: action,
  };

  $.ajax({
    url: "../php/function.php",
    type: "post",
    data: data,
    success: function (response) {
      alert(response);
      window.location.reload();
    },
  });
}
