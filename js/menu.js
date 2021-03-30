$(document).ready(function () {
  var checkCookie = $.cookie("nav-item");
  if (checkCookie != "") {
	$('#nav > li > a:eq('+checkCookie+')').addClass('active').next().show();
  }
  $('#nav > li > a').click(function(){
      var navIndex = $('#nav > li > a').index(this);
	  $.cookie("nav-item", navIndex);
	  $('#nav li ul').slideUp();
	   if ($(this).next().is(":visible")){
		   $(this).next().slideUp();
	   } else {
	   $(this).next().slideToggle();
	   }
	   $('#nav li a').removeClass('active');
	   $(this).addClass('active');
  });
});