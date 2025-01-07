<?php
include_once ("../path.php");

include_once (ROOT_PATH . "/app/includes/header.php");
$product_settings = selectAll('product_variations');
?>
<div class="modal" id="checkoutModal">

  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="left">
      <div class="overlay"></div>
    </div>
    <span class="close">&times;</span>
    <div class="right">
      <div class="modal-header">
        <h2 class="modal-title" id="checkoutModalLabel">
          PAY WITH SPAY
        </h2>

      </div>
      <div class="modal-body">
        <!-- Spay checkout details -->
        <form id="flutterwaveForm">
          <input type="text" name="order_product" hidden value="10" />
          <div class="input-wrapper">
            <label for="email_address" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name"
              placeholder="Enter your email address" />
            <div class="formError"></div>
          </div>
          <input type="text" id="quantity" name="quantity" value="1" hidden />
          <input type="text" name="total_amount_paid" id="total_amount_paid"
            value="<?php echo $product_settings[0]['price'] ?>" hidden />
          <input type="text" name="affiliate_id" id="affiliate_id" value="0" hidden />
          <div class="input-wrapper">
            <label for="email_address" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="emailAddress" name="email_address"
              placeholder="Enter your email address" />
            <div class="formError"></div>
          </div>
          <div class="input-wrapper">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phoneNumber" name="phone_number"
              placeholder="Enter your phone number" />
            <div class="formError"></div>
          </div>
          <div class="input-wrapper">
            <label for="state" class="form-label">State</label>
            <select class="form-select" id="state" name="state">
              <option value="" selected disabled>Select State</option>

            </select>
            <div class="formError"></div>
          </div>
          <div class="input-wrapper">
            <label for="address" class="form-label">Home Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your home address" />
            <div class="formError"></div>
          </div>
          <br />
          <div class="modal-btn">
            <button type="button" id="payButton">
              Continue to Pay
            </button>
          </div>

        </form>

      </div>
    </div>

  </div>

