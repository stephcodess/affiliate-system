$(document).ready(function () {
  $("#register-form").on("submit", function (event) {
    event.preventDefault();
    var valid = true;
    var errorMessage = "";

    $(".formError").html(""); // Clear previous error messages
    $("#response-message").html("");

    $("#register-form input").on("input", function (e) {
      if ($(this).val() === "") {
        $(this).next(".formError").html("required field");
      } else {
        $(this).next(".formError").html("");
      }
    });

    // Validate each field
    if ($('#register-form input[name="first_name"]').val() === "") {
      valid = false;
      errorMessage = "First name is required.";
      $('#register-form input[name="first_name"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($('#register-form input[name="last_name"]').val() === "") {
      valid = false;
      errorMessage = "Last name is required.";
      $('#register-form input[name="last_name"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($('#register-form input[name="email"]').val() === "") {
      valid = false;
      errorMessage = "Email is required.";
      $('#register-form input[name="email"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($('#register-form select[name="gender"]').val() === "") {
      valid = false;
      errorMessage = "Gender is required.";
      $('#register-form select[name="gender"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($('#register-form input[name="phone"]').val() === "") {
      valid = false;
      errorMessage = "Phone number is required.";
      $('#register-form input[name="phone"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($('#register-form input[name="password"]').val() === "") {
      valid = false;
      errorMessage = "Password is required.";
      $('#register-form input[name="password"]')
        .next(".formError")
        .html(errorMessage);
    }
    if (
      $('#register-form input[name="password_2"]').val() !==
      $('#register-form input[name="password"]').val()
    ) {
      valid = false;
      errorMessage = "Passwords do not match.";
      $('#register-form input[name="password_2"]')
        .next(".formError")
        .html(errorMessage);
    }

    if (!$('#register-form input[name="terms_&_conditions"]').is(":checked")) {
      valid = false;
      errorMessage = "please, accept our terms and conditions.";
      $("#register-form .termserror").html(errorMessage);
    }

    if (valid) {
      var buttonText = $(".login-btn button .btn-text");
      var spinner = $(".login-btn button .spinner");
      buttonText.hide();
      spinner.show();

      $.ajax({
        url: "app/controllers/user.php",
        type: "POST",
        data: $(this).serialize(),

        success: function (response) {
          JSON.parse(response).status === "error"
            ? $("#register-form #response-message").html(
                `<p class="formError">${JSON.parse(response).message}</p>`
              )
            : $.ajax({
                url: "app/controllers/user.php", // The PHP file to handle the form submission
                type: "POST",
                data: {
                  login_user: 1,
                  email: $('#register-form input[name="email"]').val(),
                  password: $('#register-form input[name="password"]').val(),
                },

                success: function (response) {
                  if (JSON.parse(response).status === "error") {
                    $("#response-message").html(
                      `<p class="formError">${JSON.parse(response).message}</p>`
                    );
                    buttonText.show();
                    spinner.hide();
                  } else {
                    $("#response-message").html("logged in successfully.");
                    buttonText.show();
                    spinner.hide();
                    setTimeout(() => {
                      window.location.href = "dashboard/";
                    }, 3000);
                  }
                },
                error: function (e) {
                  $("#response-message").html(e.statusText);
                  buttonText.show();
                  spinner.hide();
                },
              });
          buttonText.show();
          spinner.hide();
        },
        error: function (e) {
          $("#register-form #response-message").html(e.statusText);
          buttonText.show();
          spinner.hide();
        },
      });
    }
  });

  $("#login-form").on("submit", function (event) {
    event.preventDefault();
    var valid = true;
    var errorMessage = "";

    $(".formError").html(""); // Clear previous error messages
    $("#response-message").html("");

    // Validate each field
    if ($('#login-form input[name="email"]').val() === "") {
      valid = false;
      errorMessage = "Email is required.";
      $('#login-form input[name="email"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($('#login-form input[name="password"]').val() === "") {
      valid = false;
      errorMessage = "Password is required.";
      $('#login-form input[name="password"]')
        .next(".formError")
        .html(errorMessage);
    }

    if (valid) {
      var button = $(".login-btn button");
      button.text("loging in...");

      $.ajax({
        url: "app/controllers/user.php", // The PHP file to handle the form submission
        type: "POST",
        data: $(this).serialize(),

        success: function (response) {
          if (JSON.parse(response).status === "error") {
            $("#response-message").html(
              `<p class="formError">${JSON.parse(response).message}</p>`
            );
            button.text("Login");
          } else {
            $("#response-message").html("logged in successfully.");
            button.text("redirecting");
            setTimeout(() => {
              window.location.href = "dashboard/";
            }, 3000);
          }
        },
        error: function (e) {
          $("#response-message").html(e.statusText);
          button.text("Login");
        },
      });
    }
  });
});
