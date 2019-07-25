function searchByPrice() {

	let priceFrom = ($( "#slider-range" ).slider( "values", 0 ) );
	let priceTo = ($( "#slider-range" ).slider( "values", 1 ) );
	
	window.location = `/search/${priceFrom}/${priceTo} `;
}

$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });


// back to top button
$(document).ready(function() {
   $(window).scroll(function() { 
      if($(window).scrollTop() != 0) { 
        $('#top').fadeIn();
      } else {
        $('#top').fadeOut();
      }
   });
 $('#top').click(function() {
   $('html, body').animate({scrollTop:0},500);
 });
});