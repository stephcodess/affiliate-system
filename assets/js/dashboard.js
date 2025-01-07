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
        const affiliate_link = `https://curbinfect.com/order/?id=${
          random7DigitText + data.data.id
        }`;
        $.ajax({
          url: "../app/controllers/dashboard.php?earnings=1",
          method: "GET",
          dataType: "json",
          success: function (user) {
            var tableBody = $(".earnings-table tbody");
            tableBody.empty(); // Clear any existing rows

            var totalEarnings = 0; // Initialize total earnings variable
            var totalproducts = 0;

            user.forEach(function (row, index) {
              totalEarnings += parseFloat(row.earning);
              totalproducts += parseInt(row.product_quantity);
              var tableRow =
                "<tr><td class='align-middle text-left'>" +
                (index + 1) +
                "</td>" +
                "<td class='align-middle text-center'>" +
                row.product_quantity +
                "</td>" +
                "<td class='align-middle text-center text-sm'>" +
                "<span class=''>" +
                row.earning +
                "<span></td>" +
                "<td class='align-middle text-center'>" +
                "<span class='text-secondary text-xs font-weight-bold'>" +
                row.date +
                "<span></td>" +
                "</tr>";
              tableBody.append(tableRow);
            });

            var totalWithdrawn =
              totalEarnings - parseFloat(data.data.wallet_balance);

            $(".total-earnings").text("#" + totalEarnings.toFixed(2));
            $(".total-withdrawal").text("#" + totalWithdrawn.toFixed(2));
            $(".available-earnings").text("#" + data.data.wallet_balance);
            $(".total-products").text(totalproducts);
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

  $(".logout-btn").click(() => {
    $.ajax({
      url: "../app/controllers/user.php?logout_user=1",
      method: "GET",
      dataType: "json",
      success: function (data) {
        window.location.href = "./";
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
});
