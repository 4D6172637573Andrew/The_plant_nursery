$(document).on('click', '.row_delete', function (event) {
  event.preventDefault();
  var rowId = $(this).data('row-id');
  console.log("Row ID to delete: " + rowId);
  $.ajax({
      url: "clear_row.php",
      method: "POST",
      data: { id: rowId },
      success: function (response) {
          location.reload();
          console.log("Server response: " + response);
      },
      error: function (xhr, status, error) {
          console.log("AJAX error: " + error);
      }
  });
});

function setCategory(category) {
  document.getElementById('category').value = category;
  const categories = document.querySelectorAll('.category');
  categories.forEach(cat => {
      if (cat.getAttribute('data-category') === category) {
          cat.classList.remove('darkened');
      } else {
          cat.classList.add('darkened');
      }
  });
}

// Initialize the darkening effect on page load
window.onload = function() {
  setCategory(document.getElementById('category').value);
}







function updateVal(currentEle, value) {

  $(currentEle).html('<input class="thVal" type="text" value="' + value + '" />');

  var mode = $(currentEle).data('mode');
  alert(mode);

  $(".thVal").focus();
  $(".thVal").keyup(function(event) {
    if (event.keyCode == 13) {
      $(this).parent().html($(this).val().trim());
      $(".thVal").remove();
    }
  });
}

$(document).click(function(e) {
  if ($(".thVal") !== undefined) {
    if ($(".thVal").val() !== undefined) {
      $(".thVal").parent().html($(".thVal").val().trim());
      $(".thVal").remove();
    }
  }
});

















