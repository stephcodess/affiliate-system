<?php
include_once (ROOT_PATH . "/app/database/functions.php"); ?>

<!DOCTYPE php>
<php lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL . '/apple-touch-icon.png' ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL . '/favicon-32x32.png' ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL . '/favicon-16x16.png' ?>">
    <link rel="manifest" href="<?php echo BASE_URL . '/site.webmanifest' ?>">
    <link rel="mask-icon" href="<?php echo BASE_URL . '/safari-pinned-tab.svg" color="#5bbad5' ?>">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Curbinfect</title>
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/fontawesome.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/slick.min.css' ?>" />
    <!-- <link rel="stylesheet" href="./assets/css/bootstrap.css" /> -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/style.css' ?>" />
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/aos.css' ?>" />
    <script src="<?php echo BASE_URL . '/assets/js/vendor/jquery-3.6.0.min.js' ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  </head>

  <body class="home-page">
    <!--==============================
     Preloader
    ==============================-->
    <div class="preloader">
      <div class="preloader-inner">
        <span class="loader"></span>
      </div>
    </div>

    <div class="mobile-nav show">
      <div class="mobile-sub-menu">
        <div class="mobile-close-btn">
          <span>CLOSE</span>
        </div>

      </div>
      <div class="nav-container">
        <ol class="container-ul">
          <li><a href="<?php echo BASE_URL ?>">home</a></li>
          <!-- <li><a href="about-us.php">about us</a></li> -->
          <li><a href="<?php echo BASE_URL . '/terms' ?>">Terms & Conditions</a></li>
          <!-- <li><a href="./">contact</a></li> -->
          <li><a href="./" class="affiliate-login-link">Affiliate Login</a></li>
        </ol>

      </div>

    </div>
    <!--==============================
     Header Section
    ==============================-->
    <header class="header-wrapper">
      <div class="header-container">
        <div class="header-content display-flex flex-row">

          <div class="header-logo">
            <a href="<?php echo BASE_URL ?>"> <img
                src="<?php echo BASE_URL . '/assets/images/fb instsa profile logo  png -02.png' ?>" alt="" /></a>
            <div class="logo-text">
              <h1>Curbinfect</h1>
              <span>Herbal Mixture</span>
            </div>
          </div>
          <div class="header-btns display-flex flex-row">
            <!-- <div class="btn"><button onclick="'">REQUEST APPOINTMENT</button></div> -->
            <?php if (isset($_COOKIE['auth_token'])) { ?>
              <div class="btn" onclick="window.location.href='./dashboard'"><button>GO TO
                  DASHBOARD</button></div><?php } else { ?>
              <div class="btn affiliate-login-btn"><button>AFFILIATE LOGIN</button></div><?php } ?>
          </div>
          <div class="nav-toggle">
            <!-- <i class="fas fa-bars"></i> -->
            <div class="toggle-bars"></div>
          </div>
        </div>
      </div>
      <div class="header-nav display-flex flex-column">
        <nav class="header-nav-inner display-flex flex-row">
          <ul class="nav-ul">
            <li><a href="<?php echo BASE_URL; ?>">home</a>
            </li>
            <!-- <li><a href="about-us.php">about us</a></li> -->
            <li><a class="openLoginModal" href="">become an affiliate</a></li>
            <li>
              <a href="<?php echo BASE_URL . '/terms' ?>">Terms & conditions</a>
            </li>

            <!-- <li><a href="contact.php">contact us</a>

            </li> -->

          </ul>

        </nav>
      </div>
    </header>

    <div id="registerModal" class="modal">

      <div class="modal-content">
        <span class="close">&times;</span>
        <div class="left">
          <div class="overlay"></div>
        </div>
        <div class="right">

          <form id="login-form">
            <br />
            <h2>AFFILIATE LOGIN</h2><br />
            <input hidden name="login_user" value="0" />
            <div class="input-wrapper">
              <label>Email</label>
              <input type="email" name="email" />
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Password</label>
              <input type="password" name="password" />
              <div class="formError"></div>
            </div>
            <div style="width: 100%; display:flex; flex-direction: row; justify-content: flex-end;">
              <a href="">Forgot Password</a>
            </div>
            <div id="response-message"></div>
            <div class="login-btn modal-btn">
              <button type="submit">Continue</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <style>
      .formError {
        color: red;
        font: 10px;
      }
    </style>

    <div id="loginModal" class="modal">

      <div class="modal-content">
        <span class="close">&times;</span>
        <div class="left">
          <div class="overlay"></div>
        </div>
        <div class="right">
          <div class="modal-header">
            <h2 class="form-header">AFFILIATE REGISTRATION</h2><br />
            <h2 style="display: none; text-transform: uppercase;" class="terms-header">Curbinfect Affiliate Program
              Terms
              and Conditions</h2>
          </div>
          <form id="register-form">
            <input hidden name="register_user" value="0" />
            <input hidden name="is_admin" value="0" />
            <div class="input-wrapper">
              <label>First Name</label>
              <input type="text" name="first_name" />
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Last Name</label>
              <input type="text" name="last_name" />
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Email</label>
              <input type="email" name="email" />
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Gender</label>
              <select name="gender">
                <option value=""></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Phone</label>
              <input placeholder="0818488474" type="tel" name="phone" />
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Password</label>
              <input type="password" name="password" />
              <div class="formError"></div>
            </div>
            <div class="input-wrapper">
              <label>Confirm Password</label>
              <input type="password" name="password_2" />
              <div class="formError"></div>
            </div>
            <div style="width: 100%; display:flex; gap:10px; flex-direction: row; justify-content: flex-start;">
              <span>Already have an account? </span><a href="" class="login-href">Login</a>
            </div>
            <div class="terms-link"
              style="width: 100%; display:flex; gap:10px; flex-direction: row; justify-content: flex-start;">
              <input type="checkbox" style="width: 20px; height: 20px;" name="terms_&_conditions" />
              <span style="font-weight: bolder; text-transform: uppercase; cursor: pointer;">Terms & Conditions</span>

            </div>
            <div class="termserror formError"></div>
            <div id="response-message"></div>
            <div class="login-btn modal-btn">
              <button type="submit"><i class="fas fa-spinner fa-spin spinner" style="display:none;"></i>
                <span class="btn-text">Sign Up</span></button>
            </div>
          </form>
          <style>
            .terms-wrapper {
              position: absolute;

              width: 90%;
              left: 5%;
              top: 6rem;

              margin-bottom: 1rem;
            }

            .terms-wrapper ol:nth-child(1) {
              display: flex;
              flex-direction: column;
              gap: 2rem;
            }

            .terms-wrapper ol:nth-child(1) ol li {
              line-height: 2.5rem;
              list-style: lower-roman;
            }
          </style>
          <div class="terms-wrapper" style="display: none;">

            <ol>
              <li style="margin-top: 0px;">
                <h3>Eligibility</h3>
                <ol type="a">
                  <li><strong>Age:</strong> You must be at least 18 years old to participate in the Curbinfect Affiliate
                    Program.</li>
                  <li><strong>Marketing Savviness:</strong> You must have basic marketing knowledge and skills to
                    promote
                    Curbinfect effectively.</li>
                  <li><strong>Residency:</strong> You can reside in Nigeria or any other part of the world, but you must
                    comply with local laws and regulations.</li>
                  <li><strong>Technology:</strong> You must have a smartphone or PC with internet access to participate
                    in
                    the program.</li>
                  <li><strong>Online Presence:</strong> You must have a fairly good online presence, including social
                    media
                    profiles or a website, to promote Curbinfect.</li>
                </ol>
              </li>

              <li>
                <h3>Enrollment</h3>
                <ol type="a">
                  <li><strong>Application:</strong> You must submit an application to join the Curbinfect Affiliate
                    Program,
                    which includes providing accurate personal and marketing information.</li>
                  <li><strong>Approval:</strong> Curbinfect reserves the right to approve or reject your application.
                  </li>
                </ol>
              </li>

              <li>
                <h3>Responsibilities</h3>
                <ol type="a">
                  <li><strong>Marketing:</strong> You agree to promote Curbinfect through legitimate marketing efforts,
                    including social media, email marketing, and content marketing.</li>
                  <li><strong>Knowledge Growth:</strong> You agree to continuously improve your marketing skills and
                    knowledge to effectively promote Curbinfect.</li>
                  <li><strong>Compliance:</strong> You must comply with local laws, regulations, and industry standards
                    when
                    promoting Curbinfect.</li>
                </ol>
              </li>

              <li>
                <h3>Commission</h3>
                <ol type="a">
                  <li><strong>Structure:</strong> You will earn a commission for each sale generated through your unique
                    affiliate link.</li>
                  <li><strong>Rate:</strong> The commission rate is 15% of the sale price.</li>
                  <li><strong>Payment:</strong> Commissions will be paid fortnightly via the local bank provided.</li>
                </ol>
              </li>

              <li>
                <h3>Intellectual Property</h3>
                <ol type="a">
                  <li><strong>Ownership:</strong> Curbinfect owns all intellectual property rights, including
                    trademarks,
                    copyrights, and trade secrets.</li>
                  <li><strong>Usage:</strong> You agree to use Curbinfect's intellectual property only for promotional
                    purposes and in accordance with our guidelines.</li>
                </ol>
              </li>

              <li>
                <h3>Termination</h3>
                <ol type="a">
                  <li><strong>Curbinfect reserves the right to terminate your participation in the affiliate program at
                      any
                      time, with or without cause.</strong></li>
                  <li><strong>Notice:</strong> You will receive 7 days' notice before termination.</li>
                </ol>
              </li>

              <li>
                <h3>Liability</h3>
                <ol type="a">
                  <li><strong>Curbinfect shall not be liable for any damages or losses arising from your participation
                      in
                      the affiliate program.</strong></li>
                  <li><strong>Indemnification:</strong> You agree to indemnify Curbinfect against any claims, damages,
                    or
                    expenses arising from your marketing efforts.</li>
                </ol>
              </li>

              <li>
                <h3>Governing Law</h3>
                <ol type="a">
                  <li><strong>These Terms and Conditions shall be governed by and construed in accordance with the laws
                      of
                      Nigeria.</strong></li>
                </ol>
              </li>

              <li>
                <h3>Entire Agreement</h3>
                <ol type="a">
                  <li><strong>These Terms and Conditions constitute the entire agreement between you and Curbinfect
                      regarding the affiliate program.</strong></li>
                </ol>
              </li>

              <li>
                <h3>Amendments</h3>
                <ol type="a">
                  <li><strong>Curbinfect reserves the right to modify these Terms and Conditions at any time, with or
                      without notice.</strong></li>
                </ol>
              </li>
            </ol>

            <p>By participating in the Curbinfect Affiliate Program, you acknowledge that you have read, understood, and
              agreed to these Terms and Conditions.</p>
            <div style="margin-top: 2rem;">
              <div class="login-btn modal-btn">
                <button type="submit" class="agree-to-terms">AGREE</button>
              </div>
              <div class="login-btn modal-btn" style="background: transparent; border: 1px solid rgba(0,0,0,0.2); ">
                <button style="color: rgba(0,0,0,0.7);" class="disagree-to-terms">DISAGREE</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>