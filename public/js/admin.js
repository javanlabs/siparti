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


    $('.checkbox[data-toggle="checkall"]').each(function(){
        var $parent = $(this);
        var $childCheckbox = $(document).find($parent.data('selector'));

        $parent
            .checkbox({
                // check all children
                onChecked: function() {
                    $childCheckbox.checkbox('check');
                },
                // uncheck all children
                onUnchecked: function() {
                    $childCheckbox.checkbox('uncheck');
                }
            })
        ;

        $childCheckbox
            .checkbox({
                // Fire on load to set parent value
                fireOnInit : true,
                // Change parent state on each child checkbox change
                onChange   : function() {
                    var
                        $parentCheckbox = $parent,
                        $checkbox       = $childCheckbox,
                        allChecked      = true,
                        allUnchecked    = true,
                        ids = []
                        ;
                    // check to see if all other siblings are checked or unchecked
                    $checkbox.each(function() {
                        if( $(this).checkbox('is checked') ) {
                            allUnchecked = false;
                            ids.push($(this).children().first().val());
                        }
                        else {
                            allChecked = false;
                        }
                    });

                    // change multiple delete form action, based on selected ids
                    var url = $('form[data-type="delete-multiple"]').attr('action');
                    var replaceStartFrom = url.lastIndexOf('/');
                    var newUrl = url.substr(0, replaceStartFrom) + '/' + ids.join(',');

                    $('form[data-type="delete-multiple"]').attr('action', newUrl);

                    // set parent checkbox state, but dont trigger its onChange callback
                    if(allChecked) {
                        $parentCheckbox.checkbox('set checked');
                    }
                    else if(allUnchecked) {
                        $parentCheckbox.checkbox('set unchecked');
                    }
                    else {
                        $parentCheckbox.checkbox('set indeterminate');
                    }
                }
            })
        ;
    });

});
