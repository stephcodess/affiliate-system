(function ($) {
  "use strict";

  /* On Load Function */
  $(window).on("load", function () {
    $(".preloader").fadeOut();

    /*===========================================
        =         Preloader         =
    =============================================*/
    if ($(".preloader").length > 0) {
      $(".preloaderCls").each(function () {
        $(this).on("click", function (e) {
          e.preventDefault();
          $(".preloader").css("display", "none");
        });
      });
    }

    $(".dropdown-header").click(function () {
      $(this).next(".dropdown-link").slideToggle();
      $(this).next(".dropdown-content").toggle();
      var $toggle = $(this).closest(".dropdown-item").find(".toggle");
      $toggle.toggleClass("open closed");
    });

    $(".dropdown-item .toggle").click(function () {
      $(this).siblings(".column").find(".dropdown-content").toggle();
      $(this).toggleClass("open closed");
    });
    $(".terms-link").click(function (event) {
      event.preventDefault(); // Prevent the default behavior of the link

      // Hide the right div and display the terms and conditions on the left div
      $(".right form").hide();
      $(".right .form-header").hide();
      $(".right .terms-header").show();

      $(".terms-wrapper").show();
    });

    $(".login-href").click((e) => {
      e.preventDefault();
      $("#loginModal").removeClass("active");
      $("#registerModal").addClass("active");
    });

    $(".login-btn .agree-to-terms").click(function (event) {
      event.preventDefault(); // Prevent form submission
      // Check the checkbox
      $("input[name='terms_&_conditions']").prop("checked", true);

      $(".right .form-header").show();
      $(".right .terms-header").hide();
      $(".right form").show();
      $(".terms-wrapper").hide();

      $("#loginModal .termserror").html("");
    });

    $(".affiliate-login-link").click((e) => {
      e.preventDefault();

      $(".mobile-sub-menu").css("display", "none");
      $(".mobile-sub-menu").css("right", "-100%");
      $(".mobile-nav").css("left", "-100%");

      $("#registerModal").addClass("active");
      $(".modal-content").addClass("active");
    });
    $(".login-btn .disagree-to-terms").click(function (event) {
      event.preventDefault();
      $(".right .form-header").show();
      $(".right .terms-header").hide();
      $(".right form").show();
      $(".terms-wrapper").hide();
    });

    $(".nav-toggle").click(() => {
      const navIsShowing = $(".mobile-nav").hasClass("show");
      $(this).toggleClass("active");
      $(".mobile-nav").toggleClass("show");
      if (navIsShowing) {
        $(".mobile-sub-menu").css("display", "flex");
        $(".mobile-nav").css("left", "0px");
      } else {
        $(".mobile-sub-menu").css("display", "none");
        $(".mobile-sub-menu").css("right", "-100%");
        $(".mobile-nav").css("left", "-100%");
      }
    });

    $(".affiliate-login-btn").click(function () {
      $("#registerModal").addClass("active");
      $(".modal-content").addClass("active");
    });

    $(".openLoginModal").click(function (e) {
      e.preventDefault();
      $("#loginModal").addClass("active");
      $(".modal-content").addClass("active");
    });

    $("#openLoginModal").click(function () {
      $("#loginModal").addClass("active");
      $(".modal-content").addClass("active");
    });

    $(".close").click(function () {
      $(".modal").removeClass("active");
    });

    // $(window).click(function (event) {
    //   if (event.target == $("#loginModal")[0]) {
    //     $("#loginModal").removeClass("active");
    //     $(".modal-content").removeClass("active");
    //   }
    // });

    $(".slider_bg_box").slick({
      dots: false,
      infinite: true,
      autoplay: true,
      vertical: false,
      arrows: false,
      speed: 300,
      cssEase: "ease-in-out",
      slidesToShow: 1,
      slidesToScroll: 1,
      mobileFirst: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });

    $(".testimonial-container").slick({
      dots: false,
      infinite: true,
      autoplay: true,
      vertical: false,
      arrows: false,
      speed: 300,
      cssEase: "ease-in-out",
      slidesToShow: 1,
      slidesToScroll: 1,
      mobileFirst: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });
  });
})(jQuery);
