$(document).ready(function() {
	
	var button;

	function deleteComment(button) {

		button.parents().find("#delete-form").submit();
	}

  $(".comments-list").readmore({
    collapsedHeight : 45,
    moreLink : '<a href="#">&nbsp&nbsp&nbspLihat semua</a>',
    lessLink : '<a href="#">&nbsp&nbsp&nbspTutup</a>'
  });


  $(".delete-button").click(function() {

        $('.small.modal.deleteConfirm')
  			   .modal('show')
		    ;

        button = $(this);
  });

  $(".yess-button").click(function() {

      deleteComment(button);
  });

  /*
      Delete multiple comments
  */

  $(".deletedId").change(function() {

    var that;

    that = $(this);

    if ($(this).prop("checked") == true) {

      var element = '<input hidden name="deletedId[]" class="toBeDeleted" type="text" value="' + $(this).val() + '">';

      $("#multipleDeletedForm").prepend(element);

    } else {

      $(".toBeDeleted").each(function(i, obj) {

        if ($(obj).val() == that.val() ) {
          $(obj).remove();
        }

      });
    }
  });

  //--------------------------------------------

  /*
    Membuka konfirmasi modal penghapusan
    beberapa komentar / multiple comments
  */

  $("#deleteMultiple").click(function() {
	  
	  var count = 0;
	  
	  // check apakah ada entity yang dicentang
	  
	  $('.deletedId').each(function(i, obj) {
		  
		 if ($(obj).prop("checked") == true) {
			 count++
		 } 
	  
	  });
	  
	  if (count == 0) {
		  alert("Untuk menghapus, mohon untuk mencentang entitas yang akan dihapus");
	  } else {
		  $('.small.modal.multipleDeleteConfirm')
	         .modal('show');
	  }
  });

  $(".yess2-button").click(function() {
      $("#multipleDeletedForm").submit();
  });

  //--------------------------------------------

  /*
    Melakukan check pada semua komentar
    ataupun uncheck pada semua komentar
  */

  $("#checkAll").click(function() {

      if ($(this).attr('data-click-state') == 0) {
        $(this).attr('data-click-state', 1);
        $(".icon-button").remove();
        $(this).prepend('<i class="remove circle icon icon-button">');

        $(".deletedId").each(function(i, obj) {
            if ($(obj).prop("checked") == false) {
              $(obj).click();
            }
        });

      } else {

        $(this).attr('data-click-state', 0);
        $(".icon-button").remove();
        $(this).prepend('<i class="check circle icon icon-button">');

        $(".deletedId").each(function(i, obj) {
            if ($(obj).prop("checked") == true) {
              $(obj).click();
            }
        });
      }
  });

  //----------------------------------------------------
  
});
