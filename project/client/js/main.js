$(document).ready(function () {
  // enable tooltip
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  // end tooltip

  // Edit user
  $("body").on("click", ".btn_edit", function () {
    id = $(this).attr("id");
    // alert("User id "+id+" Clicked");
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    $('.header_name').html("Edit: "+data[1]);
    $('[name="fullname"]').val(data[1]);
    $('[name="useremail"]').val(data[2]);
    $("#EditModal").modal("show");
  });
  // close edit user

  // Del user
  function confirmDelete() { 
    confirm("Are you sure?")
  }
  // End Del user
});