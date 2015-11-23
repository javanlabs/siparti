$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajaxSetup({
    beforeSend: function(xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
    }
});

$(function(){
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    $('.ui.accordion').accordion({exclusive: false});
    $('.ui.embed').embed();
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('hide')
            ;
        });
    $('.item-browse-menu')
        .popup({
            popup     : '.popup-menu-admin',
            hoverable : true,
            position  : 'bottom left',
            delay     : {
                show: 100,
                hide: 500
            }
        })
    ;

    $('.browse-proker')
        .popup({
            popup     : '#popup-proker',
            hoverable : true,
            position  : 'bottom left',
            delay     : {
                show: 100,
                hide: 500
            }
        })
    ;

    $('#browse-user-menu')
        .popup({
            popup     : '#popup-user-menu',
            hoverable : true,
            position  : 'bottom left',
            delay     : {
                show: 100,
                hide: 500
            }
        })
    ;

    $('.section-audit-trails').on('click', '.btn-view-log', function(e){
        e.preventDefault();
        $($(this).data('target')).modal('show');
    });
});

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
  
  $(".textRedactor").redactor({
	  minHeight: 300,
	  imageUpload: 'http://localhost:8000/image/upload',
	  plugins : ['imageManager'],
	  callbacks : {
		  uploadStart: function() {
			  $.ajaxSetup({
				    beforeSend: function(xhr) {
				        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
				    }
				});
		  }
	  }
	 
  });
  
  // Menghapus duplikasi texts ketika refresh di redactor
  
  $(".redactor-editor").text("");	
  
  // Saat melakukan edit, redactor load teks dari div 
  // dengan class descriptionText
  
  var descriptionText = $(".descriptionText").text();
  
  $(".textRedactor").redactor('insert.html', descriptionText);
	  
});
