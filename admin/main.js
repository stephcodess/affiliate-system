(function ($) {
  "use strict";

  /* On Load Function */
  $(window).on("load", function () {
    $(".preloader").fadeOut();
    // $("#employeeTable").DataTable();

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

    function editUser(button) {
      // Add your edit user logic here
      var row = $(button).closest("tr");
      var rowData = $("#employeeTable").DataTable().row(row).data();
      alert("Edit user: " + rowData[0]);
    }

    function deleteUser(button) {
      // Add your delete user logic here
      var row = $(button).closest("tr");
      var rowData = $("#employeeTable").DataTable().row(row).data();
      alert("Delete user: " + rowData[0]);

      // For removing the row from DataTable
      $("#employeeTable").DataTable().row(row).remove().draw();
    }

    // $(".delete-button").click((e) => deleteUser(e));
    // $(".edit-button").click((e) => editUser(e));
  });
})(jQuery);
