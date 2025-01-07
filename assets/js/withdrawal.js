$(document).ready(function () {
  function generateRandomText() {
    var randomNumber = Math.floor(Math.random() * 10000000);
    var randomText = randomNumber.toString();
    while (randomText.length < 7) {
      randomText = "0" + randomText;
    }

    return randomText;
  }

  var random7DigitText = generateRandomText();

  $.ajax({
    url: "../app/controllers/dashboard.php?profile=1",
    method: "GET",
    dataType: "json",
    success: function (data) {
      if (data.status === "error") {
        if (data.status_code === 401) {
          alert(data.message);
          window.location = "../";
        }
      } else {
        const { pathname, origin } = window.location;
        const affiliate_link = `${origin}/${pathname.split("/")[1]}/order/?id=${
          random7DigitText + data.data.id
        }`;
        $.ajax({
          url: "../app/controllers/dashboard.php?withdrawals=1",
          method: "GET",
          dataType: "json",
          success: function (withdrawals) {
            var tableBody = $(".earnings-table tbody");
            tableBody.empty(); // Clear any existing rows
            if (withdrawals.status === "success") {
              if (withdrawals.data.length > 0) {
                var totalEarnings = 0; // Initialize total earnings variable
                var totalproducts = 0;

                withdrawals.data.forEach(function (row, index) {
                  totalEarnings += parseFloat(row.earning);
                  totalproducts += parseInt(row.product_quantity);
                  var tableRow =
                    "<tr><td class='align-middle text-left'>" +
                    (index + 1) +
                    "</td>" +
                    "<td class='align-middle text-center text-sm'>" +
                    "<span class=''>" +
                    row.amount +
                    "<span></td>" +
                    `<td class='align-middle text-center'>${
                      row.status === 0
                        ? '<span class="badge badge-sm bg-gradient-danger">pending</span>'
                        : '<span class="badge badge-sm bg-gradient-success">processed</span>'
                    }</td>` +
                    "<td class='align-middle text-center'>" +
                    "<span class='text-secondary text-xs font-weight-bold'>" +
                    row.date +
                    "<span></td>" +
                    "</tr>";
                  tableBody.append(tableRow);
                });
              } else {
                var tableRow = `<tr><td class='align-middle text-center'>You have not initiated a withdrawal request yet.</td></tr>`;
                tableBody.append(tableRow);
              }
            } else {
              var tableRow = `<tr><td class='align-middle text-center'>${withdrawals.message}</td></tr>`;
              tableBody.append(tableRow);
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
        $("#affilate-link").val(affiliate_link);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });

  $("#withdrawalForm input, #withdrawalForm select").on(
    "input change",
    function () {
      const isValid = $(this).val() !== "";
      const errorMessage = isValid ? "" : "required field";
      $(this).next(".formError").html(errorMessage);
    }
  );

  $("#withdrawalForm").on("submit", function (event) {
    event.preventDefault();
    var valid = true;
    var errorMessage = "";

    $(".formError").html(""); // Clear previous error messages
    $(".response-message").html("");

    // Validate each field
    if ($('#withdrawalForm input[name="withdrawal_amount"]').val() === "") {
      valid = false;
      errorMessage = "Withdrwal Amount is required.";
      $('#withdrawalForm input[name="withdrawal_amount"]')
        .next(".formError")
        .html(errorMessage);
    }
    if ($("#withdrawalForm #withdrawalAccount").val() === "") {
      valid = false;
      errorMessage = "please, select a withdrawal account.";
      $("#withdrawalForm #withdrawalAccount")
        .next(".formError")
        .html(errorMessage);
    }

    if (valid) {
      var button = $("#withdrawBtn");
      button.text("processing...");

      $.ajax({
        url: "../app/controllers/dashboard.php", // The PHP file to handle the form submission
        type: "POST",
        data: $(this).serialize(),

        success: function (response) {
          console.log(JSON.parse(response));
          if (JSON.parse(response).status === "error") {
            $(".response-message").html(
              `<p class="formError">${JSON.parse(response).message}</p>`
            );
            button.text("Withdraw");
          } else {
            $(".response-message").html(
              "<p style='color: green;'>withdrawal request has been recieved.</p>"
            );
            $("#withdrawalModal").hide();
          }
        },
        error: function (e) {
          $(".response-message").html(e.statusText);
          button.text("Withdraw");
        },
      });
    }
  });
  $(".logout-btn").click(() => {
    $.ajax({
      url: "../app/controllers/user.php?logout_user=1",
      method: "GET",
      dataType: "json",
      success: function (data) {
        console.log(JSON.parse(data));
        window.location.href="./"
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
});
