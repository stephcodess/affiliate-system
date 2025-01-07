<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Document</title>
  <link
      href="https://testcheckout.spaybusiness.com/pay/static/css/spay_checkout.css"
      rel="stylesheet"
    />
</head>

<body>

  <style>
    body {
      height: 100vh !important;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .order-summary {
      width: 400px;
      height: 500px;
      padding: 20px;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .order-summary h1 {
      color: #333333;
      margin-bottom: 20px;
      font-size: 24px;
      margin-top: 20px;
    }

    .order-summary p {
      margin: 5px 0;
      font-size: 16px;
    }

    .order-summary span {
      font-weight: bold;
      color: #555555;
    }

    #payWithSpay {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #AF5CE5;
      color: #ffffff;
      transition: background-color 0.3s, transform 0.3s;
      height: 47px;
      width: 90%;
      margin: auto;
      border-radius: 47px;
      cursor: pointer;
      border: none;
    }

     #goBack {
      margin-top: 10px;
      padding: 10px 20px;
      background-color: #6c757d;
      color: #ffffff;
      transition: background-color 0.3s, transform 0.3s;
      height: 47px;
      width: 90%;
      margin: auto;
      border-radius: 47px;
      cursor: pointer;
      border: none;
    }
  </style>

  <div class="order-summary">
    <div>
      <img style="width: 70px; height: 70px; margin: auto;"
        src="../../assets/images/fb instsa profile logo  png -02.png" alt="" />
    </div>
    <h1>Order Summary</h1>
    <div id="orderSummary">
      <p>Name: <span id="full_name"></span></p>
      <p>Email: <span id="emailAddress"></span></p>
      <p>Phone Number: <span id="phoneNumber"></span></p>
      <p>State: <span id="state"></span></p>
      <p>Unit Price: <span id="unitPrice"></span></p>
      <p>Address: <span id="address"></span></p>
      <p>Quantity: <span id="quantity"></span></p>
      <p>Total Amount: <span id="totalAmount"></span></p>
    </div>
    <button id="payWithSpay" onclick="payWithSpay()">Pay With Spay</button>

    <button id="goBack" onclick="history.back()">Go Back</button>
  </div>
  <script
    type="text/javascript"
    src="https://testcheckout.spaybusiness.com/pay/static/js/spay_checkout.js"></script>
  <!-- <script type="text/javascript" src="https://checkout.spaybusiness.com/pay/static/js/spay_checkout.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function getCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    }

    function displayOrderSummary() {
      var formData = JSON.parse(getCookie("formData"));
      if (!formData) {
        alert("No form data found in cookies");
        return;
      }

      var emailAddress = formData[0];
      var phoneNumber = formData[1];
      var state = formData[2];
      var unit_price = formData[3];
      var address = formData[4];
      var quantity = formData[5];
      var full_name = formData[6];

      $('#full_name').text(full_name);
      $('#emailAddress').text(emailAddress);
      $('#phoneNumber').text(phoneNumber);
      $('#state').text(state);
      $('#unitPrice').text(unit_price);
      $('#address').text(address);
      $('#quantity').text(quantity);
      $('#totalAmount').text(parseFloat(quantity) * parseFloat(unit_price));
    }

    function payWithSpay() {
      var formData = JSON.parse(getCookie("formData"));
      if (!formData) {
        alert("No form data found in cookies");
        return;
      }

      var emailAddress = formData[0];
      var phoneNumber = formData[1];
      var state = formData[2];
      var unit_price = formData[3];
      var address = formData[4].split('+').join(" ");
      var quantity = formData[5];
      var full_name = formData[6].split("+").join(" ");

      var handler = {
        amount: parseFloat(quantity) * parseFloat(unit_price),
        currency: "NGN",
        reference: "spay-" + new Date().getTime(),
        merchantCode: "TMH_hybxoaugfecsy3k",
        customer: {
          firstName: full_name,
          phone: phoneNumber,
          email: emailAddress,
        },
        callback: function (response) {
          console.log("do something with response", response);
          if (response.status === 'success') {
            $.ajax({
              url: "../../app/controllers/orders.php",
              type: "POST",
              data: {
                full_name: full_name,
                email_address: emailAddress,
                phone_number: phoneNumber,
                state: state,
                address: address,
                quantity: quantity,
                total_amount_paid: parseFloat(quantity) * parseFloat(unit_price),
                affiliate_id: getCookie("affiliate_id"),
                order_product: 1
              },
              success: function (response) {
                console.log(response);
                deleteCookie("formData");
                setTimeout(() => {
                  window.location.href = "../";
                }, 3000);
              },
              error: function (e) {
                alert("Error: " + e.statusText);
              }
            });
          } else {
            alert('Payment failed. Please try again.');
          }
        },
        onClose: function () {
          console.log("do something before closing");
        },
      };

      window.SpayCheckout.init(handler);
    }

    $(document).ready(function () {
      displayOrderSummary();
    });
  </script>
</body>

</html>