</div>
<div class="container-fluid py-4">
  <section class="product-detail">
    <div class="container">
      <div class="product-image">
        <img src="../assets/images/5DRSEYI.jpg" alt="Product Image" />
      </div>
      <div class="product-details">
        <h1 class="product-name">Curbinfect</h1>
        <h1>herbal Mixture</h1>
        <p class="description">
          Short Description of the product goes here.
        </p>
        <p class="price">#<?php echo $product_settings[0]['price'] ?></p>
        <div class="quantity">
          <label for="quantity">Quantity:</label>
          <div class="quantity-input">
            <button type="button" class="quantity-btn" id="decreaseQtyBtn">
              -
            </button>

            <input type="text" id="quantityInput" name="quantity" value="1" />
            <button type="button" class="quantity-btn" id="increaseQtyBtn">
              +
            </button>
          </div>
        </div>
        <button class="order_confirm" id="addToCartBtn">order</button>
      </div>
    </div>
    <div class="tabs">
      <button class="tablinks" data-tab="Tab1" id="defaultOpen">
        Description
      </button>
      <!-- <button class="tablinks" data-tab="Tab2">Direction of use</button>
      <button class="tablinks" data-tab="Tab3">Reviews</button> -->
    </div>

    <div id="Tab1" class="tabcontent">
      <p>
        <b>Curbinfect</b> is a transformational herbal drink for
        treating stubborn drug-resistant infections like gonorrhea,
        syphilis, chlamydia, pelvic inflammatory disease, and more. It’s
        also popular for beating long-term infertility issues in both men
        and women. It may just be what you need to end everything about sexually transmitted infections and
        infertility
        problems.
      </p>
      <br />
      <h3>Why do 100s of STI patients say <b>curbinfect</b> is the solution they have been looking for to get the
        kind
        of healing they’ve been praying for for years?</h3>
      <p>

        It’s simple…<br />

        Since it was introduced to the market, <b>CURBINFECT</b> has done wonders in the lives of many of my
        patients
        who have used it so far and the testimonials keep dropping on my table every passing day.

        As you’re reading this, <b>CURBINFECT</b> is healing someone somewhere around the world.

        I’m confident you’ll get the same amazing healing when you try it out.

        <b>Curbinfect</b> was not created to treat symptoms. It was actually formulated to locate and treat the root
        cause of the symptoms

        Symptoms like…

        <b>Curbinfect</b> has not only out-powered stubborn drug-resistant infections but it has also destroyed
        Infertility issues and RESTORED happiness in many families who had issues getting pregnant for many years.

        Using <b>CURBINFECT</b>, helped them to expel all the infertility issues they had, and soon enough, they
        were
        able to conceive and give birth to a healthy baby they’d always dreamed of.

        And look…it doesn’t matter how long the situation has stayed with you.

        <b>CURBINFECT</b> doesn’t care about how Chronic the infection is either.

        As was reported by many patients, amazing changes in their health began to show up on day 3 after using
        <b>CURBINFECT</b>.

        However, the most DRAMATIC results are more reported after 14 days of usage.

        And because situations vary from patient to patient, some people will need to take more than one bottle to
        achieve the remarkable healing the product brings to the body.

        See a few of the 100s of testimonials we have received from happy patients that have enjoyed the amazing
        benefits inside this miraculous healing-formula.
      </p>

      <br />
      <h3> THE INGREDIENTS IN CURBINFECT</h3>
      <p>
        What is <b>curbinfect</b> made of? You may ask…

        There are 5 powerful plants that combine to make this remarkable product that’s changing lives for good when
        it
        comes to treating STIs.

        They all have a history of amazing healing over the years for more than 2000+ years ago, these special
        ingredients
        have been used by physicians to achieve REMARKABLE healing for patients.

        And the product has been scientifically prepared in the lab to give the best results when it comes to
        clearing
        infections out of your system so you can enjoy a healthy life without being worried about anything anymore.

        See the ingredients…

        1. Citrullus colocynthis: Dated far back to 3800 B.C.E. Back in the time of the ‘Roman Empire’

        The plant is native to the Mediterranean Asians of Turkey and has long been used since then by physicians
        for
        healing and lowering inflammations for better health performance.

        It’s also rich in antimicrobial nutrients which makes it super effective in treating STIs.

        Allium sativum: Native to Ancient Indians. It has long been used by the Egyptians during the time when they
        were
        building the ‘Pyramids of Cheops’ to combat infections and boost energy. That is why they were able to work
        for
        long hours under the sun without tiring out.

        It is famous for boosting libido by regulating the appropriate supply of hormones at the right time to the
        right
        places to help you get a STRONNG erection and enjoy pleasurable sex with your partner as long as you want.

        2. Sida acuta: Super effective for combating— erectile dysfunction, throat diseases, urinary tract infection
        (UTI),
        V. Dryness, headache and bronchitis.
        3.Acacia Nilotica: So named by the Swedish scientist Carl Linnaeus when it was first discovered in the
        1700s.

        This plant has long been known to relieve pain, irritation and wound healing by the old world of central
        America
        and is super effective in treating chronic infections like Gonorrhea and chlamydia.

        4. Curculigo pilosa: Known by the Yorubas as EPAKUN is an Indian spinach that’s superlative in curbing
        infertility
        issues and reversing impotence in both men and women.

        It is the extra ingredient that’s helped many users of <b>CURBINFECT</b> to welcome their first child after
        many
        years of infertility in their marriage.

        So…

        If you’ve tried many products that failed to work or you haven’t tried anything yet but you just want a
        formula
        that’ll…

      <ul>
        <li>Silent the pain and bleeding during sex so you can enjoy the pleasure you crave for with your partner as
          long as
          you want
        </li>
        <li>Eliminate the Uncontrolled itching in your private part even when you’re in the public so you can move
          freely
          without anything to worry about again
        </li>
        <li>STOP the shame of the foul smelling discharge from your genitals that follows you around
          And end the excessive spending on drugs that don’t work for infections…</li>
      </ul>
      </p>
      <p style="text-transform: uppercase; font-weight: bolder;">Give us a try today.</p>
    </div>

    <!-- <div id="Tab2" class="tabcontent">
      <h3>Tab 2</h3>
      <p>Content for Tab 2.</p>
    </div>

    <div id="Tab3" class="tabcontent">
      <h3>Tab 3</h3>
      <p>Content for Tab 3.</p>
    </div> -->
  </section>

  <section class="contact-section" data-aos="zoom-out" data-aos-duration="3000">
    <div class="content">
      <h2>Need help with the usage?</h2>
      <div class="book display-flex flex-row">
        <span><span class="d-sm-none">call</span> <span style="color: #fff;"> +234 915 559 4361 </span><span
            class="d-sm-none">or</span> </span>
        <div class="btn"><button>book an appointment</button></div>
      </div>
    </div>
  </section>


  <footer class="footer-section display-flex flex-column" data-aos="zoom-out">
    <div class="section1 display-flex flex-row">
      <span>#CURBINFECT</span>
      <div class="social-icons display-flex flex-row">
        <a href="https://www.instagram.com/drseyibotanical?igsh=bnU0bm90YWx2NWMz"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/profile.php?id=61559984064868&mibextid=ZbWKwL"><i
            class="fab fa-facebook"></i></a>
        <a href="https://wa.link/ndir6h"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
    <div class="footer-nav display-flex flex-column">
      <div class="container footer-nav-inner display-flex flex-row">
        <span><a href="<?php echo BASE_URL ?>">home</a></span>
        <span><a href="">About us?</a></span>
        <!-- <span><a href="">contact us</a></span> -->
        <span><a href="<?php echo BASE_URL ?>#slider_section">become an affiliate</a></span>
        <span><a href="<?php echo BASE_URL . '/terms' ?>">Terms & conditions</a></span>
      </div>
    </div>

    <div class="section3">
      <p>
        Our Vision is to be a center for health promotion, disease<br /> prevention and transforming patients
        ailment or
        symptoms to active<br /> health restoration and wellness on physical, mental and emotional levels.
      </p>
      <span>Copyright © {2023} - curbinfect.com</span>
    </div>
  </footer>
  <script>
    $(document).ready(() => {
      var url = window.location.href;
      var idParam = new URL(url).searchParams.get("id");

      if (idParam) {
        var remainingNumber = idParam.substring(7);
        $("#affiliate_id").val(remainingNumber);
        setCookie("affiliate_id", remainingNumber, 30);
      } else {
        var cookieValue = getCookie("affiliate_id");
        if (cookieValue) {
          $("#affiliate_id").val(cookieValue);
        }
      }

      function setCookie(name, value, days) {
        var expires = "";
        if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
      }

      function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
      }
    });
    $(document).ready(function () {
      $(".order_confirm").click(function (e) {
        e.preventDefault()
        $("#checkoutModal").addClass("active");
        $(".modal-content").addClass("active");
      });

      function deleteCookie(name) {
        document.cookie = name + "=; Expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
      }

      // Populate the state dropdown
      var states = [
        "Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi",
        "Edo", "Ekiti", "Enugu", "FCT", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara",
        "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"
      ];

      var stateSelect = $("#state");
      states.forEach(function (state) {
        var option = $("<option></option>").val(state).text(state);
        stateSelect.append(option);
      });


      // Form validation function
      function validateForm() {
        var isValid = true;
        $(".formError").html(""); // Clear all previous errors

        if ($("#full_name").val().trim() === "") {
          $("#full_name").next(".formError").html("Full Name is required.");
          isValid = false;
        }

        if ($("#emailAddress").val().trim() === "") {
          $("#emailAddress").next(".formError").html("Email Address is required.");
          isValid = false;
        }

        if ($("#phoneNumber").val().trim() === "") {
          $("#phoneNumber").next(".formError").html("Phone Number is required.");
          isValid = false;
        }

        if ($("#state").val().trim() === "") {
          $("#state").next(".formError").html("State is required.");
          isValid = false;
        }

        if ($("#address").val().trim() === "") {
          $("#address").next(".formError").html("Home Address is required.");
          isValid = false;
        }

        return isValid;
      }

      // Open Spay payment modal
      $("#payButton").click(function (e) {
        e.preventDefault();

        if (!validateForm()) {
          return; // Stop the submission if form is not valid
        }

        var emailAddress = $("#emailAddress").val();
        var phoneNumber = $("#phoneNumber").val();
        var state = $("#state").val();
        var unit_price = $("#total_amount_paid").val();
        var address = $("#address").val();
        var quantity = $("#quantity").val();
        var name = $("#full_name").val();

        var formData = [emailAddress, phoneNumber, state, unit_price, address, quantity, name];
        setCookie("formData", JSON.stringify(formData), 1)
        window.location.href = "./checkout/";

      });

      function setCookie(name, value, days) {
        var expires = "";
        if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
      }

    });

    // Update quantity
    $("#increaseQtyBtn").click(function () {
      var quantityInput = $("#quantity");
      var currentQuantity = parseInt(quantityInput.val());
      var newQuantity = currentQuantity + 1;
      $('#quantityInput').val(newQuantity)
      quantityInput.val(newQuantity);
    });

    $("#decreaseQtyBtn").click(function () {
      var quantityInput = $("#quantity");
      var currentQuantity = parseInt(quantityInput.val());
      if (currentQuantity > 1) {
        var newQuantity = currentQuantity - 1;
        $('#quantityInput').val(newQuantity)
        quantityInput.val(newQuantity);
      }
    });

    // Tabs functionality
    function openTab(tabName) {
      $(".tabcontent").hide();
      $(".tablinks").removeClass("active");
      $("#" + tabName).show();
      $(".tablinks[data-tab='" + tabName + "']").addClass("active");
    }

    $(".tablinks").click(function () {
      var tabName = $(this).data("tab");
      openTab(tabName);
    });


    openTab("Tab1");

  </script>

  <script src="../assets/js/vendor/bootstrap.js"></script>
  <script type="text/javascript" src="../assets/js/vendor/slick.min.js"></script>
  <script src="../assets/js/vendor/aos.js"></script>
  <script src="../assets/js/input-validation.js"></script>

  <script>
    AOS.init({
      once: true,
    });
  </script>
  <script src="../assets/js/main.js"></script>
  </body>

  </html>