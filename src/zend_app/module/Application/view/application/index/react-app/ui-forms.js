$( document ).ready(function() {

  $('input').on('focus', function($this) {
    if($(this)[0].value == $(this)[0].defaultValue) {
      $(this)[0].value = '';
    }
  })

  $('.panel-collapse').on('show.bs.collapse', function () {
    $(this).siblings('.panel-heading').removeClass('collapsed');
    $(this).siblings('.panel-heading').addClass('active');
  });
  
  $('.panel-collapse').on('hide.bs.collapse', function () {
    $(this).siblings('.panel-heading').removeClass('active');
    $(this).siblings('.panel-heading').addClass('collapsed');
  });

});


