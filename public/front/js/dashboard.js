$(document).ready(function(){
    $("#search-box").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    $(".select-2").select2();
  });