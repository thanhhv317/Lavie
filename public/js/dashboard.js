$(document).ready(function(){
  $('#sidebarCollapse').on('click', function(){
    $('#sidebar').toggleClass('active');
  });

  $('.list-unstyled li').click(function(event) {
    // event.preventDefault();
    $(this).parent().find('li.active').removeClass('active');
    $(this).attr('class', "active");
  });
});
